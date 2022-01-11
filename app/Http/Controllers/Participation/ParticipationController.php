<?php

namespace App\Http\Controllers\Participation;

use App\Http\Controllers\Controller;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use PDF;
use Ramsey\Uuid\Uuid;
use Storage;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class ParticipationController extends Controller
{
    /**
     * Display list of participations.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        return Inertia::render('Participation/ListParticipations', [
            'participations' => $request->user()->participations()->get()
        ]);
    }

    /**
     * Create a new participation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Inertia\Response
     */
    public function create(Request $request)
    {
        return Inertia::render('Participation/Create', [

        ]);
    }

    /**
     * Store the participation data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'birthday' => 'required|date',
            'gender' => ['required', Rule::in(['m', 'w', 'd'])],
            'stamm' => ['required', Rule::in(['131302', '131304', '131305', '131306', '131307', '131308', '131309', '131312'])],
            'stufe' => ['required', Rule::in(['woes', 'jupfis', 'pfadis', 'rover', 'leiter'])],
            'role' => ['required_if:stufe,leiter', 'exclude_unless:stufe,leiter', Rule::in(['woeleiter', 'jupfileiter', 'pfadileiter', 'roverleiter', 'kitchen', 'cafe', 'bildung', 'dunno'])],
            'prevention' => ['exclude_unless:stufe,leiter', 'boolean'],
            'mail' => 'required|email',
            'insurance_person' => 'required',
            'insurance' => 'required',
            'vaccination_info_confirmed' => 'required|boolean',
            'food' => ['required', Rule::in(['vegetarian', 'meet', 'vegan', 'gluten_free', 'lactose_free'])],
            'parent_phone' => 'required',
            'parent_mobile' => 'required',
            'parent_address' => 'required',
            'apply' => 'boolean',
        ]);

        $data['user_id'] = $request->user()->id;
        $participation = Participant::create($data);

        if($data['apply']){
            $participation->apply();
            $participation->save();
            return redirect()->route('participation.show', $participation->id);
        }

        return redirect()->route('participation.index');
    }

    /**
     * Show details.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Inertia\Response
     */
    public function show(Request $request, Participant $participation)
    {
        return Inertia::render('Participation/Show', [
            'participation' => $participation
        ]);
    }

    /**
     * Edit a participation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Inertia\Response
     */
    public function edit(Request $request, Participant $participation)
    {
        return Inertia::render('Participation/Edit', [
            'participation' => $participation
        ]);
    }

    /**
     * Store the participation data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Participant $participation)
    {
        $data = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'birthday' => 'required|date',
            'gender' => ['required', Rule::in(['m', 'w', 'd'])],
            'stamm' => ['required', Rule::in(['131302', '131304', '131305', '131306', '131307', '131308', '131309', '131312'])],
            'stufe' => ['required', Rule::in(['woes', 'jupfis', 'pfadis', 'rover', 'leiter'])],
            'role' => ['required_if:stufe,leiter', 'exclude_unless:stufe,leiter', Rule::in(['woeleiter', 'jupfileiter', 'pfadileiter', 'roverleiter', 'kitchen', 'cafe', 'bildung', 'dunno'])],
            'prevention' => ['exclude_unless:stufe,leiter', 'boolean'],
            'mail' => 'required|email',
            'insurance_person' => 'required',
            'insurance' => 'required',
            'vaccination_info_confirmed' => 'required|boolean',
            'food' => ['required', Rule::in(['vegetarian', 'meet', 'vegan', 'gluten_free', 'lactose_free'])],
            'parent_phone' => 'required',
            'parent_mobile' => 'required',
            'parent_address' => 'required',
            'apply' => 'boolean',
        ]);

        abort_unless($request->user()->can('edit', $participation), 403, 'Access denied.');

        $participation->firstname = $data['firstname'];
        $participation->lastname = $data['lastname'];
        $participation->birthday = $data['birthday'];
        $participation->gender = $data['gender'];
        $participation->stamm = $data['stamm'];
        $participation->stufe = $data['stufe'];
        if(array_key_exists('role', $data)){
            $participation->role = $data['role'];
        }
        if(array_key_exists('prevention', $data)){
            $participation->prevention = $data['prevention'];
        }
        $participation->mail = $data['mail'];
        $participation->insurance_person = $data['insurance_person'];
        $participation->insurance = $data['insurance'];
        $participation->vaccination_info_confirmed = $data['vaccination_info_confirmed'];
        $participation->food = $data['food'];
        $participation->parent_phone = $data['parent_phone'];
        $participation->parent_mobile = $data['parent_mobile'];
        $participation->parent_address = $data['parent_address'];

        $participation->save();

        if($data['apply']){
            $participation->apply();
            $participation->save();
            return redirect()->route('participation.show', $participation->id);
        }

        return redirect()->route('participation.index');
    }

    /**
     * Print a participation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function print(Request $request, Participant $participation)
    {
        return view('participation_pdf', ['participation' => $participation]);
    }

    // Generate PDF
    public function createPDF(Request $request, Participant $participation) {
        $result = $this->chromePDF($request, $participation);

        if($result !== false) {
            return $result;
        }

        // share data to view
        view()->share('participation',$participation);
        $pdf = PDF::loadView('participation_pdf', $participation);

        // download PDF file with download method
        return $pdf->download('anmeldung.pdf');
    }

    private function chromePDF(Request $request, Participant $participation){
        $file = 'generated_pdfs/' . Uuid::uuid4() . '.pdf';
        $process = new Process(
            [
                '/usr/bin/google-chrome-stable',
                '--headless',
                '--disable-gpu',
                '--disable-software-rasterizer',
                '--disable-dev-shm-usage',
                '--run-all-compositor-stages-before-draw',
                '--no-margins',
                '--no-sandbox',
                '--print-to-pdf-no-header',
                '--print-to-pdf='. Storage::path($file),
                route('participation.print', [
                    'participation' => $participation->id,
                    'secret' => config('app.pdf_secret')
                ]),
            ], null, null, null, null
        );

        try
        {
            $process->mustRun();
            return \Storage::download($file, 'Anmeldung_Bezirkslager.pdf');
        }
        catch (ProcessFailedException $exception)
        {
            return false;
        }
    }
}

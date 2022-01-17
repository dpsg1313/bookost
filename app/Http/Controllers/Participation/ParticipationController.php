<?php

namespace App\Http\Controllers\Participation;

use App\Http\Controllers\Controller;
use App\Models\Participation;
use DateInterval;
use DateTime;
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
    private static $Tribes = [
        131302 => 'Ottobrunn',
        131304 => 'Camilo Torres (Hohenbrunn)',
        131305 => 'Galileo Galilei (Messestadt Riem)',
        131306 => 'Unterhaching 1',
        131307 => 'Columbus (Neukeferloh)',
        131308 => 'Condor (Waldtrudering)',
        131309 => 'Arche Noah (Putzbrunn)',
        131312 => 'St. Michael Perlach'
    ];

    private static $Genders = [
        'm' => 'männlich',
        'w' => 'weiblich',
        'd' => 'divers',
    ];

    private static $Stufen = [
        'woes' => 'Wölflinge',
        'jupfis' => 'Jupfis',
        'pfadis' => 'Pfadis',
        'rover' => 'Rover',
        'leiter' => 'Leiter*innen / Staff'
    ];

    private static $Foods = [
        'vegetarian' => 'vegetarisch',
        'meet' => 'esse auch Fleisch',
        'vegan' => 'vegan',
        'gluten_free' => 'glutenfrei',
        'lactose_free' => 'laktosefrei',
    ];

    private static $Roles = [
        'woeleiter' => 'Wö-Leiter*in',
        'jupfileiter' => 'Jupfi-Leiter*in',
        'pfadileiter' => 'Pfadi-Leiter*in',
        'roverleiter' => 'Rover-Leiter*in',
        'kitchen' => 'Küche',
        'cafe' => 'Café',
        'bildung' => 'Bildungscafé',
        'dunno' => 'Weiß ich noch nicht',
    ];

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
    public function create(Request $request, string $mode = 'normal')
    {
        return Inertia::render('Participation/Create', [
            'prefill_email' => $request->user()->email,
            'mode' => $mode,
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
        $requiredIfUnder18 = Rule::requiredIf(function () use ($request) {
            $bday = new DateTime($request->birthday);
            $bday->add(new DateInterval("P18Y")); //adds time interval of 18 years to bday
            return $bday >= new DateTime();
        });

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
            'allergies' => 'nullable|string',
            'parent_phone' => [$requiredIfUnder18],
            'parent_mobile' => [$requiredIfUnder18],
            'parent_address' => [$requiredIfUnder18],
            'foto_consent_confirmed' => 'required|boolean',
            'mode' => ['string', Rule::in(['parent', 'normal'])],
            'apply' => 'boolean',
        ]);

        $data['user_id'] = $request->user()->id;
        $participation = Participation::create($data);

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
    public function show(Request $request, Participation $participation)
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
    public function edit(Request $request, Participation $participation)
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
    public function update(Request $request, Participation $participation)
    {
        $requiredIfUnder18 = Rule::requiredIf(function () use ($request) {
            $bday = new DateTime($request->birthday);
            $bday->add(new DateInterval("P18Y")); //adds time interval of 18 years to bday
            return $bday >= new DateTime();
        });

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
            'allergies' => 'nullable|string',
            'parent_phone' => [$requiredIfUnder18],
            'parent_mobile' => [$requiredIfUnder18],
            'parent_address' => [$requiredIfUnder18],
            'foto_consent_confirmed' => 'required|boolean',
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
        $participation->allergies = $data['allergies'];
        if(array_key_exists('parent_phone', $data)){
            $participation->parent_phone = $data['parent_phone'];
        }
        if(array_key_exists('parent_mobile', $data)){
            $participation->parent_mobile = $data['parent_mobile'];
        }
        if(array_key_exists('parent_address', $data)){
            $participation->parent_address = $data['parent_address'];
        }
        $participation->foto_consent_confirmed = $data['foto_consent_confirmed'];

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
    public function print(Request $request, Participation $participation)
    {
        $bday = new DateTime($participation->birthday);
        $bday->add(new DateInterval("P18Y")); //adds time interval of 18 years to bday
        $isOver18 = $bday < new DateTime();

        return view('participation_pdf', [
            'firstname' => $participation->firstname,
            'lastname' => $participation->lastname,
            'birthday' => $participation->birthday,
            'gender' => self::$Genders[$participation->gender],
            'stamm' => self::$Tribes[$participation->stamm],
            'stufe' => self::$Stufen[$participation->stufe],
            'role' => $participation->role ? self::$Roles[$participation->role] : null,
            'prevention' => $participation->prevention,
            'mail' => $participation->mail,
            'insurance_person' => $participation->insurance_person,
            'insurance' => $participation->insurance,
            'vaccination_info_confirmed' => $participation->vaccination_info_confirmed,
            'food' => self::$Foods[$participation->food],
            'allergies' => $participation->allergies,
            'parent_phone' => $participation->parent_phone,
            'parent_mobile' => $participation->parent_mobile,
            'parent_address' => $participation->parent_address,
            'foto_consent_confirmed' => $participation->foto_consent_confirmed,
            'isOver18' => $isOver18,
            'beitrag' => $participation->role == 'leiter' ? 50 : 100
        ]);
    }

    // Generate PDF
    public function createPDF(Request $request, Participation $participation) {
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

    private function chromePDF(Request $request, Participation $participation){
        Storage::makeDirectory('generated_pdfs');
        $file = 'generated_pdfs' . DIRECTORY_SEPARATOR . Uuid::uuid4() . '.pdf';
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

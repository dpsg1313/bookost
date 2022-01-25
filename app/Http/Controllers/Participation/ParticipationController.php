<?php

namespace App\Http\Controllers\Participation;

use App\Http\Controllers\Controller;
use App\Models\Participation;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
        131302 => [
            'name' => 'Ottobrunn',
            'bankAccountOwner' => 'DPSG Ottobrunn',
            'iban' => 'DE12 7001 0080 0343 1398 04',
            'bic' => 'PBNKDEFFXXX',
        ],
        131304 => [
            'name' => 'Camilo Torres (Hohenbrunn)',
            'bankAccountOwner' => 'Camilo Torres',
            'iban' => 'DE83 3706 0193 4007 8580 14',
            'bic' => 'GENODED1PAX',
        ],
        131305 => [
            'name' => 'Galileo Galilei (Messestadt Riem)',
            'bankAccountOwner' => 'DPSG Mchn-Riem Stamm GaGa',
            'iban' => 'DE92 7509 0300 0002 3046 43',
            'bic' => 'GENODEF1M05',
        ],
        131306 => [
            'name' => 'Unterhaching 1',
            'bankAccountOwner' => 'DPSG Stamm U1',
            'iban' => 'DE30 7025 0150 0210 4756 38',
            'bic' => 'BYLADEM1KMS',
        ],
        131307 => [
            'name' => 'Columbus (Neukeferloh)',
            'bankAccountOwner' => 'DPSG Stamm Columbus',
            'iban' => 'DE40 7509 0300 0002 2084 82',
            'bic' => 'GENODEF1M05',
        ],
        131308 => [
            'name' => 'Condor (Waldtrudering)',
            'bankAccountOwner' => 'Stamm Condor',
            'iban' => 'DE 24 7509 0300 0002 1424 22',
            'bic' => 'GENODEF1M05',
        ],
        131309 => [
            'name' => 'Arche Noah (Putzbrunn)',
            'bankAccountOwner' => 'Dpsg Stamm Arche Noah Putzbrunn',
            'iban' => 'DE90 7509 0300 0002 1560 75',
            'bic' => 'GENODEF1M05',
        ],
        131312 => [
            'name' => 'St. Michael Perlach',
            'bankAccountOwner' => 'Stamm St. Michael Perlach',
            'iban' => 'DE59 7509 0300 0102 3408 52',
            'bic' => 'GENODEF1M05',
        ],
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

    private static $BankAccounts = [
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
            'participations' => $request->user()->participations()->get(),
            'admin' => $request->user()->email == 'florian.kick@googlemail.com' && $request->user()->hasVerifiedEmail(),
            'tribes' => self::$Tribes,
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
        $data = $this->validateForSaving($request);

        $data['user_id'] = $request->user()->id;
        $participation = Participation::create($data);

        return redirect()->route('participation.index');
    }

    /**
     * Store the participation data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function storeAndApply(Request $request)
    {
        $data = $this->validateForApply($request);

        $data['user_id'] = $request->user()->id;
        $participation = Participation::create($data);

        $participation->apply();
        $participation->save();
        return redirect()->route('participation.show', $participation->id);
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
            'participation' => $participation,
            'stamm' => self::$Tribes[$participation->stamm],
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
        abort_unless($request->user()->can('edit', $participation), 403, 'Access denied.');
        $data = $this->validateForSaving($request);
        $this->updateFields($data, $participation);
        $participation->save();

        return redirect()->route('participation.index');
    }

    /**
     * Store the participation data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateAndApply(Request $request, Participation $participation)
    {
        abort_unless($request->user()->can('edit', $participation), 403, 'Access denied.');
        $data = $this->validateForApply($request);
        $this->updateFields($data, $participation);
        $participation->apply();
        $participation->save();
        return redirect()->route('participation.show', $participation->id);
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
            'birthday' => Carbon::make($participation->birthday),
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
            'gluten' => $participation->gluten,
            'lactose' => $participation->lactose,
            'allergies' => $participation->allergies,
            'parent_name' => $participation->parent_name,
            'parent_phone' => $participation->parent_phone,
            'parent_mobile' => $participation->parent_mobile,
            'parent_address' => $participation->parent_address,
            'foto_consent_confirmed' => $participation->foto_consent_confirmed,
            'isOver18' => $isOver18,
            'beitrag' => $participation->stufe == 'leiter' ? 50 : 100
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
                config('app.chrome_path'),
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

    private function requiredIfUnder18Rule($birthday){
        return Rule::requiredIf(function () use ($birthday) {
            $bday = new DateTime($birthday);
            $bday->add(new DateInterval("P18Y")); //adds time interval of 18 years to bday
            return $bday >= new DateTime();
        });
    }

    private function validateForSaving(Request $request): array{
        return $request->validate([
            'firstname' => 'required|string|max:256',
            'lastname' => 'required|string|max:256',
            'birthday' => 'required|date',
            'gender' => ['nullable', Rule::in(array_keys(self::$Genders))],
            'stamm' => ['nullable', Rule::in(array_keys(self::$Tribes))],
            'stufe' => ['nullable', Rule::in(array_keys(self::$Stufen))],
            'role' => ['nullable', 'exclude_unless:stufe,leiter', Rule::in(array_keys(self::$Roles))],
            'prevention' => ['nullable', 'exclude_unless:stufe,leiter', 'boolean'],
            'mail' => 'nullable|email|max:256',
            'insurance_person' => 'nullable|string|max:256',
            'insurance' => 'nullable|string|max:256',
            'vaccination_info_confirmed' => 'nullable|boolean',
            'food' => ['nullable', Rule::in(array_keys(self::$Foods))],
            'gluten' => 'required|boolean',
            'lactose' => 'required|boolean',
            'allergies' => 'nullable|string|max:256',
            'parent_name' => 'nullable|string|max:256',
            'parent_phone' => 'nullable|string|max:256',
            'parent_mobile' => 'nullable|string|max:256',
            'parent_address' => 'nullable|string|max:256',
            'foto_consent_confirmed' => 'nullable|boolean',
            'mode' => ['string', Rule::in(['parent', 'normal'])],
        ]);
    }

    private function validateForApply(Request $request): array{
        $requiredIfUnder18 = $this->requiredIfUnder18Rule($request->birthday);

        return $request->validate([
            'firstname' => 'required|string|max:256',
            'lastname' => 'required|string|max:256',
            'birthday' => 'required|date',
            'gender' => ['required', Rule::in(['m', 'w', 'd'])],
            'stamm' => ['required', Rule::in(['131302', '131304', '131305', '131306', '131307', '131308', '131309', '131312'])],
            'stufe' => ['required', Rule::in(['woes', 'jupfis', 'pfadis', 'rover', 'leiter'])],
            'role' => ['required_if:stufe,leiter', 'exclude_unless:stufe,leiter', Rule::in(['woeleiter', 'jupfileiter', 'pfadileiter', 'roverleiter', 'kitchen', 'cafe', 'bildung', 'dunno'])],
            'prevention' => ['exclude_unless:stufe,leiter', 'boolean'],
            'mail' => 'required|email|max:256',
            'insurance_person' => 'required|string|max:256',
            'insurance' => 'required|string|max:256',
            'vaccination_info_confirmed' => 'required|boolean|accepted',
            'food' => ['required', Rule::in(array_keys(self::$Foods))],
            'gluten' => 'required|boolean',
            'lactose' => 'required|boolean',
            'allergies' => 'nullable|string|max:256',
            'parent_name' => [$requiredIfUnder18, 'string', 'max:256'],
            'parent_phone' => [$requiredIfUnder18, 'string', 'max:256'],
            'parent_mobile' => [$requiredIfUnder18, 'string', 'max:256'],
            'parent_address' => [$requiredIfUnder18, 'string', 'max:256'],
            'foto_consent_confirmed' => 'required|boolean|accepted',
            'mode' => ['string', Rule::in(['parent', 'normal'])],
            'apply' => 'boolean',
        ]);
    }

    private function updateFields(array $data, Participation $participation){
        $fieldnames = [
            'firstname',
            'lastname',
            'birthday',
            'gender',
            'stamm',
            'stufe',
            'role',
            'prevention',
            'mail',
            'insurance_person',
            'insurance',
            'vaccination_info_confirmed',
            'food',
            'gluten',
            'lactose',
            'allergies',
            'parent_name',
            'parent_phone',
            'parent_mobile',
            'parent_address',
            'foto_consent_confirmed',
        ];
        foreach ($fieldnames as $field) {
            if(array_key_exists($field, $data)){
                $participation->$field = $data[$field];
            }
        }
    }
}

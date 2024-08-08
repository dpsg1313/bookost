<?php

namespace App\Http\Controllers\Participation;

use App\Exports\ParticipationExport;
use App\Http\Controllers\Controller;
use App\Models\Participation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class ListController extends Controller
{

    /**
     * Display list of applied participations.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Inertia\Response
     */
    public function listParticipations(Request $request)
    {
        $user = $request->user();
        $sortColumn = $request->query->get('sort', 'firstname');
        $sortDesc = $request->query->getBoolean('desc', false);

        $query = Participation::query();
        $query = $query->whereNotNull('applied_at');

        $tribes = [];
        $readonly = false;
        foreach ($user->responsibilities()->get() as $responsibility) {
            $readonly = $responsibility->readonly;
            if($responsibility->group == '1313'){
                $tribes = array_keys(ParticipationController::$Tribes);
                break;
            }
            $tribes[] = $responsibility->group;
        }
        $query = $query->whereIn('stamm', $tribes);

        $query = $query->orderBy($sortColumn, $sortDesc ? 'desc' : 'asc');

        return Inertia::render('Participation/List', [
            'participations' => $query->get(),
            'readonly' => $readonly,
            'tribes' => ParticipationController::$Tribes,
            'stufen' => ParticipationController::$Stufen,
            'sortColumn' => $sortColumn,
            'sortDesc' => $sortDesc,
        ]);
    }

    /**
     * Sign the participation.
     *
     * @param \Illuminate\Http\Request $request
     * @param Participation $participation
     * @return \Illuminate\Http\RedirectResponse
     *
     */
    public function signParticipation(Request $request, Participation $participation)
    {
        abort_unless($request->user()->can('sign', $participation), 403, 'Access denied.');
        $participation->sign();
        $participation->save();

        return redirect()->route('participation.list');
    }

    /**
     * Pay the participation.
     *
     * @param \Illuminate\Http\Request $request
     * @param Participation $participation
     * @return \Illuminate\Http\RedirectResponse
     *
     */
    public function payParticipation(Request $request, Participation $participation)
    {
        abort_unless($request->user()->can('pay', $participation), 403, 'Access denied.');
        $participation->pay();
        $participation->save();

        return redirect()->route('participation.list');
    }

    public function exportParticipations(Request $request)
    {
        $user = $request->user();

        $tribes = [];
        foreach ($user->responsibilities()->get() as $responsibility) {
            if($responsibility->group == '1313'){
                $tribes = array_keys(ParticipationController::$Tribes);
                break;
            }
            $tribes[] = $responsibility->group;
        }

        return (new ParticipationExport())->forTribes($tribes)->download('Anmeldungen.xlsx');
    }

    /**
     * Bulk edit participation (to confirm signatures).
     *
     * @param \Illuminate\Http\Request $request
     * @param Participation $participation
     * @return \Inertia\Response
     */
    public function bulkSignParticipations(Request $request)
    {
        $user = $request->user();

        $query = Participation::query();
        $query = $query->whereNotNull('applied_at');

        $tribes = [];
        foreach ($user->responsibilities()->where('readonly', '=', false)->get() as $responsibility) {
            if($responsibility->group == '1313'){
                $tribes = array_keys(ParticipationController::$Tribes);
                break;
            }
            $tribes[] = $responsibility->group;
        }
        $query = $query->whereIn('stamm', $tribes);

        $query = $query->orderBy('lastname');

        return Inertia::render('Participation/BulkSign', [
            'participations' => $query->get(),
        ]);
    }

    /**
     * Store the signatures from bulk-sign.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     *
     */
    public function saveSignatures(Request $request)
    {
        DB::transaction(function () use ($request) {
            $data = $request->post();
            foreach ($data as $id => $signed) {
                $participation = Participation::find($id);
                if (!$participation) {
                    abort(404, 'Participation not found.');
                }
                abort_unless($request->user()->can('sign', $participation), 403, 'Access denied.');
                if (!$participation->isSigned() && $signed) {
                    $participation->sign();
                    $participation->save();
                } else if ($participation->isSigned() && !$signed) {
                    $participation->unsign();
                    $participation->save();
                }
            }
        });
        return redirect()->route('participation.list');
    }

    /**
     * Edit a participation.
     *
     * @param \Illuminate\Http\Request $request
     * @param Participation $participation
     * @return \Inertia\Response
     */
    public function correctParticipation(Request $request, Participation $participation)
    {
        abort_unless($request->user()->can('correct', $participation), 403, 'Access denied.');
        return Inertia::render('Participation/Correct', [
            'participation' => $participation
        ]);
    }

    /**
     * Store the participation data.
     *
     * @param \Illuminate\Http\Request $request
     * @param Participation $participation
     * @return \Illuminate\Http\RedirectResponse
     *
     */
    public function saveCorrection(Request $request, Participation $participation)
    {
        abort_unless($request->user()->can('correct', $participation), 403, 'Access denied.');
        $data = $this->validateForCorrection($request);
        $this->updateFields($data, $participation);
        $participation->save();

        return redirect()->route('participation.list');
    }

    private function validateForCorrection(Request $request): array{
        return $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'birthday' => 'required|date',
            'gender' => ['nullable', Rule::in(array_keys(ParticipationController::$Genders))],
            'stamm' => ['nullable', Rule::in(array_keys(ParticipationController::$Tribes))],
            'stufe' => ['nullable', Rule::in(array_keys(ParticipationController::$Stufen))],
            'role' => ['nullable', 'exclude_unless:stufe,leiter', Rule::in(array_keys(ParticipationController::$Roles))],
            'prevention' => ['nullable', 'exclude_unless:stufe,leiter', 'boolean'],
            'mail' => 'nullable|email|max:255',
            'insurance_person' => 'nullable|string|max:255',
            'insurance' => 'nullable|string|max:255',
            'food' => ['nullable', Rule::in(array_keys(ParticipationController::$Foods))],
            'gluten' => 'required|boolean',
            'lactose' => 'required|boolean',
            'allergies' => 'nullable|string|max:255',
            'parent_name' => 'nullable|string|max:255',
            'parent_phone' => 'nullable|string|max:255',
            'parent_mobile' => 'nullable|string|max:255',
            'parent_address' => 'nullable|string|max:255',
            'bus_there' => 'required|boolean',
            'bus_back' => 'required|boolean',
            'bus_stop' => ['nullable', Rule::in(array_keys(ParticipationController::$BusStops))],
            'travel_comment' => 'nullable|string|max:255',
            'signed_at' => 'nullable|date',
            'paid_at' => 'nullable|date',
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
            'food',
            'gluten',
            'lactose',
            'allergies',
            'parent_name',
            'parent_phone',
            'parent_mobile',
            'parent_address',
            'bus_there',
            'bus_back',
            'bus_stop',
            'travel_comment',
            'signed_at',
            'paid_at',
        ];
        foreach ($fieldnames as $field) {
            if(array_key_exists($field, $data)){
                $participation->$field = $data[$field];
            }
        }
    }
}

<?php

namespace App\Http\Controllers\Responsibles;

use App\Exports\ParticipationExport;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Participation\ParticipationController;
use App\Models\Participation;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ResponsiblesController extends Controller
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

        $query = Participation::query();
        $query = $query->whereNotNull('applied_at');

        $tribes = [];
        foreach ($user->responsibilities()->get() as $responsibility) {
            if($responsibility->group == '1313'){
                $tribes = array_keys(ParticipationController::$Tribes);
                break;
            }
            $tribes[] = $responsibility->group;
        }
        $query = $query->whereIn('stamm', $tribes);

        return Inertia::render('Responsibles/List', [
            'participations' => $query->get(),
            'tribes' => ParticipationController::$Tribes,
            'stufen' => ParticipationController::$Stufen,
            'roles' => ParticipationController::$Roles,
        ]);
    }

    /**
     * Sign the participation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function signParticipation(Request $request, Participation $participation)
    {
        abort_unless($request->user()->can('sign', $participation), 403, 'Access denied.');
        $participation->sign();
        $participation->save();

        return redirect()->route('responsibles.participation.list');
    }

    /**
     * Pay the participation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function payParticipation(Request $request, Participation $participation)
    {
        abort_unless($request->user()->can('pay', $participation), 403, 'Access denied.');
        $participation->pay();
        $participation->save();

        return redirect()->route('responsibles.participation.list');
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
}

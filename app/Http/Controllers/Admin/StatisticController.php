<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Participation\ParticipationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class StatisticController extends Controller
{

    /**
     * Display participation statistics.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Inertia\Response
     */
    public function showStats(Request $request)
    {
        $byStammQuery = DB::table('participations')
            ->select('stamm', DB::raw('count(*) as tn'), DB::raw('sum(bus_there = 1) as bus_there_tn'), DB::raw('sum(bus_back = 1) as bus_back_tn'))
            ->whereNotNull('applied_at')
            ->groupBy('stamm');

        $byStufeQuery = DB::table('participations')
            ->select('stufe', DB::raw('count(*) as tn'))
            ->whereNotNull('applied_at')
            ->groupBy('stufe');

        $byRoleQuery = DB::table('participations')
            ->select('role', DB::raw('count(*) as tn'))
            ->whereNotNull('applied_at')
            ->where('stufe', '=', 'leiter')
            ->groupBy('role');

        return Inertia::render('Admin/Statistics', [
            'byStamm' => $byStammQuery->get(),
            'byStufe' => $byStufeQuery->pluck('tn','stufe'),
            'byRole' => $byRoleQuery->pluck('tn','role'),
            'tribes' => ParticipationController::$Tribes,
            'stufen' => ParticipationController::$Stufen,
            'roles' => ParticipationController::$Roles,
        ]);
    }
}

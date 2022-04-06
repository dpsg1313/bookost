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
            ->select('stamm', DB::raw('count(*) as tn'))
            ->whereNotNull('applied_at')
            ->groupBy('stamm');

        $byStufeQuery = DB::table('participations')
            ->select('stufe', DB::raw('count(*) as tn'))
            ->whereNotNull('applied_at')
            ->groupBy('stufe');

        return Inertia::render('Admin/Statistics', [
            'byStamm' => $byStammQuery->pluck('tn','stamm'),
            'byStufe' => $byStufeQuery->pluck('tn','stufe'),
            'tribes' => ParticipationController::$Tribes,
            'stufen' => ParticipationController::$Stufen,
        ]);
    }
}

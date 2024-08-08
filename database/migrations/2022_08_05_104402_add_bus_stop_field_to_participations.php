<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBusStopFieldToParticipations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('participations', function (Blueprint $table) {
            $table->string('bus_stop')->nullable();
        });
        DB::table('participations')
            ->where('bus_there', '=', 1)
            ->whereIn('stamm', [131306, 131312])
            ->update([
                'bus_stop' => 'perlach'
            ]);
        DB::table('participations')
            ->where('bus_there', '=', 1)
            ->whereIn('stamm', [131305, 131307, 131308])
            ->update([
                'bus_stop' => 'riem'
            ]);
        DB::table('participations')
            ->where('bus_there', '=', 1)
            ->whereIn('stamm', [131302, 131304, 131309])
            ->update([
                'bus_stop' => 'ottobrunn'
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('participations', function (Blueprint $table) {
            $table->dropColumn('bus_stop');
        });
    }
}

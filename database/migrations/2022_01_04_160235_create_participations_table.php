<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('firstname');
            $table->string('lastname');
            $table->date('birthday');
            $table->string('gender');
            $table->string('stamm');
            $table->string('stufe');
            $table->string('role')->nullable();
            $table->boolean('prevention')->nullable();
            $table->string('mail');
            $table->string('insurance_person');
            $table->string('insurance');
            $table->boolean('vaccination_info_confirmed');
            $table->string('food');
            $table->string('allergies')->nullable();
            $table->string('parent_phone')->nullable();
            $table->string('parent_mobile')->nullable();
            $table->string('parent_address')->nullable();
            $table->boolean('foto_consent_confirmed');
            $table->timestamp('applied_at')->nullable();
            $table->timestamp('signed_at')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->string('mode');

            $table->unsignedBigInteger('user_id');

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('participations');
    }
}

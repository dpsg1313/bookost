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
            $table->string('gender')->nullable();
            $table->string('stamm')->nullable();
            $table->string('stufe')->nullable();
            $table->string('role')->nullable();
            $table->boolean('prevention')->nullable();
            $table->string('mail')->nullable();
            $table->string('insurance_person')->nullable();
            $table->string('insurance')->nullable();
            $table->boolean('vaccination_info_confirmed')->nullable();
            $table->string('food')->nullable();
            $table->boolean('gluten')->nullable();
            $table->boolean('lactose')->nullable();
            $table->string('allergies')->nullable();
            $table->string('parent_name')->nullable();
            $table->string('parent_phone')->nullable();
            $table->string('parent_mobile')->nullable();
            $table->string('parent_address')->nullable();
            $table->boolean('foto_consent_confirmed')->nullable();
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

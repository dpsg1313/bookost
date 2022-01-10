<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
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
            $table->string('parent_phone');
            $table->string('parent_mobile');
            $table->string('parent_address');
            $table->timestamp('applied_at')->nullable();
            $table->timestamp('signed_at')->nullable();
            $table->timestamp('paid_at')->nullable();

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
        Schema::dropIfExists('participants');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('nom');
            $table->string('prenom');
            $table->date('date_naissance');
            $table->string('email_professionnel')->unique();
            $table->string('email_personnel')->nullable();
            $table->string('matricule');
            $table->string('telephone');
            $table->string('code_postal');
            $table->string('ville');
            $table->string('pays');
            $table->string('adresse');
            $table->string('situation_familiale');
            $table->integer('nombre_enfants');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('employees');
    }
}


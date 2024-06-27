<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');
            $table->string('type'); // Type de contrat (CDI, CDD, Intérim, etc.)
            $table->string('classification'); // Classification (ETAM, Ingénieurs et Cadres, etc.)
            $table->integer('coefficient')->nullable(); // Coefficient (par exemple, 240 à 355, 400 à 500)
            $table->string('periode_essai_initiale')->nullable(); // Durée initiale de la période d'essai
            $table->string('renouvellement')->nullable(); // Renouvellement possible (Oui/Non, Nombre de fois)
            $table->string('duree_contrat')->nullable(); // Durée du contrat (Maximum 18 mois, Variable, etc.)
            $table->string('limite_contrat')->nullable(); // Limite du contrat (Illimitée, Variable selon la saison, etc.)
            $table->string('pays');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contracts');
    }
};

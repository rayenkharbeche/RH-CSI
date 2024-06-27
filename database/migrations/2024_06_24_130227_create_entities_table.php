<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntitiesTable extends Migration
{
    public function up()
    {
        Schema::create('entities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('tax_number');
            $table->string('address');
            $table->string('country');
            $table->string('contact_information');
            $table->string('employer_name');
            $table->string('employer_address');
            $table->string('siret_number');
            $table->string('ape_code');
            $table->string('collective_agreement');
            $table->string('establishment_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('entities');
    }
}

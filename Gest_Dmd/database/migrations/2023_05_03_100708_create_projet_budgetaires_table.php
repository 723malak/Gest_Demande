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
        Schema::create('projetBudgetaire', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('metiers_id');
            $table->foreign('metiers_id')->references('id')->on('metiers');
            $table->string('Nom_Projet');
            $table->integer('Num_Prj_budgtaire');
            $table->string('Type_Budge');
            $table->double('solde');
            $table->date('annee');
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
        Schema::dropIfExists('projetBudgetaire');
    }
};

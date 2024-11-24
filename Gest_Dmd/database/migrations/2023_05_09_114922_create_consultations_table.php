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
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pb');
            $table->foreign('id_pb')->references('id')->on('projetBudgetaire');
            $table->unsignedBigInteger('id_dmd');
            $table->foreign('id_dmd')->references('id')->on('demandes');
            $table->string('Cons_Directe');
            $table->string('Reception_Usine');
            $table->string('Note_Formation');
            $table->string('Plans');
            $table->string('Rapport_Informaif');
            $table->string('Revision_Prix');
            $table->string('Reunion_Visite');
            $table->string('Allotissement');
            $table->string('Critere_Attribution');
            $table->string('Offre_Variante');
            $table->string('Degre_priorite');
            $table->string('Periode_Garantie');
            $table->string('fiche_tec');
            $table->string('Documentation');
            $table->string('echantillons');
            $table->string('offre_technique');
            $table->integer('num_travail');
            $table->string('type_de_prestation');
            $table->string('nature_commande');
            $table->string('commentaire');
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
        Schema::dropIfExists('consultations');
    }
};

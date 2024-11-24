<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandesTable extends Migration
{
    public function up()
    {
        Schema::create('demandes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idUser');
            $table->foreign('idUser')->references('id')->on('users');
            $table->string('objet_demande');
            $table->string('cahier_charge');
            $table->date('date_demande')->nullable();
            $table->string('visa_hierarchie')->default('en cours de traitement');
            $table->boolean('comment_hierarchie')->nullable();
            $table->date('date_hierarchie')->nullable();
            $table->string('visa_achat')->default('en cours de traitement');
            $table->string('comment_achat')->nullable();
            $table->date('date_achat')->nullable();
            $table->string('visa_budget')->default('en cours de traitement');
            $table->string('comment_budget')->nullable();
            $table->date('date_budget')->nullable();
            $table->string('visa_daf')->default('en cours de traitement');
            $table->string('comment_daf')->nullable();
            $table->date('date_daf')->nullable();
            $table->string('visa_Dg')->default('en cours de traitement');
            $table->string('comment_Dg')->nullable();
            $table->date('date_Dg')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('demandes');
    }
}




<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjetBudgetaire extends Model
{
    use HasFactory;

    protected $table = 'projetBudgetaire';

    protected $fillable = [
        'metiers_id',
        'Nom_Projet',
        'Num_Prj_budgtaire',
        'Type_Budge',
        'solde',
        'annee',
    ];

    public function metiers()
    {
        return $this->belongsTo(Metier::class);
    }
}

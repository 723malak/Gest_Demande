<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_pb',
        'id_dmd',
        'Cons_Directe',
        'Reception_Usine',
        'Note_Formation',
        'Plans',
        'Rapport_Informaif',
        'Revision_Prix',
        'Reunion_Visite',
        'Allotissement',
        'Critere_Attribution',
        'Offre_Variante',
        'Degre_priorite',
        'Periode_Garantie',
        'fiche_tec',
        'Documentation',
        'echantillons',
        'offre_technique',
        'num_travail',
        'type_de_prestation',
        'nature_commande',
        'commentaire'
    ];

    public function projetBudgetaire()
    {
        return $this->belongsTo(ProjetBudgetaire::class, 'id_pb');
    }

    public function demande()
    {
        return $this->belongsTo(Demande::class, 'id_dmd');
    }
}

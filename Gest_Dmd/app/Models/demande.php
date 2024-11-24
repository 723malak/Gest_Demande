<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    use HasFactory;

    protected $fillable = [
        'idUser',
        'objet_demande',
        'cahier_charge',
        'date_demande',
        'visa_hierarchie',
        'comment_hierarchie',
        'date_hierarchie',
        'visa_achat',
        'comment_achat',
        'date_achat',
        'visa_budget',
        'comment_budget',
        'date_budget',
        'visa_daf',
        'comment_daf',
        'date_daf',
        'visa_Dg',
        'comment_Dg',
        'date_Dg',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'idUser');
    }
}

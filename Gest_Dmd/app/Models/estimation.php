<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estimation extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_consultation',
        'num_estimation',
        'total_estime',
        'total_DHHT',
        'TVA',
        'TotalDHTTC',
    ];

    public function consultation()
    {
        return $this->belongsTo(Consultation::class, 'id_consultation');
    }
}

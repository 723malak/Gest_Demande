<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    use HasFactory;

    protected $table = 'entities';

    protected $fillable = [
        'Nom',
        'type',
        'Responsable',
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
    ];
}

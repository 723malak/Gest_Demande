<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Metier;
use App\Models\Entite;


class User extends Authenticatable
{
    use Notifiable, HasRoles;

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $fillable = [
        'name',
        'Prenom',
        'Profil',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
        'metiers_id',
        'entites_id',
    ];

    // Relation avec la table metiers
    public function metier()
    {
        return $this->belongsTo(Metier::class, 'metiers_id');
    }
    
    public function entite()
    {
        return $this->belongsTo(Entite::class, 'entites_id');
    }
    
}

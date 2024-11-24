<?php

namespace App\Models;

use App\Models\Group;
use App\Models\Scopes\MetierScope;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Metier extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'code',
        'libelle',

    ];

public function groups():hasMany
    {
        return $this->hasMany(Group::class);
    }


    protected static function booted(): void
    {
       static::addGlobalScope(new MetierScope(Auth::user()));
    }

}

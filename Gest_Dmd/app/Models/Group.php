<?php

namespace App\Models;

use App\Models\Metier;
use App\Models\Famille;
use App\Models\Scopes\GroupScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Group extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'liblee',




    ];

    public function metiers():BelongsTo
    {
        return $this->belongsTo(Metier::class);
    }

protected static function booted(): void
{

        static::addGlobalScope(new GroupScope(Auth::user()));
}

   }

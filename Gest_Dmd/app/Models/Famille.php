<?php

namespace App\Models;

use App\Models\Group;
use App\Models\Article;
use App\Models\Scopes\FamilleScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Famille extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'liblee',

        'familles_id',
'groups_id',




    ];

    public function groups():BelongsTo
    {
       return $this->BelongsTo(Group::class);
    }






    protected static function booted(): void
{

        static::addGlobalScope(new FamilleScope(Auth::user()));
}
}

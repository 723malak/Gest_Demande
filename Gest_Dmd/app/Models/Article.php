<?php

namespace App\Models;


use App\Models\Segment;
use App\Models\Scopes\ArticleScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Article extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'liblee',
       'segments_id',
              'users_id',

    ];



     public function users():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function segments():BelongsTo
    {
        return $this->belongsTo(Segment::class);
    }



    protected static function booted(): void
{

        static::addGlobalScope(new ArticleScope(Auth::user()));
}
}


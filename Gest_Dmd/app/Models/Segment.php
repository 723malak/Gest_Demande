<?php

namespace App\Models;
use App\Models\Famille;
use App\Models\Scopes\SegmentScope;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Segment extends Model
{
    use HasFactory,HasRoles;

    protected $fillable = [

        'id',
        'code',
        'liblee',


    ];

    public function familles():BelongsTo
    {
        return $this->belongsTo(Famille::class);
    }




    public function canAccessFilament(): bool
    {
        //return str_ends_with($this->email, '@yourdomain.com') && $this->hasVerifiedEmail();
        return $this->hasRole(['admin','super-admin']);
    }
protected static function booted(): void
{


        static::addGlobalScope(new SegmentScope(Auth::user()));
}

}

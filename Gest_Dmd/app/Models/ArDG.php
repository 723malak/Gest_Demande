<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArDG extends Model
{
    use HasFactory;

    protected $table = 'argd';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['code', 'liblee', 'prix', 'metier_id'];

    public function metier()
    {
        return $this->belongsTo(Metier::class);
    }


}

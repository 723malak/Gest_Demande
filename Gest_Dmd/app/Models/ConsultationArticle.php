<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultationArticle extends Model
{
    use HasFactory;

    protected $table = 'consultation_articles';
    public $timestamps = true;

    protected $fillable = ['id_consultation', 'id_article', 'Qte', 'total'];


    public function consultation()
    {
        return $this->belongsTo(Consultation::class, 'id_consultation');
    }

    public function article()
    {
        return $this->belongsTo(Article::class, 'id_article');
    }
}

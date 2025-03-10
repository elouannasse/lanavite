<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Annonce extends Model
{
    use HasFactory;
    protected $table = "annonces";
    protected $fillable = [
        "titre",
        "description",
        "societe_id",
        "prix",
        "date_publication"
    ];

    public function societe()
    {
        return $this->belongsTo(Societe::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'annonce_tag');
    }
}
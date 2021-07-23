<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;
class Article extends Model
{
    use HasFactory;
    use Uuids;
    protected $table="articles";
    public function commande(){
        return $this->hasMany(Commande::Class,'article_id','id');
    }

    public function categories(){
        return $this->belongsTo(Categorie::Class,'categorie_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;
class Categorie extends Model
{
    use HasFactory;
    use Uuids;
    protected $table="categories";
    public function articles(){
        return $this->hasMany(Article::Class,'article_id','id');
    }
}

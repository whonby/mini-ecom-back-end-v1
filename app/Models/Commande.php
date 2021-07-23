<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;
class Commande extends Model
{
    use HasFactory;
    use Uuids;
    protected $table="commandes";
    
    public function article(){
        return $this->belongsTo(Article::Class,'article_id');
    }

    public function user(){
        return $this->belongsTo(User::Class,'user_id');
    }
}

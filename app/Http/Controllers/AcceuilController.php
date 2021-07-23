<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\Article;
use  App\Models\Categorie;
class AcceuilController extends Controller
{
    public function listeArticle(){
        $app= Article::with(['categories'])->orderBy('id',"DESC")->get();
        return response()->json($app);
    }

    public function listeGategorie(){
        $resultat=Categorie::orderBy('libelle', 'ASC')->get();

        return  response()->json($resultat);
    }

}

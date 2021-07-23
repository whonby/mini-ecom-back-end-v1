<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use  App\Models\Commande;
class CommandeController extends Controller
{
    public function index(){
        $app= Commande::with(['articles',"user"])->orderBy('id',"DESC")->get();
        return response()->json($app);
    }
    public function store(Request $request){
        $validator=Validator::make($request->all(),[
            'user_id'=>'required',
            'article_id'=>'required',
            'nombre'=>'required',
        ]);
        $app = New Commande();
      
        $app->user_id=$request->input("user_id");
        $app->article_id=$request->input("article_id");
        $app->nombre=$request->input("nombre");
        $app->statuts=0;
        $app->save();
        $app2=Categorie::with(['articles',"user"])->where("id",$app->id)->first();
        return response()->json($app2,201);
    }

    public function show($id)
    {
        $resultat=Commande::with(['articles',"user"])->where('id', $id)->first();
        return response()->json($resultat);
    }

    public function update(Request $request,$id){
        $validator=Validator::make($request->all(),[
            'user_id'=>'required',
            'article_id'=>'required',
            'nombre'=>'required',
        ]);
        $app =Commande::find($id);
        $app->user_id=$request->input("user_id");
        $app->article_id=$request->input("article_id");
        $app->nombre=$request->input("nombre");
        $app->statuts=$request->input("statuts");
        $app->save();
        $app2=Categorie::with(['articles',"user"])->where("id",$app->id)->first();
        return response()->json($app2);
    }


    public function destroy($id)
    {
        return Commande::destroy($id);

    }
}

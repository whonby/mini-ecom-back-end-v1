<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use  App\Models\Categorie;
use App\Repositories\Repository;
use Illuminate\Support\Facades\Validator;
class CategorieController extends Controller
{
    protected $model;
  
    public function __construct(Categorie $app){
        $this->middleware('auth:api', ['except' => ['login']]);
        $this->model = new Repository($app);
    }
   


    public function index(){
        $resultat=Categorie::orderBy('libelle', 'ASC')->get();

        return response()->json($resultat);
    }

    public function store(Request $request){
        $validator=Validator::make($request->all(),[
            'libelle'=>'required',
        ]);
    
        if($validator->fails()){
            return response()->json($validator->errors(),401);
        }

        $app = New Categorie();
        $app->libelle=$request->get("libelle");
        $app->save();
        $app2=Categorie::where("id",$app->id)->first();
       
        return response()->json($app2,201);
    }

    public function show($id)
    {
        $resultat=Categorie::where('id', $id)->first();
        return response()->json($resultat);

    }

    public function update(Request $request){
        $validator=Validator::make($request->all(),[
            'libelle'=>'required',
    
        ]);
        $app=Categorie::find($request->get("id"));
        $app->libelle=$request->get("libelle");
        $app->save();
       
        if($validator->fails()){
            return response()->json($validator->errors(),401);
        }
        $app2=Categorie::with(['articles'])->where("id",$app->id)->first();
        return response()->json($app2);

    }

    public function destroy($id)
    {
        return Categorie::destroy($id);

    }

}

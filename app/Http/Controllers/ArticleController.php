<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\Article;
use App\Repositories\Repository;
use Illuminate\Support\Facades\Validator;
class ArticleController extends Controller
{
    public function __construct(Article $app){
        $this->middleware('auth:api', ['except' => ['login']]);
        $this->model = new Repository($app);
    }
   
    public function index(){
        $app= Article::with(['categories'])->orderBy('id',"DESC")->get();
        return response()->json($app);
    }
    public function store(Request $request){
        $validator=Validator::make($request->all(),[
            'libelle'=>'required',
            'prix'=>'required',
        ]);
        $app = New Article();
        $nameTosore="";
        if ($request->hasFile('fichier')){
            $fullName=$request->file('fichier')->getClientOriginalName();
            $name=pathinfo($fullName,PATHINFO_FILENAME);
            $extension=$request->file('fichier')->getClientOriginalExtension();
            $nameTosore=$name.'_!'.time().'.'.$extension;
            $destination= public_path('images');
            $path=$request->file('fichier')->move($destination, $nameTosore);
        }
        
       
        $app->libelle=$request->input("libelle");
        $app->description=$request->input("description");
        $app->code="ART-".time();
       // $app->publier=0;
        $app->images=$nameTosore;
        $app->categorie_id=$request->input("categorie_id");;
        $app->prix=$request->input("prix");
        $app->save();
        $app2=Article::with(["categories"])->where("id",$app->id)->first();
        return response()->json($app2,201);
    }

    public function show($id)
    {
        $resultat=Article::with(["categories"])->where('id', $id)->first();
        return response()->json($resultat);
    }

    public function update(Request $request,$id){
        $validator=Validator::make($request->all(),[
            'libelle'=>'required',
            'prix'=>'required',
        ]);
        $app =Article::find($id);
        $nameTosore="";
        if ($request->hasFile('fichier')){
            $fullName=$request->file('fichier')->getClientOriginalName();
            $name=pathinfo($fullName,PATHINFO_FILENAME);
            $extension=$request->file('fichier')->getClientOriginalExtension();
            $nameTosore=$name.'_!'.time().'.'.$extension;
            $destination= public_path('images');
            $path=$request->file('fichier')->move($destination, $nameTosore);
            $app->images=$nameTosore;
        }
        $app->libelle=$request->input("libelle");
        $app->description=$request->input("description");
        $app->publier=$request->input("publier");
        $app->categorie_id=$request->input("categorie_id");;
        $app->prix=$request->input("prix");
        $app->save();
        $app2=Article::with(["categories"])->where("id",$app->id)->first();
        return response()->json($app2);
    }


    public function destroy($id)
    {
        return Article::destroy($id);

    }
}

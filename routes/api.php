<?php

use App\Http\Controllers\CommandeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategorieController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\AcceuilController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'api','prefix' => 'auth'], function ($router) {

    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);


    Route::get('/commande', [CommandeController::class, 'index']);
    Route::post('/commande', [CommandeController::class, 'store']);
    Route::put('/commande/{id}', [CommandeController::class, 'update']);
    Route::get('/commande/{id}', [CommandeController::class, 'show']);
    Route::delete('/commande/{id}', [CommandeController::class, 'destroy']);


    //Route::get('/article', [ArticleController::class, 'index']);
    Route::post('/article', [ArticleController::class, 'store']);
    Route::put('/article/{id}', [ArticleController::class, 'update']);
    Route::get('/article/{id}', [ArticleController::class, 'show']);
    Route::delete('/article/{id}', [ArticleController::class, 'destroy']);

   // Route::get('/categorie', [CategorieController::class, 'index']);
    Route::post('/categorie', [CategorieController::class, 'store']);
    Route::put('/categorie/{id}', [CategorieController::class, 'update']);
    Route::get('/categorie/{id}', [CategorieController::class, 'show']);
    Route::delete('/categorie/{id}', [CategorieController::class, 'destroy']);



    Route::get('/listeArticle', [AcceuilController::class, 'listeArticle']);
    Route::get('/listeCategorie', [AcceuilController::class, 'listeGategorie']);
});

    


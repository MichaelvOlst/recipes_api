<?php

namespace App\Http\Controllers\Api\Recipes;

use App\Models\Recipe;
use App\Http\Controllers\Controller;
use App\Http\Resources\RecipeResource;

class RecipesImagesController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Recipe $recipe)
    {
        dd($recipe);
        // return RecipeResource::collection(
        //     auth()->user()->recipes
        // );
    }

}

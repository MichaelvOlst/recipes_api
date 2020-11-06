<?php

namespace App\Http\Controllers\Api\Recipes;

use App\Models\Recipe;
use App\Http\Controllers\Controller;
use App\Http\Resources\RecipeResource;

class RecipesImagesController extends Controller
{
   /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Recipe $recipe)
    {
        // return response()->file($recipe->image);

        // return new RecipeResource($recipe);
    }

}

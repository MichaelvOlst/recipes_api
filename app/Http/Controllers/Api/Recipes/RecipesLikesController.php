<?php

namespace App\Http\Controllers\Api\Recipes;

use App\Models\Recipe;
use Illuminate\Http\Request;
use App\Events\RecipeCreated;
use App\Http\Controllers\Controller;
use App\Http\Resources\RecipeResource;

class RecipesLikesController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Recipe $recipe)
    {
        $recipe->increment('likes');

        return response(new RecipeResource($recipe->fresh()), 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recipe $recipe)
    {
        $recipe->decrement('likes');

        return response(new RecipeResource($recipe->fresh()), 201);
    }
}

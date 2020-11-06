<?php

namespace App\Http\Controllers\Api\Recipes;

use App\Models\Recipe;
use App\Http\Controllers\Controller;
use App\Http\Resources\RecipeResource;

class RecipesLikesController extends Controller
{
    /**
     * Update resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Recipe $recipe)
    {
        $this->authorize('update', $recipe);

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
        $this->authorize('delete', $recipe);

        $recipe->decrement('likes');

        return response(new RecipeResource($recipe->fresh()), 201);
    }
}

<?php

namespace App\Http\Controllers\Api\Recipes;

use App\Models\Recipe;
use App\Http\Controllers\Controller;

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
        $this->authorize('show', $recipe);

        return response()->file(storage_path('app/'.$recipe->image));
    }

}

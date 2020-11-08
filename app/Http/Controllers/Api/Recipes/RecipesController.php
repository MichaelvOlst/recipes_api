<?php

namespace App\Http\Controllers\Api\Recipes;

use App\Models\Recipe;
use Illuminate\Http\Request;
use App\Events\RecipeCreated;
use App\Http\Controllers\Controller;
use App\Http\Resources\RecipeResource;

class RecipesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return RecipeResource::collection(
            auth()->user()->recipes
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            // 'url' => 'required|url|unique:recipes,url',
        ]);

        $recipe = auth()->user()->recipes()->create([
            'url' => $request->url,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        event(new RecipeCreated($recipe));

        return response(new RecipeResource($recipe), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Recipe $recipe)
    {
        return new RecipeResource($recipe);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recipe $recipe)
    {
        $this->authorize('update', $recipe);

        $this->validate($request, [
            'url' => 'required|url',
            'title' => 'required',
            'description' => 'required',
        ]);

        $recipe->update([
            'url' => $request->url,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return response(new RecipeResource($recipe->fresh()), 200);
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

        $recipe->delete();

        return response(['success' => true], 200);
    }
}

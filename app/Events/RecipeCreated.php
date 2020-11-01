<?php

namespace App\Events;

use App\Models\Recipe;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class RecipeCreated
{
    use Dispatchable, SerializesModels;

    public $recipe;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Recipe $recipe)
    {
        $this->recipe = $recipe;
    }
}

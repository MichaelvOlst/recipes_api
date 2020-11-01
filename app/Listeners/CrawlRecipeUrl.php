<?php

namespace App\Listeners;

use App\Crawler\Crawler;
use App\Events\RecipeCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CrawlRecipeUrl
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  RecipeCreated  $event
     * @return void
     */
    public function handle(RecipeCreated $event)
    {
        $response = (new Crawler)->crawl($event->recipe->url);

        $recipe = $event->recipe;
        $recipe->title = $recipe->title ?? $response->title;
        $recipe->description =  $recipe->description ?? $response->description;
        $recipe->image =  $recipe->image ?? $response->image;
        $recipe->save();
    }
}

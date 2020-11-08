<?php

namespace App\Listeners;

use App\Crawler\Crawler;
use Illuminate\Http\File;
use Illuminate\Support\Str;
use App\Events\RecipeCreated;

use Illuminate\Support\Facades\Storage;
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
        $recipe->description = $recipe->description ?? $response->description;
        $recipe->image = $this->downloadFile($recipe->image ?? $response->image);
        $recipe->save();
    }

    protected function downloadFile($externalFile)
    {
        if(!$externalFile) {
            return;
        }

        if(!$contents = file_get_contents($externalFile)){
            return;
        }

        $path = parse_url($externalFile, PHP_URL_PATH);
        $extension = pathinfo($path, PATHINFO_EXTENSION);
        $filePath = 'recipes/'.Str::random(40).'.'.$extension;
        Storage::put($filePath, $contents);

        return $filePath;
    }
}

<?php

namespace App\Crawler;

class CrawlerResponse
{
    public $title;

    public $description;

    public $image;

    public function __construct(string $title, string $description, string $image)
    {
        $this->title = $title;

        $this->description = $description;

        $this->image = $image;
    }
}
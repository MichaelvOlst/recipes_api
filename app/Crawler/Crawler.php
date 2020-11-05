<?php

namespace App\Crawler;

use Spatie\Browsershot\Browsershot;
use Symfony\Component\DomCrawler\Crawler as SymfonyCrawler;

class Crawler
{
    const TITLE_FILTER_PATH = "//meta[@property='og:title']";
    const DESCRIPTION_TAG_FILTER_PATH = "//meta[@name='description']";
    const IMAGE_FILTER_PATH = "//meta[@property='og:image']";
    const DESCRIPTION_SOCIAL_FILTER_PATH = "//meta[@property='og:description']";

    protected SymfonyCrawler $crawler;

    public function crawl($url)
    {
        $html = Browsershot::url($url)->bodyHtml();

        $this->crawler = new SymfonyCrawler($html);

        // dd($this->getTitle(), $this->getDescription(), $this->getImage());

        return new CrawlerResponse(
            $this->getTitle(),
            $this->getDescription(),
            $this->getImage()
        );
    }


    protected function getTitle() : string
    {
        $title = collect($this->crawler->filterXpath(self::TITLE_FILTER_PATH)->extract(['content']))->first();
        if(!$title) {
            $title = $this->crawler->filter('title')->text();
        }

        return $title;
    }  


    protected function getDescription()
    {
        $description = collect($this->crawler->filterXpath(self::DESCRIPTION_TAG_FILTER_PATH)->extract(['content']))->first();
        if(!$description) {
           $description = collect($this->crawler->filterXpath(self::DESCRIPTION_SOCIAL_FILTER_PATH)->extract(['content']))->first();
        }

        return $description ?? "";
    }


    protected function getImage() : string
    {
        $image = collect($this->crawler->filterXpath("//meta[@property='og:image']")->extract(['content']))->first();
        if(!$image) {
            $image = $this->crawler->filter('img')->first()->extract(['src']);
        }

        dd($image);

        return $image;
    }
}
<?php

namespace App\Services;

use Goutte\Client;

class WebCrawler
{
    protected $client;
    protected $crawler;

    public function __construct()
    {
        $this->client = new Client();
    }

    // URL ko crawl karte hue, har blog ka data extract karna
    public function crawl($url)
    {
        $this->crawler = $this->client->request('GET', $url);
        // dd($this->crawler->node);
        // Har blog ko filter karte hue data extract karna
        if ($this->crawler->filter('article')->count() > 0) {
            $blogs = $this->crawler->filter('article')->each(function ($node) {
                return [
                    'title' => $node->filter('h2')->text(),
                    'content' => $node->filter('p')->text(),
                    'image' => $node->filter('img')->attr('src'),
                    'video' => $node->filter('video')->attr('src'),
                ];
            });
        } else {
            dd('No articles found!');
        }
        return $blogs;
    }
}

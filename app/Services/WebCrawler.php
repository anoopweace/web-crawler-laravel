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

    public function crawl($url)
    {
        $this->crawler = $this->client->request('GET', $url);

        // Yahan aap website ka HTML structure dekh kar appropriate selector use karenge
        // Example: Agar blog posts ko <article> tags me wrap kiya gaya hai
        $blogs = $this->crawler->filter('article')->each(function ($node) {
            return [
                'title' => $node->filter('h2')->text(), // Blog ka title
                'content' => $node->filter('p')->text(), // Blog ka content
                'image' => $node->filter('img')->attr('src'), // Image URL
                'video' => $node->filter('video')->attr('src'), // Video URL
            ];
        });

        return $blogs;
    }
}

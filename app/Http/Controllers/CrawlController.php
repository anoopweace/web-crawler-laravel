<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;
use App\Models\CrawledData;

class CrawlController extends Controller
{
    public function showForm()
    {
        // Show the form to input the URL
        return view('crawler.form');
    }

    public function crawlPage(Request $request)
    {
        $request->validate([
            'url' => 'required|url', // Validate the URL input
        ]);

        $url = $request->input('url');

        // Initialize Goutte client
        $client = new Client();

        try {
            // Request the target page
            $crawler = $client->request('GET', $url);

            // Extract links
            $links = $crawler->filter('a')->each(function ($node) {
                return $node->attr('href');
            });

            // Extract headings
            $headings = $crawler->filter('h1, h2, h3, h4, h5, h6')->each(function ($node) {
                return $node->text();
            });

            // Extract paragraphs
            $paragraphs = $crawler->filter('p')->each(function ($node) {
                return $node->text();
            });

            // Extract images
            $images = $crawler->filter('img')->each(function ($node) use ($url) {
                $src = $node->attr('src') ?: $node->attr('data-src') ?: $node->attr('data-original');
                return $this->makeAbsoluteUrl($src, $url);
            });
    
            // Extract video URLs
            $videos = $crawler->filter('video source')->each(function ($node) use ($url) {
                $src = $node->attr('src') ?: $node->attr('data-src') ?: $node->attr('data-original');
                return $this->makeAbsoluteUrl($src, $url);
            });

            // Convert relative URLs to absolute
            // $media = collect(array_merge($images, $videos))->map(function ($link) use ($url) {
            //     return filter_var($link, FILTER_VALIDATE_URL) ? $link : url($link, $url);
            // })->toArray();

            // Serialize the extracted data to store in the database
            CrawledData::create([
                'url' => $url,
                'links' => json_encode($links),
                'headings' => json_encode($headings),
                'paragraphs' => json_encode($paragraphs),
                'images' => json_encode($images),
                'videos' => json_encode($videos),
            ]);

            // Retrieve the stored data
            $data = CrawledData::where('url', $url)->get();

            // Pass the data to a results view
            // return view('crawler.stored-data', compact('data'));
            return response()->json([
                'status' => 'success',
                'links' => $links,
                'headings' => $headings,
                'paragraphs' => $paragraphs,
                'images' => $images,
                'videos' => $videos,
            ]);
        } catch (\Exception $e) {
            // Handle errors
            return redirect()->back()->withErrors(['error' => 'Failed to crawl the page: ' . $e->getMessage()]);
        }
    }

    private function makeAbsoluteUrl($link, $baseUrl)
    {
    // Use PHP's built-in parse_url() and filter_var() functions
    return filter_var($link, FILTER_VALIDATE_URL) ? $link : rtrim($baseUrl, '/') . '/' . ltrim($link, '/');
    }
}

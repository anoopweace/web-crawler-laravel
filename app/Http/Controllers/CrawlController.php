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
        $url = $request->input('url');

        // Initialize Goutte client
        $client = new Client();

        try {
            // Request the target page
            $crawler = $client->request('GET', $url);

            // Extract links, headings, and paragraphs
            $links = $crawler->filter('a')->each(function ($node) {
                return $node->attr('href');
            });

            $headings = $crawler->filter('h1')->each(function ($node) {
                return $node->text();
            });

            $paragraphs = $crawler->filter('p')->each(function ($node) {
                return $node->text();
            });

            // Store in database
            CrawledData::create([
                'url' => $url,
                'links' => $links,
                'headings' => $headings,
                'paragraphs' => $paragraphs,
            ]);

            $data = CrawledData::where('url',$url)->get();
            

            // Pass the data to a results view
            return view('crawler.stored-data', [
                'url' => $data,
                
            ]);
        } catch (\Exception $e) {
            // Handle errors
            return redirect()->back()->withErrors(['error' => 'Failed to crawl the page: ' . $e->getMessage()]);
        }
    }
}

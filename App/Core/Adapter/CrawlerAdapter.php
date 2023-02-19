<?php

namespace app\Core\Adapter;

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

class CrawlerAdapter
{
    private Client $client;
    private Crawler $crawler;
    private string $url;

    public function __construct(string $url)
    {
        $this->client = new Client();
        $this->url = $url;
        $this->crawler = $this->client->request('GET', config('goutte.url') . $this->url);
    }

    public function getTitle(string $selector)
    {
        return $this->crawler->filter($selector)->text();
    }

    public function getBody(string $selector)
    {
        $summary = $this->crawler->filter($selector)->nextAll();
        $nodes = [];
        $pNodes = $summary->each(function ($node, $i) use ($nodes) {
            if ($node->matches('p')) {
                $nodes[$i] = $node->text();
            }
            return $nodes;
        });

        return array_filter($pNodes, fn ($value) => !empty($value));
    }
}

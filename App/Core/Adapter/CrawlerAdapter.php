<?php

namespace app\Core\Adapter;

use Exception;
use Goutte\Client;
use LogicException;
use RuntimeException;
use InvalidArgumentException;
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

    public function getTitle(string $selector): string
    {
        try {
            $title = $this->crawler->filter($selector)->text();
        } catch (LogicException $e) {
            $title = '';
        } catch (InvalidArgumentException  $e) {
            $title = '';
        } catch (Exception $e) {
            $title = '';
        }
        return ($title === 'Main Page') ? '' : $title;
    }

    public function getBody(string $selector): array
    {
        try {
            $summary = $this->crawler->filter($selector)->nextAll();
        } catch (InvalidArgumentException  $e) {
            return [];
        }

        $nodes = [];
        $pNodes = $summary->nextAll()->each(function ($node, $i) use ($nodes) {
            if ($node->matches('p')) {
                $nodes[$i] = $node->text();
            }
            return $nodes;
        });

        return array_filter($pNodes, fn ($value) => !empty($value));
    }
}

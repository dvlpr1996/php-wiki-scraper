<?php

namespace app\Controllers;

use Goutte\Client;
use app\Requests\CrawlerRequest;
use app\Controllers\BaseController;
use app\Core\Adapter\ValidatorAdapter;
use Symfony\Component\HttpFoundation\Request;

class CrawlerController extends BaseController
{
    public function __construct(
        private $validation = new ValidatorAdapter,
        private $client = new Client()
    ) {
    }

    public function crawler(Request $request)
    {
        $errors  = $this->validation->validate(CrawlerRequest::class);

        $crawler = $this->client->request('GET', config('goutte.url') . $this->get($request, 'input'));

        $title = $crawler->filter('.firstHeading.mw-first-heading > .mw-page-title-main')->text();
        $summary = $crawler->filter('.mw-parser-output table.infobox')->nextAll();
        $nodes = [];
        $pNodes = $summary->each(function ($node, $i) use ($nodes) {
            if ($node->matches('p')) {
                $nodes[$i] = $node->text();
            }
            return $nodes;
        });

        $pNodes = array_filter($pNodes, fn ($value) => !empty($value));

        return $this->view('index', compact('errors', 'pNodes', 'title'));
    }
}

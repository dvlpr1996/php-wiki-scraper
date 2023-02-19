<?php

namespace app\Controllers;

use app\Requests\CrawlerRequest;
use app\Controllers\BaseController;
use app\Core\Adapter\CrawlerAdapter;
use app\Core\Adapter\ValidatorAdapter;
use Symfony\Component\HttpFoundation\Request;

class CrawlerController extends BaseController
{
    public function __construct(
        private $validation = new ValidatorAdapter,
    ) {
    }

    public function crawler(Request $request)
    {
        $errors  = $this->validation->validate(CrawlerRequest::class);

        $client = new CrawlerAdapter($this->get($request, 'input'));

        $title = $client->getTitle('.firstHeading.mw-first-heading > .mw-page-title-main');
        $pNodes = $client->getBody('.mw-parser-output table.infobox');

        return $this->view('index', compact('errors', 'pNodes', 'title'));
    }
}

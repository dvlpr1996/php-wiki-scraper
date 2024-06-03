<?php

namespace app\Controllers;

use app\Requests\CrawlerRequest;
use app\Controllers\BaseController;
use app\Core\Adapter\CrawlerAdapter;
use app\Core\Adapter\ValidatorAdapter;
use Symfony\Component\HttpFoundation\Request;

class CrawlerController extends BaseController
{
    const TITLE =  '.firstHeading.mw-first-heading > .mw-page-title-main';
    const BODY =  '.mw-parser-output table.infobox';

    public function __construct(
        private $validation = new ValidatorAdapter,
    ) {
    }

    public function crawler(Request $request)
    {
        $errors  = $this->validation->validate(CrawlerRequest::class);

        $client = new CrawlerAdapter($request->request->get('input'));

        $hTitle = $client->getTitle(self::TITLE);
        $pNodes = $client->getBody(self::BODY);

        return $this->view('index', compact('errors', 'pNodes', 'hTitle'));
    }
}

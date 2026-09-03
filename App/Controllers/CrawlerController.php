<?php

declare(strict_types=1);

namespace app\Controllers;

use app\Controllers\BaseController;
use app\Core\Adapter\CrawlerAdapter;
use app\Core\Adapter\ValidatorAdapter;
use app\exceptions\ValidationException;
use app\Requests\CrawlerRequest;
use Exception;
use Symfony\Component\HttpFoundation\Request;

class CrawlerController extends BaseController
{
    const string TITLE =  '.firstHeading.mw-first-heading > .mw-page-title-main';
    const string BODY =  '.mw-parser-output table.infobox';

    public function __construct(
        private $validation = new ValidatorAdapter,
    ) {}

    public function crawler(Request $request)
    {
        try {
            $validation_errors  = $this->validation->validate(CrawlerRequest::class);

            if ($validation_errors !== null) {
                throw new ValidationException($validation_errors);
            }

            $errors = 'This library (goutte) is deprecated, please used version 2 of ' . APP_NAME;
            // $client = new CrawlerAdapter($request->request->get('input'));
            // $hTitle = $client->getTitle(self::TITLE);
            // $pNodes = $client->getBody(self::BODY);

            return $this->view('index', compact('errors'));
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }
}

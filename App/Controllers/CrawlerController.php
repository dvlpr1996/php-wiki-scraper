<?php

namespace app\Controllers;

use Buki\Router\Http\Controller;
use Symfony\Component\HttpFoundation\Request;

class CrawlerController extends Controller
{
    public function crawler(Request $request)
    {
        dd($request);
    }
}

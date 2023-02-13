<?php

namespace app\Controllers;

use Buki\Router\Http\Controller;
use Symfony\Component\HttpFoundation\Request;

class ActionController extends Controller
{
    public function index()
    {
        include_once APP_BASE_PATH . 'Resources/index.php';
    }

    public function crawler(Request $request) {
        dd($request);
    }
}

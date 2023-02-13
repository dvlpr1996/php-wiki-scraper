<?php

namespace app\Controllers;

use Buki\Router\Http\Controller;
use Symfony\Component\HttpFoundation\Request;

class ActionController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function crawler(Request $request)
    {
        dd($request);
    }

    public function home()
    {
        dd('home');
    }
}

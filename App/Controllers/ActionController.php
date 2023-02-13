<?php

namespace app\Controllers;

use Buki\Router\Http\Controller;

class ActionController extends Controller
{
    public function index()
    {
        return view('index');
    }
}

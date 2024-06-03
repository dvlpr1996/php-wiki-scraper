<?php

namespace app\Controllers;

use Buki\Router\Http\Controller;
use Symfony\Component\HttpFoundation\Request;

class BaseController extends Controller
{
    protected function view(string $path, array $data = [])
    {
        return view($path, $data);
    }
}

<?php

namespace app\Controllers;

use Buki\Router\Http\Controller;
use Symfony\Component\HttpFoundation\Request;

class BaseController extends Controller
{
    protected function view(string $path, array $data = []): void
    {
        view($path, $data);
    }

    protected function allRequest(Request $request): array
    {
        return $request->request->all();
    }

    protected function get(Request $request, string $item): string
    {
        return $request->request->get($item);
    }
}

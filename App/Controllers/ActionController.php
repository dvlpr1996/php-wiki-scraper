<?php

namespace app\Controllers;

use app\Controllers\BaseController;

class ActionController extends BaseController
{
    public function index()
    {
        return $this->view('index');
    }
}

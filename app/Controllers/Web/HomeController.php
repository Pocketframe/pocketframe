<?php

namespace App\Controllers\Web;

use Pocketframe\Http\Response\Response;

class HomeController
{
    public function index()
    {
        return Response::view('welcome', [
            'title' => 'Welcome',
            'message' => 'Hello from the framework!'
        ]);
    }
}

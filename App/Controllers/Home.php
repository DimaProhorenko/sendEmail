<?php

namespace App\Controllers;

use App\Core\Route;

class Home
{
    #[Route('/')]
    public function index()
    {
        echo 'Hello';
    }
}

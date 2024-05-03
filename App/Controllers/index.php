<?php

namespace App\Controllers;

use Core\Route;

class Index
{
    #[Route('/')]
    public function index()
    {
        echo 'Hello';
    }
}

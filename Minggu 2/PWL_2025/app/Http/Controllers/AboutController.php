<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function __invoke()
    {
        return 'Nama: Gilang Purnomo <br> NIM: 2341720042';
    }
}

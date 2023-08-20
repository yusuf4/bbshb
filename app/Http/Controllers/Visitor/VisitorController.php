<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class VisitorController extends Controller
{
    public function index()
    {
        return Inertia::render('Visitors/DujonibaV', [

        ]);
    }

    public function bindex()
    {
        return Inertia::render('Visitors/BisyorjonibaV', [

        ]);
    }

}

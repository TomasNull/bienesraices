<?php

namespace App\Http\Controllers;

use App\RealEstate;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $realestate = RealEstate::withCount(['clients'])
            ->with('category', 'agent', 'reviews')
            ->where('status', RealEstate::PUBLISHED)
            ->latest()
            ->paginate(9);

        return view('home', compact('realestate'));
    }
}

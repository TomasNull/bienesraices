<?php

namespace App\Http\Controllers;

use App\RealEstate;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function estates()
    {
        $realestate = RealEstate::withCount(['clients'])
            ->with('category', 'agent', 'reviews')
            ->where('status', RealEstate::PUBLISHED)
            ->latest()
            ->paginate(20);

        return view('clients.estates', compact('realestate'));
    }
}

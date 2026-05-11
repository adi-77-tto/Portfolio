<?php

namespace App\Http\Controllers;

use App\Models\Research;

class ResearchController extends Controller
{
    public function show(Research $research)
    {
        return view('research.show', compact('research'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Skill;

class SkillController extends Controller
{
    public function index()
    {
        return response()->json([
            'skills' => Skill::query()->orderBy('category')->orderBy('name')->get(),
        ]);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use App\Models\Message;
use App\Models\Project;
use App\Models\Skill;
use App\Models\WorkExperience;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'stats' => [
                'projects' => Project::query()->count(),
                'skills' => Skill::query()->count(),
                'achievements' => Achievement::query()->count(),
                'workExperience' => WorkExperience::query()->count(),
                'unreadMessages' => Message::query()->whereNull('read_at')->count(),
            ],
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Education;
use App\Models\Project;
use App\Models\Skill;
use App\Models\WorkExperience;
use Illuminate\Support\Collection;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProjects = Project::query()->where('featured', true)->latest()->take(6)->get();

        $heroSlides = Project::query()
            ->with(['images' => fn ($query) => $query->orderBy('sort_order')])
            ->latest()
            ->get()
            ->flatMap(function (Project $project): Collection {
                $galleryImages = $project->images
                    ->pluck('image_path')
                    ->map(fn (string $path) => $this->resolveImageUrl($path));

                if ($galleryImages->isNotEmpty()) {
                    return $galleryImages;
                }

                if (filled($project->image)) {
                    return collect([$this->resolveImageUrl($project->image)]);
                }

                return collect();
            })
            ->filter()
            ->unique()
            ->values();

        $heroImages = \App\Models\HeroImage::all();

        $settings = [
            'name' => \App\Models\Setting::get('name', 'Aditto Saha'),
            'title' => \App\Models\Setting::get('title', 'Incoming SE BSc @nstu'),
            'bio' => \App\Models\Setting::get('bio', 'Incoming Software Engineering graduate focused on web and application development, with a passion for building scalable and user-friendly software solutions. Experienced in C++, Java, and SQL, with a strong foundation in system design, SRS documentation, and UML modeling. I actively work on real-world projects and continuously explore full-stack development to create efficient, practical, and impactful applications.'),
            'image' => \App\Models\Setting::get('hero_image', null),
            'image_caption' => \App\Models\Setting::get('image_caption', ''),
            'resume' => \App\Models\Setting::get('resume_file', null),
        ];

        return view('home', [
            'settings' => $settings,
            'isHomeHero' => true,
            'featuredProjects' => $featuredProjects,
            'skills' => Skill::query()->orderBy('category')->orderBy('name')->get()->groupBy('category'),
            'achievements' => Achievement::query()->latest('date')->take(5)->get(),
            'heroSlides' => $heroSlides,
            'heroImages' => $heroImages,
            'research' => \App\Models\Research::all(),
            'education' => Education::all(),
            'workExperience' => WorkExperience::all(),
        ]);
    }

    public function about()
    {
        return view('about');
    }

    private function resolveImageUrl(?string $path): ?string
    {
        if (! filled($path)) {
            return null;
        }

        if (preg_match('/^https?:\/\//i', $path)) {
            return $path;
        }

        return \Illuminate\Support\Facades\Storage::url($path);
    }
}

@extends('layouts.app')

@section('content')
<style>
    /* Ensure no scrollbar is forced initially unless needed */
    html, body {
        margin: 0; padding: 0;
        background-color: transparent !important;
    }
    
    .portfolio-hero {
        background-color: #0c0e12;
        color: #e5e7eb;
        min-height: 100vh;
        font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        position: relative;
        display: flex;
        flex-direction: column;
    }
    
    .portfolio-hero[data-theme='light'] {
        background-color: #f3f4f6;
        color: #111827;
    }

    [data-theme='light'] .navbar-bottom {
        background: rgba(255, 255, 255, 0.8) !important;
        border-color: #e5e7eb !important;
        color: #374151 !important;
    }
    
    [data-theme='light'] .navbar-bottom a, 
    [data-theme='light'] .navbar-bottom button {
        color: #374151;
    }

    [data-theme='light'] .navbar-bottom a.active {
        color: #2563eb;
    }

    .main-container {
        flex: 1;
        display: grid;
        grid-template-columns: 1fr 1fr;
        padding: 5rem 6%;
        gap: 3rem;
        align-items: center;
        max-width: 1400px;
        margin: 0 auto;
        width: 100%;
        min-height: 100vh;
    }

    @media (max-width: 992px) {
        .main-container {
            grid-template-columns: 1fr;
            padding-bottom: 8rem;
            padding-top: 2rem;
        }
        .hero-right {
            order: -1;
            margin-bottom: 2rem;
        }
    }

    /* Left Side Typography & Colors */
    .hero-left {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .hero-badge {
        display: inline-block;
        border: 1px solid rgba(59, 130, 246, 0.4);
        background: rgba(30, 58, 138, 0.2);
        color: #60a5fa;
        padding: 0.4rem 1.2rem;
        border-radius: 9999px;
        font-size: 0.875rem;
        font-weight: 500;
        margin-bottom: 1.5rem;
        width: fit-content;
    }

    [data-theme='light'] .hero-badge {
        color: #1d4ed8;
        background: #eff6ff;
        border-color: #bfdbfe;
    }

    .hero-name {
        font-family: ui-serif, Georgia, Cambria, "Times New Roman", Times, serif;
        font-size: clamp(3rem, 6vw, 4.5rem);
        font-weight: 700;
        line-height: 1.1;
        margin-bottom: 0.5rem;
        color: #f3f4f6;
    }

    [data-theme='light'] .hero-name {
        color: #111827;
    }

    .hero-title {
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        color: #e5e7eb;
    }

    [data-theme='light'] .hero-title {
        color: #374151;
    }

    .hero-title span {
        color: #3b82f6; 
    }

    .hero-bio {
        font-size: 0.95rem;
        line-height: 1.6;
        color: #9ca3af;
        margin-bottom: 2rem;
        max-width: 42rem;
    }

    [data-theme='light'] .hero-bio {
        color: #4b5563;
    }

    /* Action Buttons */
    .btn-actions {
        display: flex;
        gap: 1rem;
        margin-bottom: 3rem;
        align-items: center;
    }

    .btn-primary {
        background-color: #2563eb;
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        font-weight: 600;
        text-decoration: none;
        transition: background-color 0.2s;
        border: none;
        cursor: pointer;
    }

    .btn-primary:hover {
        background-color: #1d4ed8;
    }

    .btn-outline {
        background-color: transparent;
        color: #e5e7eb;
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        font-weight: 600;
        text-decoration: none;
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.2s;
    }

    [data-theme='light'] .btn-outline {
        color: #111827;
        border-color: #d1d5db;
    }

    .btn-outline:hover {
        background-color: rgba(255, 255, 255, 0.05);
    }
    
    [data-theme='light'] .btn-outline:hover {
        background-color: #f3f4f6;
    }

    /* Social Links */
    .social-links {
        display: flex;
        gap: 1.5rem;
        flex-wrap: wrap;
    }

    .social-links a {
        color: #9ca3af;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.9rem;
        transition: color 0.2s;
        font-weight: 500;
    }

    [data-theme='light'] .social-links a {
        color: #6b7280;
    }

    .social-links a:hover {
        color: #f3f4f6;
    }

    [data-theme='light'] .social-links a:hover {
        color: #111827;
    }

    .social-icon {
        width: 20px; height: 20px;
        fill: currentColor;
    }

    /* Right Side Image */
    .hero-right {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .hero-image-wrapper {
        position: relative;
        border-radius: 1.5rem;
        overflow: hidden;
        background-color: #1f2937;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.4);
        width: 100%;
        max-width: 500px;
    }

    [data-theme='light'] .hero-image-wrapper {
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
    }

    .hero-image {
        width: 100%;
        height: auto;
        display: block;
        aspect-ratio: 4/5;
        object-fit: cover;
    }

    .image-caption {
        text-align: center;
        margin-top: 1rem;
        font-size: 0.85rem;
        color: #6b7280;
        font-style: italic;
    }

    /* Robot Icon */
    .robot-icon {
        width: 60px;
        margin-bottom: 1rem;
        margin-left: 2rem;
    }

    /* Bottom Navbar */
    .navbar-bottom {
        position: fixed;
        bottom: 2rem;
        left: 50%;
        transform: translateX(-50%);
        background: rgba(17, 24, 39, 0.8);
        backdrop-filter: blur(12px);
        padding: 0.5rem 1.5rem;
        border-radius: 9999px;
        display: flex;
        gap: 1.5rem;
        align-items: center;
        border: 1px solid rgba(255, 255, 255, 0.1);
        z-index: 50;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }

    .navbar-bottom a, .navbar-bottom button {
        color: #9ca3af;
        text-decoration: none;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.2rem;
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        background: none;
        border: none;
        cursor: pointer;
        transition: color 0.2s;
        padding: 0.5rem;
    }
    
    .navbar-bottom a:hover, .navbar-bottom button:hover, .navbar-bottom a.active {
        color: #60a5fa;
    }

    .nav-icon {
        width: 20px;
        height: 20px;
        stroke: currentColor;
        stroke-width: 1.5;
        fill: none;
    }

    /* Floating Chat */
    .floating-chat {
        position: fixed;
        bottom: 2rem;
        right: 2rem;
        background: rgba(17,24,39,0.8);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 50%;
        width: 60px; height: 60px;
        display: grid;
        place-items: center;
        cursor: pointer;
        z-index: 50;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }
    .floating-chat svg {
        width: 32px; height: 32px; color: #ef4444; margin-left: -5px; fill: currentColor;
    }

    /* Resume Modal */
    .resume-modal {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.85);
        backdrop-filter: blur(8px);
        z-index: 9999;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .resume-modal.show {
        display: flex;
        opacity: 1;
    }

    .resume-modal-content {
        width: 90%;
        max-width: 900px;
        height: 90vh;
        display: flex;
        flex-direction: column;
        position: relative;
    }

    .resume-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 0;
        color: white;
    }

    .resume-title {
        font-size: 1.5rem;
        font-weight: 700;
        font-family: ui-serif, Georgia, serif;
    }

    .resume-actions {
        display: flex;
        gap: 1rem;
    }
    
    .btn-close-modal {
        background: rgba(255,255,255,0.1);
        color: white;
        border: none;
        width: 40px; height: 40px;
        border-radius: 50%;
        display: grid;
        place-items: center;
        cursor: pointer;
        transition: background 0.2s;
    }
    .btn-close-modal:hover { background: rgba(255,255,255,0.2); }

    .resume-viewer {
        flex: 1;
        background: white;
        border-radius: 8px;
        overflow: auto;
        position: relative;
        display: flex;
        justify-content: center;
    }
    
    .resume-viewer img, .resume-viewer iframe {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }
</style>

<div class="portfolio-hero" data-theme="dark" id="hero-section">
    <div class="main-container">
        <!-- Left Column -->
        <div class="hero-left">
            <div class="hero-badge">Hello, I'm</div>
            <h1 class="hero-name">{{ $settings['name'] ?? 'Aditto Saha' }}</h1>
            <div class="hero-title">
                {!! str_replace('@nstu', '<a href="https://www.nstu.edu.bd/" target="_blank" style="color: #3b82f6; text-decoration: none;">@nstu</a>', $settings['title'] ?? 'Incoming SE BSc @nstu') !!}
            </div>
            
            <div class="hero-bio">
                {{ $settings['bio'] ?? 'Incoming Software Engineering graduate focused on web and application development, with a passion for building scalable and user-friendly software solutions. Experienced in C++, Java, and SQL, with a strong foundation in system design, SRS documentation, and UML modeling. I actively work on real-world projects and continuously explore full-stack development to create efficient, practical, and impactful applications.' }}
            </div>

            <!-- Mascot/Robot Image Placeholder -->
            <img src="data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><rect width='100' height='100' fill='transparent'/><path d='M25 60 C 25 30, 75 30, 75 60 L 75 80 C 75 90, 25 90, 25 80 Z' fill='%23a3e635'/><rect x='35' y='50' width='10' height='5' rx='2' fill='%23111827'/><rect x='55' y='50' width='10' height='5' rx='2' fill='%23111827'/><path d='M 40 70 Q 50 80 60 70' fill='none' stroke='%23111827' stroke-width='4' stroke-linecap='round'/></svg>" alt="Mascot" class="robot-icon" style="width: 50px;">

            <div class="btn-actions">
                <button class="btn-primary" id="open-resume-btn">View Resume</button>
                <a href="{{ route('contact.index') }}" class="btn-outline">Get in Touch</a>
            </div>

            <div class="social-links">
                @if(!empty($settings['social_scholar']))
                <a href="{{ $settings['social_scholar'] }}" target="_blank">
                    <svg class="social-icon" viewBox="0 0 24 24"><path d="M12 24a7 7 0 1 1 0-14 7 7 0 0 1 0 14zm0-22C5.373 2 0 7.373 0 14s5.373 12 12 12 12-5.373 12-12S18.627 2 12 2zm0 18a5 5 0 1 0 0-10 5 5 0 0 0 0 10z"/></svg> 
                    Google Scholar
                </a>
                @endif
                @if(!empty($settings['social_linkedin']))
                <a href="{{ $settings['social_linkedin'] }}" target="_blank">
                    <svg class="social-icon" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg> 
                    LinkedIn
                </a>
                @endif
                @if(!empty($settings['social_github']))
                <a href="{{ $settings['social_github'] }}" target="_blank">
                    <svg class="social-icon" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg> 
                    GitHub
                </a>
                @endif
                @if(!empty($settings['social_orcid']))
                <a href="{{ $settings['social_orcid'] }}" target="_blank">
                    <svg class="social-icon" viewBox="0 0 24 24"><path d="M12 0C5.372 0 0 5.372 0 12s5.372 12 12 12 12-5.372 12-12S18.628 0 12 0zM7.369 4.378c.525 0 .947.431.947.947s-.422.947-.947.947a.95.95 0 0 1-.947-.947c0-.525.422-.947.947-.947zm-.722 3.038h1.444v10.041H6.647V7.416zm3.562 0h2.9c3.275 0 4.887 2.081 4.887 5.02 0 2.938-2.025 5.023-4.887 5.023h-2.9V7.416zm1.444 1.503v7.037h1.456c1.687 0 3.325-1 3.325-3.518 0-2.613-1.638-3.519-3.325-3.519h-1.456z"/></svg> 
                    ORCID
                </a>
                @endif
            </div>
        </div>

        <!-- Right Column (Image) -->
        <div class="hero-right">
            <div class="hero-image-wrapper" id="heroImageWrapper">
                @if($heroImages->count() > 0)
                    @php $firstImage = $heroImages->first(); @endphp
                    <img id="heroMainImage" src="{{ asset($firstImage->image_path) }}" alt="Hero Image" class="hero-image">
                    @if($firstImage->description)
                        <div style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(to top, rgba(0,0,0,0.8), transparent); padding: 2rem 1rem 1rem; color: white; font-size: 0.9rem; border-radius: 0 0 1.5rem 1.5rem;">
                            {{ $firstImage->description }}
                        </div>
                    @endif
                    @if($heroImages->count() > 1)
                        <div style="position: absolute; top: 1rem; right: 1rem; background: rgba(0,0,0,0.6); padding: 0.5rem 1rem; border-radius: 9999px; color: white; font-size: 0.85rem; font-weight: 600;">
                            <span id="heroImageCounter">1</span> / {{ $heroImages->count() }}
                        </div>
                        <button onclick="previousHeroImage()" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); background: rgba(0,0,0,0.6); border: none; color: white; width: 40px; height: 40px; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: background 0.2s;">
                            <svg style="width: 20px; height: 20px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"></polyline></svg>
                        </button>
                        <button onclick="nextHeroImage()" style="position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); background: rgba(0,0,0,0.6); border: none; color: white; width: 40px; height: 40px; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: background 0.2s;">
                            <svg style="width: 20px; height: 20px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </button>
                    @endif
                @else
                    <!-- Fallback placeholder if no image is uploaded -->
                    <img src="https://images.unsplash.com/photo-1541364983171-a8ba01e95cfc?auto=format&fit=crop&q=80&w=800" alt="Placeholder" class="hero-image">
                    <div style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(to top, rgba(0,0,0,0.8), transparent); padding: 2rem 1rem 1rem; color: white; font-size: 0.9rem; border-radius: 0 0 1.5rem 1.5rem;">
                        Your portfolio hero image
                    </div>
                @endif
            </div>
            @if($heroImages->count() > 0 && $heroImages->first()->description)
                <div class="image-caption">{{ $heroImages->first()->description }}</div>
            @endif
        </div>
    </div>

    <script>
        let currentHeroIndex = 0;
        const heroImages = @json($heroImages->map(fn($img) => ['path' => asset($img->image_path), 'description' => $img->description]));

        function updateHeroImage() {
            if (heroImages.length === 0) return;
            
            const currentImage = heroImages[currentHeroIndex];
            document.getElementById('heroMainImage').src = currentImage.path;
            document.getElementById('heroImageCounter').textContent = currentHeroIndex + 1;

            // Update description if exists
            const descriptionDiv = document.querySelector('#heroImageWrapper div[style*="bottom: 0"]');
            if (descriptionDiv && currentImage.description) {
                descriptionDiv.textContent = currentImage.description;
            }
        }

        function nextHeroImage() {
            if (heroImages.length > 1) {
                currentHeroIndex = (currentHeroIndex + 1) % heroImages.length;
                updateHeroImage();
            }
        }

        function previousHeroImage() {
            if (heroImages.length > 1) {
                currentHeroIndex = (currentHeroIndex - 1 + heroImages.length) % heroImages.length;
                updateHeroImage();
            }
        }

        // Auto-rotate hero images every 5 seconds (optional)
        // setInterval(nextHeroImage, 5000);
    </script>
    

    <!-- Bottom Navigation -->
    <nav class="navbar-bottom">
        <a href="{{ route('home') }}" class="active">
            <svg class="nav-icon" viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V9z"></path></svg>
            Home
        </a>
        <a href="#research">
            <svg class="nav-icon" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
            Research
        </a>
        <a href="#education">
            <svg class="nav-icon" viewBox="0 0 24 24"><path d="M22 10v6M2 10l10-5 10 5-10 5z"></path></svg>
            Education
        </a>
        <a href="#work-experience">
            <svg class="nav-icon" viewBox="0 0 24 24"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
            Experience
        </a>
        <a href="#featured-projects">
            <svg class="nav-icon" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect></svg>
            Projects
        </a>
        <button id="theme-toggle">
            <svg class="nav-icon" id="sun-icon" viewBox="0 0 24 24"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="19.78" x2="19.78" y2="18.36"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="4.22" x2="19.78" y2="5.64"></line></svg>
        </button>
    </nav>

    <!-- Floating Chat -->
    <div class="floating-chat">
        <svg viewBox="0 0 24 24"><path d="M12 2a10 10 0 0 1 10 10c0 5.523-4.477 10-10 10a9.96 9.96 0 0 1-4.708-1.173L2 22l1.64-4.8A9.965 9.965 0 0 1 2 12C2 6.477 6.477 2 12 2z"></path></svg>
    </div>
</div>

<!-- Resume Modal -->
<div class="resume-modal" id="resume-modal">
    <div class="resume-modal-content">
        <div class="resume-header">
            <div class="resume-title">Resume Preview</div>
            <div class="resume-actions">
                @if(isset($settings['resume_file']))
                    <a href="{{ asset($settings['resume_file']) }}" download class="btn-primary" style="padding: 0.5rem 1rem;">
                        <svg style="width:16px;height:16px;display:inline;margin-right:4px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M7 10l5 5 5-5M12 15V3"></path></svg> 
                        Download
                    </a>
                @endif
                <button class="btn-close-modal" id="close-resume-btn">
                    <svg style="width:24px;height:24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
        </div>
        <div class="resume-viewer">
            @if(!empty($settings['resume_file']))
                @php
                    $ext = pathinfo($settings['resume_file'], PATHINFO_EXTENSION);
                    $pdfUrl = asset($settings['resume_file']);
                @endphp
                @if(strtolower($ext) === 'pdf')
                    <iframe src="{{ $pdfUrl }}" frameborder="0" style="width: 100%; height: 100%;"></iframe>
                @else
                    <img src="{{ asset($settings['resume_file']) }}" alt="Resume">
                @endif
            @else
                <div style="padding: 4rem; text-align: center; color: #6b7280;">No resume uploaded yet. Add it from the admin panel.</div>
            @endif
        </div>
    </div>
</div>

<!-- Research Section -->
<!-- Education Section -->
<section id="education" class="education-section">
    <div class="education-container">
        <h2 class="section-title">Education & Academic History</h2>
        
        @if($education->count() > 0)
            <div class="education-timeline">
                @foreach($education as $item)
                <div class="education-card">
                    <div class="education-header">
                        @if($item->logo)
                        <img src="{{ asset($item->logo) }}" alt="{{ $item->institution_name }}" class="education-logo">
                        @else
                        <div class="education-logo-placeholder">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
                            </svg>
                        </div>
                        @endif
                        
                        <div class="education-info">
                            <h3 class="education-degree">{{ $item->degree_name }}</h3>
                            <p class="education-institution">{{ $item->institution_name }}</p>
                            <p class="education-period">
                                {{ $item->start_date->format('M Y') }}
                                @if($item->end_date)
                                    - {{ $item->end_date->format('M Y') }}
                                @else
                                    - Current
                                @endif
                            </p>
                        </div>
                    </div>

                    @if($item->honors_achievements || $item->scholarships)
                    <div class="education-details">
                        @if($item->honors_achievements)
                        <div class="education-section-content">
                            <h4 class="education-section-title">
                                <span class="section-icon">🏆</span> Honors & Achievements
                            </h4>
                            <ul class="education-list">
                                @foreach(array_filter(array_map('trim', explode("\n", $item->honors_achievements))) as $achievement)
                                <li>{{ $achievement }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        @if($item->scholarships)
                        <div class="education-section-content">
                            <h4 class="education-section-title">
                                <span class="section-icon">🎓</span> Scholarships
                            </h4>
                            <ul class="education-list">
                                @foreach(array_filter(array_map('trim', explode("\n", $item->scholarships))) as $scholarship)
                                <li>{{ $scholarship }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
        @else
            <div class="education-empty">
                <p>No education information available yet.</p>
            </div>
        @endif
    </div>
    
    <style>
        .education-section {
            padding: 4rem 6%;
            background: transparent;
            min-height: 600px;
            display: flex;
            align-items: center;
        }
        
        .education-container {
            max-width: 900px;
            margin: 0 auto;
            width: 100%;
        }
        
        .section-title {
            font-family: Georgia, serif;
            font-size: clamp(2rem, 5vw, 3rem);
            font-weight: 700;
            margin-bottom: 3rem;
            color: var(--ink, #111827);
        }
        
        .education-timeline {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }
        
        .education-card {
            background: transparent;
            border: 1px solid rgba(100, 100, 100, 0.2);
            border-radius: 0.75rem;
            padding: 2rem;
            border-left: 4px solid #0d945a;
            transition: all 0.3s ease;
        }
        
        .education-card:hover {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transform: translateX(4px);
        }
        
        .education-header {
            display: flex;
            gap: 1.5rem;
            align-items: flex-start;
            margin-bottom: 1.5rem;
        }
        
        .education-logo {
            width: 80px;
            height: 80px;
            border-radius: 0.5rem;
            object-fit: cover;
            flex-shrink: 0;
        }
        
        .education-logo-placeholder {
            width: 80px;
            height: 80px;
            background: var(--line, #e5e7eb);
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--muted, #9ca3af);
            flex-shrink: 0;
        }
        
        .education-logo-placeholder svg {
            width: 40px;
            height: 40px;
        }
        
        .education-info {
            flex: 1;
        }
        
        .education-degree {
            font-family: Georgia, serif;
            font-size: 1.25rem;
            font-weight: 600;
            margin: 0;
            color: var(--ink, #111827);
        }
        
        .education-institution {
            font-size: 1rem;
            color: #6b7280;
            margin: 0.25rem 0;
        }
        
        .education-period {
            font-size: 0.875rem;
            color: #0d945a;
            margin: 0.5rem 0 0 0;
            font-weight: 600;
        }
        
        .education-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }
        
        .education-section-content {
            padding: 0;
            background: transparent;
            border-radius: 0;
        }
        
        .education-section-title {
            font-family: Georgia, serif;
            font-size: 1rem;
            font-weight: 700;
            color: var(--ink, #111827);
            margin: 0 0 0.75rem 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .section-icon {
            font-size: 1.2rem;
        }
        
        .education-list {
            margin: 0;
            padding-left: 1.25rem;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .education-list li {
            font-size: 0.9rem;
            color: #4b5563;
            line-height: 1.5;
        }
        
        .education-empty {
            text-align: center;
            padding: 3rem;
            color: var(--muted, #6b7280);
        }
        
        @media (max-width: 768px) {
            .education-section {
                padding: 3rem 1rem;
            }
            
            .education-header {
                gap: 1rem;
            }
            
            .education-logo {
                width: 60px;
                height: 60px;
            }
            
            .education-logo-placeholder {
                width: 60px;
                height: 60px;
            }
            
            .education-details {
                grid-template-columns: 1fr;
            }
        }
    </style>
</section>

<!-- Work Experience Section -->
<section id="work-experience" class="work-experience-section">
    <div class="work-experience-container">
        <h2 class="section-title">Work Experience</h2>
        
        @if($workExperience->count() > 0)
            <div class="work-experience-timeline">
                @foreach($workExperience as $item)
                <div class="work-experience-card">
                    <div class="work-experience-header">
                        @if($item->logo)
                            <img src="{{ asset($item->logo) }}" alt="{{ $item->company_name }}" class="work-experience-logo">
                        @else
                            <div class="work-experience-logo-placeholder">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                                    <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                                </svg>
                            </div>
                        @endif

                        <div class="work-experience-info">
                            <h3 class="work-experience-company">{{ $item->company_name }}</h3>
                            <p class="work-experience-position">{{ $item->position }}</p>
                            <p class="work-experience-period">
                                {{ $item->start_date->format('M Y') }}
                                @if($item->end_date)
                                    - {{ $item->end_date->format('M Y') }}
                                @else
                                    - Current
                                @endif
                            </p>
                        </div>
                    </div>

                    @if($item->description)
                        <div class="work-experience-description">
                            <p>{{ $item->description }}</p>
                        </div>
                    @endif
                </div>
                @endforeach
            </div>
        @else
            <div class="work-experience-empty">
                <p>No work experience information available yet.</p>
            </div>
        @endif
    </div>
    
    <style>
        .work-experience-section {
            padding: 4rem 6%;
            background: transparent;
            min-height: 600px;
            display: flex;
            align-items: center;
        }
        
        .work-experience-container {
            max-width: 900px;
            margin: 0 auto;
            width: 100%;
        }
        
        .work-experience-timeline {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }
        
        .work-experience-card {
            background: transparent;
            border: 1px solid rgba(100, 100, 100, 0.2);
            border-radius: 0.75rem;
            padding: 2rem;
            border-left: 4px solid #0d945a;
            transition: all 0.3s ease;
        }
        
        .work-experience-card:hover {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transform: translateX(4px);
        }
        
        .work-experience-header {
            display: flex;
            gap: 1.5rem;
            align-items: flex-start;
            margin-bottom: 1.5rem;
        }
        
        .work-experience-logo {
            width: 80px;
            height: 80px;
            border-radius: 0.5rem;
            object-fit: cover;
            flex-shrink: 0;
        }
        
        .work-experience-logo-placeholder {
            width: 80px;
            height: 80px;
            background: var(--line, #e5e7eb);
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--muted, #9ca3af);
            flex-shrink: 0;
        }
        
        .work-experience-logo-placeholder svg {
            width: 40px;
            height: 40px;
        }
        
        .work-experience-info {
            flex: 1;
        }
        
        .work-experience-company {
            font-family: Georgia, serif;
            font-size: 1.25rem;
            font-weight: 600;
            margin: 0;
            color: var(--ink, #111827);
        }
        
        .work-experience-position {
            font-size: 1rem;
            color: #6b7280;
            margin: 0.25rem 0;
        }
        
        .work-experience-period {
            font-size: 0.875rem;
            color: #0d945a;
            margin: 0.5rem 0 0 0;
            font-weight: 600;
        }
        
        .work-experience-description {
            margin-top: 1rem;
            padding: 0;
            background: transparent;
            border-radius: 0;
        }
        
        .work-experience-description p {
            margin: 0;
            font-size: 0.95rem;
            line-height: 1.6;
            color: #4b5563;
        }
        
        .work-experience-empty {
            text-align: center;
            padding: 3rem;
            color: var(--muted, #6b7280);
        }
        
        @media (max-width: 768px) {
            .work-experience-section {
                padding: 3rem 1rem;
            }
            
            .work-experience-header {
                gap: 1rem;
            }
            
            .work-experience-logo {
                width: 60px;
                height: 60px;
            }
            
            .work-experience-logo-placeholder {
                width: 60px;
                height: 60px;
            }
        }
    </style>
</section>

<!-- Featured Projects Section -->
<section id="featured-projects" class="featured-projects-section">
    <div class="featured-projects-container">
        <h2 class="section-title">Featured Projects</h2>
        <p class="section-subtitle">Explore my latest work showcasing cutting-edge technologies and innovative solutions.</p>
        
        @if($featuredProjects->count() > 0)
            <div class="projects-grid">
                @foreach($featuredProjects as $project)
                <div class="project-card">
                    <!-- Project Image -->
                    <div class="project-image-wrapper">
                        @php
                            $projectImage = $project->images->first()?->image_path ?? $project->image ?? 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?auto=format&fit=crop&q=80&w=800';
                        @endphp
                        @if(str_starts_with($projectImage, 'http'))
                            <img src="{{ $projectImage }}" alt="{{ $project->title }}" class="project-image">
                        @else
                            <img src="{{ \Illuminate\Support\Facades\Storage::url($projectImage) }}" alt="{{ $project->title }}" class="project-image">
                        @endif
                    </div>

                    <!-- Project Details -->
                    <div class="project-details">
                        <h3 class="project-title">{{ $project->title }}</h3>
                        
                        <p class="project-description">{{ Str::limit($project->description, 120) }}</p>

                        <!-- Frameworks/Tech Stack -->
                        <div class="project-frameworks">
                            @php
                                $techs = array_map('trim', explode(',', $project->tech_stack));
                                $techs = array_slice($techs, 0, 5); // Show only first 5
                            @endphp
                            @foreach($techs as $tech)
                                <span class="framework-badge">{{ $tech }}</span>
                            @endforeach
                        </div>

                        <!-- Demo Link & See More -->
                        <div class="project-actions">
                            @if($project->live_url)
                                <a href="{{ $project->live_url }}" target="_blank" rel="noopener" class="btn-demo">
                                    <svg style="width:16px;height:16px;margin-right:4px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>
                                    Demo
                                </a>
                            @elseif($project->github_url)
                                <a href="{{ $project->github_url }}" target="_blank" rel="noopener" class="btn-demo">
                                    <svg style="width:16px;height:16px;margin-right:4px;" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                                    GitHub
                                </a>
                            @endif
                            
                            <a href="{{ route('projects.show', $project) }}" class="btn-see-more">
                                See more
                                <svg style="width:16px;height:16px;margin-left:4px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- View All Projects Link -->
            <div class="view-all-projects">
                <a href="{{ route('projects.index') }}" class="btn-view-all">
                    View All Projects
                    <svg style="width:18px;height:18px;margin-left:6px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </a>
            </div>
        @else
            <div class="projects-empty">
                <p>No featured projects available yet.</p>
            </div>
        @endif
    </div>

    <style>
        .featured-projects-section {
            padding: 4rem 6%;
            background: transparent;
            min-height: 600px;
            display: flex;
            align-items: center;
        }

        .featured-projects-container {
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
        }

        .section-subtitle {
            font-size: 1.05rem;
            line-height: 1.6;
            color: #9ca3af;
            margin-bottom: 3rem;
            max-width: 600px;
        }

        [data-theme='light'] .section-subtitle {
            color: #6b7280;
        }

        .projects-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .project-card {
            background: transparent;
            border: 1px solid rgba(100, 100, 100, 0.2);
            border-radius: 1rem;
            overflow: hidden;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .project-card:hover {
            border-color: rgba(37, 99, 235, 0.3);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            transform: translateY(-4px);
        }

        [data-theme='light'] .project-card:hover {
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        }

        .project-image-wrapper {
            width: 100%;
            height: 200px;
            overflow: hidden;
            background: #1f2937;
        }

        [data-theme='light'] .project-image-wrapper {
            background: #e5e7eb;
        }

        .project-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .project-card:hover .project-image {
            transform: scale(1.05);
        }

        .project-details {
            padding: 1.5rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .project-title {
            font-family: Georgia, serif;
            font-size: 1.25rem;
            font-weight: 600;
            margin: 0 0 0.75rem 0;
            color: var(--ink, #111827);
        }

        [data-theme='light'] .project-title {
            color: #111827;
        }

        .project-description {
            font-size: 0.9rem;
            line-height: 1.5;
            color: #9ca3af;
            margin: 0 0 1rem 0;
            flex-grow: 1;
        }

        [data-theme='light'] .project-description {
            color: #6b7280;
        }

        .project-frameworks {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .framework-badge {
            display: inline-block;
            background: rgba(37, 99, 235, 0.1);
            color: #60a5fa;
            padding: 0.375rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.8rem;
            font-weight: 500;
            border: 1px solid rgba(37, 99, 235, 0.2);
        }

        [data-theme='light'] .framework-badge {
            background: #eff6ff;
            color: #1d4ed8;
            border-color: #bfdbfe;
        }

        .project-actions {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            margin-top: auto;
        }

        .btn-demo, .btn-see-more {
            flex: 1;
            min-width: 120px;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            font-size: 0.9rem;
            font-weight: 600;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
            border: 1px solid transparent;
            cursor: pointer;
        }

        .btn-demo {
            background: rgba(37, 99, 235, 0.1);
            color: #60a5fa;
            border: 1px solid rgba(37, 99, 235, 0.2);
        }

        .btn-demo:hover {
            background: rgba(37, 99, 235, 0.2);
            border-color: rgba(37, 99, 235, 0.3);
        }

        [data-theme='light'] .btn-demo {
            background: #eff6ff;
            color: #1d4ed8;
            border-color: #bfdbfe;
        }

        [data-theme='light'] .btn-demo:hover {
            background: #dbeafe;
            border-color: #93c5fd;
        }

        .btn-see-more {
            background: #2563eb;
            color: white;
        }

        .btn-see-more:hover {
            background: #1d4ed8;
        }

        .view-all-projects {
            display: flex;
            justify-content: center;
            margin-top: 2rem;
        }

        .btn-view-all {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 1rem 2rem;
            background: #2563eb;
            color: white;
            border-radius: 0.5rem;
            font-weight: 600;
            text-decoration: none;
            transition: background 0.2s;
        }

        .btn-view-all:hover {
            background: #1d4ed8;
        }

        .projects-empty {
            text-align: center;
            padding: 3rem;
            color: var(--muted, #6b7280);
        }

        @media (max-width: 768px) {
            .featured-projects-section {
                padding: 3rem 1rem;
            }

            .projects-grid {
                grid-template-columns: 1fr;
            }

            .project-actions {
                flex-direction: column;
            }

            .btn-demo, .btn-see-more {
                min-width: auto;
            }
        }
    </style>
</section>

<script>
    // Theme toggle
    const themeBtn = document.getElementById('theme-toggle');
    const heroSection = document.getElementById('hero-section');
    themeBtn.addEventListener('click', () => {
        const currentTheme = heroSection.getAttribute('data-theme');
        heroSection.setAttribute('data-theme', currentTheme === 'dark' ? 'light' : 'dark');
    });

    // Resume Modal
    const resumeModal = document.getElementById('resume-modal');
    const openBtn = document.getElementById('open-resume-btn');
    const closeBtn = document.getElementById('close-resume-btn');

    openBtn.addEventListener('click', () => {
        resumeModal.classList.add('show');
        document.body.style.overflow = 'hidden';
    });

    closeBtn.addEventListener('click', () => {
        resumeModal.classList.remove('show');
        document.body.style.overflow = '';
    });

    resumeModal.addEventListener('click', (e) => {
        if (e.target === resumeModal) {
            resumeModal.classList.remove('show');
            document.body.style.overflow = '';
        }
    });

    // Prevent iframe/inner clicks from closing modal
    const viewer = document.querySelector('.resume-viewer');
    if(viewer) {
        viewer.addEventListener('click', (e) => {
            e.stopPropagation();
        });
    }
</script>
@endsection
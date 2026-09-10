@extends('layouts.app')

@section('title', 'DK Academy Makassar - English Course')

@section('content')
@php
    $programFinderData = $programs->map(function ($program) {
        return [
            'id' => $program->id,
            'name' => $program->nama_program,
            'description' => \Illuminate\Support\Str::limit($program->deskripsi, 150),
            'url' => route('programs.show', $program->id),
            'registerUrl' => route('kursus.daftar', ['program' => $program->nama_program]),
        ];
    })->values();
@endphp

<section class="hero-section">
    <div class="site-container hero-grid">
        <div class="hero-copy" data-reveal>
            <p class="eyebrow">DK Academy Makassar</p>
            <h1>Improve Your <span>Language</span> Proficiency.</h1>
            <p class="hero-lead">Bringing world opportunities closer through language proficiency. Belajar Bahasa Inggris, IELTS, TOEFL, dan simulation test dengan arah belajar yang jelas.</p>
            <div class="button-row">
                <a href="{{ route('programs.index') }}" class="btn btn-primary">Our Programs</a>
                <a href="{{ route('contact') }}" class="btn btn-outline">Free Consultation</a>
            </div>
        </div>

        <div class="hero-visual" data-reveal>
            <div class="visual-card visual-card-main">
                <img src="{{ asset('images/home/bgn home.png') }}" alt="DK Academy learning session" class="hero-photo">
            </div>
        </div>
    </div>
</section>

<section class="feature-strip">
    <div class="site-container feature-strip-grid">
        <div>
            <i class="bi bi-person-workspace"></i>
            <div>
                <h3>Experienced Tutors</h3>
                <p>Learn with certified and experienced teachers.</p>
            </div>
        </div>
        <div>
            <i class="bi bi-journal-check"></i>
            <div>
                <h3>Proven Method</h3>
                <p>Effective learning methods that help you improve faster.</p>
            </div>
        </div>
        <div>
            <i class="bi bi-calendar-week"></i>
            <div>
                <h3>Flexible Classes</h3>
                <p>Choose class time that fits your schedule.</p>
            </div>
        </div>
        <div>
            <i class="bi bi-chat-square-heart"></i>
            <div>
                <h3>Trusted by Students</h3>
                <p>Many students have achieved their goals.</p>
            </div>
        </div>
    </div>
</section>

<section class="section section-white" id="programs">
    <div class="site-container">
        <div class="section-heading split-heading">
            <div>
                <p class="eyebrow">Our Programs</p>
                <h2>Choose the right program to achieve your goals.</h2>
            </div>
            <a href="{{ route('programs.index') }}" class="text-link">View All Programs</a>
        </div>

        @if($programs->isNotEmpty())
            <div class="program-grid">
                @foreach($programs->take(4) as $program)
                    <article class="program-card" data-reveal>
                        <div class="program-media">
                            <img src="{{ asset($program->image) }}" alt="{{ $program->nama_program }}" style="object-position: {{ $program->imagePosition ?? 'center' }};">
                        </div>
                        <div class="program-body">
                            <h3>{{ $program->nama_program }}</h3>
                            <p>{{ \Illuminate\Support\Str::limit($program->deskripsi, 130) }}</p>
                            <a href="{{ route('programs.show', $program->id) }}">Learn More <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <h3>Program belum tersedia.</h3>
                <p>Tambahkan program melalui admin area agar tampil otomatis di halaman ini.</p>
            </div>
        @endif
    </div>
</section>

<section class="section section-soft">
    <div class="site-container why-grid">
        <div class="image-composition" data-reveal>
            <div class="image-frame">
                <img src="{{ asset('images/about/about dk2.png') }}" alt="DK Academy learning environment">
            </div>
        </div>
        <div class="why-copy" data-reveal>
            <p class="eyebrow">Why Choose DK Academy?</p>
            <h2>Structured learning with practical feedback.</h2>
            <div class="why-list">
                <div>
                    <i class="bi bi-mortarboard"></i>
                    <div>
                        <h3>Experienced Tutors</h3>
                        <p>Belajar dengan arahan mentor dan latihan yang mudah diikuti.</p>
                    </div>
                </div>
                <div>
                    <i class="bi bi-pencil-square"></i>
                    <div>
                        <h3>Interactive Learning</h3>
                        <p>Latihan speaking, writing, dan soal persiapan tes dibuat lebih praktis.</p>
                    </div>
                </div>
                <div>
                    <i class="bi bi-chat-left-text"></i>
                    <div>
                        <h3>Personalized Feedback</h3>
                        <p>Dapatkan masukan yang membantu kamu tahu bagian mana yang perlu diperbaiki.</p>
                    </div>
                </div>
                <div>
                    <i class="bi bi-people"></i>
                    <div>
                        <h3>Supportive Environment</h3>
                        <p>Lingkungan belajar yang mendukung progres bertahap dan realistis.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section section-white">
    <div class="site-container contact-band" data-reveal>
        <div>
            <p class="eyebrow">Location</p>
            <h2>DK Academy is located in Losari, Makassar.</h2>
            <p>{{ $contact['address'] ?? 'Jl. Manggis No.10, Losari, Kec. Ujung Pandang, Kota Makassar, Sulawesi Selatan' }}</p>
        </div>
        <div class="button-row">
            <a href="{{ $contact['mapUrl'] ?? 'https://www.google.com/maps/search/?api=1&query=Jl.%20Manggis%20No.10%2C%20Losari%2C%20Kota%20Makassar' }}" class="btn btn-primary" target="_blank" rel="noopener">Open Google Maps</a>
            <a href="{{ $contact['instagram'] ?? 'https://www.instagram.com/dk.academy.id/' }}" class="btn btn-outline" target="_blank" rel="noopener">Instagram</a>
        </div>
    </div>
</section>

<section class="section section-white" id="program-finder">
    <div class="site-container finder-grid">
        <div data-reveal>
            <p class="eyebrow">Program Finder</p>
            <h2>Find the Right Program for You</h2>
            <p class="muted">Pilih tujuan belajarmu. Sistem sederhana ini akan mencocokkan pilihanmu dengan program DK Academy yang tersedia.</p>
        </div>

        <div class="interactive-box" data-program-finder='@json($programFinderData)' data-reveal>
            <p class="question-title">What is your main goal?</p>
            <div class="choice-grid">
                <button type="button" data-goal="english">Improve my English</button>
                <button type="button" data-goal="ielts">Prepare for IELTS</button>
                <button type="button" data-goal="toefl">Prepare for TOEFL</button>
                <button type="button" data-goal="level">Check my English level</button>
            </div>
            <div class="recommendation-box" data-program-result hidden></div>
        </div>
    </div>
</section>

<section class="section section-dark" id="level-check">
    <div class="site-container level-grid">
        <div data-reveal>
            <p class="eyebrow">Quick English Level Check</p>
            <h2>Don't know your English level?</h2>
            <p>Jawab beberapa soal singkat untuk melihat estimasi level Bahasa Inggrismu. Hasil ini hanya indikasi awal, bukan skor IELTS/TOEFL resmi.</p>
        </div>

        <div class="quiz-box" data-level-check data-reveal>
            <div class="quiz-progress"><span data-quiz-count>Question 1 of 6</span></div>
            <div class="quiz-question" data-quiz-question></div>
            <div class="quiz-options" data-quiz-options></div>
            <div class="quiz-result" data-quiz-result hidden></div>
        </div>
    </div>
</section>

<section class="section section-white">
    <div class="site-container split-content">
        <div data-reveal>
            <p class="eyebrow">Success Stories</p>
            <h2>What Our Students Say</h2>
        </div>
        <div class="story-preview" data-reveal>
            <figure class="story-preview-photo">
                <img src="{{ asset('images/testimoni/tes1.png') }}" alt="" aria-hidden="true" class="story-photo-backdrop">
                <img src="{{ asset('images/testimoni/tes1.png') }}" alt="DK Academy student story" class="story-photo-person">
            </figure>
            <div class="story-preview-copy">
                <p>"Kelasnya membantu saya lebih percaya diri menggunakan Bahasa Inggris dan memahami strategi IELTS/TOEFL dengan lebih terarah."</p>
                <h3>DK Academy Student</h3>
                <a href="{{ route('success-stories') }}" class="text-link">Open Success Stories</a>
            </div>
        </div>
    </div>
</section>

<section class="section section-soft" id="faq">
    <div class="site-container faq-layout">
        <div>
            <p class="eyebrow">FAQ</p>
            <h2>Frequently Asked Questions</h2>
        </div>
        <div class="faq-list" data-faq>
            <article class="faq-item">
                <button type="button">What programs does DK Academy offer?<i class="bi bi-plus"></i></button>
                <div><p>DK Academy menyediakan program IELTS Preparation, TOEFL Preparation, General English, dan IELTS & TOEFL Simulation Test.</p></div>
            </article>
            <article class="faq-item">
                <button type="button">How can I register?<i class="bi bi-plus"></i></button>
                <div><p>Buka halaman Registration, isi data diri, pilih program, lalu submit. Data akan masuk ke tabel registrations yang sudah ada.</p></div>
            </article>
            <article class="faq-item">
                <button type="button">Where is DK Academy located?<i class="bi bi-plus"></i></button>
                <div><p>Alamat yang ditemukan: {{ $contact['address'] ?? 'Jl. Manggis No.10, Losari, Kec. Ujung Pandang, Kota Makassar, Sulawesi Selatan' }}.</p></div>
            </article>
            <article class="faq-item">
                <button type="button">Do you offer IELTS preparation?<i class="bi bi-plus"></i></button>
                <div><p>Ya, tersedia program IELTS Preparation serta simulation test untuk latihan format tes.</p></div>
            </article>
            <article class="faq-item">
                <button type="button">Can I choose my class schedule?<i class="bi bi-plus"></i></button>
                <div><p>Untuk pilihan jadwal kelas, sebaiknya konfirmasi langsung melalui kontak resmi DK Academy.</p></div>
            </article>
        </div>
    </div>
</section>

<section class="final-cta">
    <div class="site-container final-cta-inner">
        <h2>Ready to Improve Your English?</h2>
        <a href="{{ route('kursus.daftar') }}" class="btn btn-light">Register Now</a>
    </div>
</section>
@endsection

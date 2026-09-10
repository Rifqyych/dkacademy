@extends('layouts.app')

@section('title', 'Success Stories - DK Academy Makassar')

@section('content')
<section class="page-hero">
    <div class="site-container page-hero-grid">
        <div>
            <p class="eyebrow">Success Stories</p>
            <h1>Student learning stories.</h1>
            <p>Beberapa contoh cerita belajar dari peserta DK Academy untuk memberi gambaran pengalaman mengikuti kelas English course.</p>
        </div>
        <div class="page-hero-mark logo-mark">
            <img src="{{ asset('images/dkacademy logo.png') }}" alt="DK Academy">
        </div>
    </div>
</section>

<section class="section section-white">
    <div class="site-container">
        <div class="section-heading split-heading">
            <div>
                <p class="eyebrow">What Our Students Say</p>
                <h2>Belajar jadi lebih terarah dan percaya diri.</h2>
            </div>
            <a href="{{ route('kursus.daftar') }}" class="text-link">Register Now</a>
        </div>

        <div class="story-grid">
            <article class="story-card" data-reveal>
                <figure class="story-photo">
                    <img src="{{ asset('images/testimoni/tes1.png') }}" alt="" aria-hidden="true" class="story-photo-backdrop">
                    <img src="{{ asset('images/testimoni/tes1.png') }}" alt="General English student story" class="story-photo-person">
                </figure>
                <div class="story-score">
                    <strong>B1 Level</strong>
                    <span>General English Progress</span>
                </div>
                <p>"Kelas General English membantu saya lebih berani berbicara dan memahami grammar dasar dengan cara yang lebih sederhana."</p>
                <h3>General English Student</h3>
            </article>
            <article class="story-card" data-reveal>
                <figure class="story-photo">
                    <img src="{{ asset('images/testimoni/tes2.png') }}" alt="" aria-hidden="true" class="story-photo-backdrop">
                    <img src="{{ asset('images/testimoni/tes2.png') }}" alt="Test preparation student story" class="story-photo-person">
                </figure>
                <div class="story-score">
                    <strong>TOEFL 550</strong>
                    <span>Prediction Test Result</span>
                </div>
                <p>"Latihan TOEFL membantu saya memahami structure, reading comprehension, dan listening dengan cara yang lebih terarah."</p>
                <h3>TOEFL Preparation Student</h3>
            </article>
            <article class="story-card" data-reveal>
                <figure class="story-photo">
                    <img src="{{ asset('images/testimoni/tes3.png') }}" alt="" aria-hidden="true" class="story-photo-backdrop">
                    <img src="{{ asset('images/testimoni/tes3.png') }}" alt="IELTS preparation student story" class="story-photo-person">
                </figure>
                <div class="story-score">
                    <strong>IELTS 6.5</strong>
                    <span>Simulation Band Score</span>
                </div>
                <p>"IELTS Preparation membuat saya lebih paham cara latihan writing, speaking, reading, dan listening sebelum mengikuti simulation test."</p>
                <h3>IELTS Preparation Student</h3>
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

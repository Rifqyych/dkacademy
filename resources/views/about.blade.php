@extends('layouts.app')

@section('title', 'About Us - DK Academy Makassar')

@section('content')
<section class="page-hero">
    <div class="site-container page-hero-grid">
        <div>
            <p class="eyebrow">About Us</p>
            <h1>DK Academy Makassar</h1>
            <p>DK Academy adalah tempat kursus Bahasa Inggris di Makassar untuk IELTS Preparation, TOEFL Preparation, General English, dan simulation test.</p>
        </div>
        <div class="page-hero-mark logo-mark">
            <img src="{{ asset('images/dkacademy logo.png') }}" alt="DK Academy">
        </div>
    </div>
</section>

<section class="section section-white">
    <div class="site-container editorial-grid">
        <div data-reveal>
            <p class="eyebrow">About DK Academy</p>
            <h2>Simple, focused, and practical English learning.</h2>
        </div>
        <div data-reveal>
            <p>DK Academy membawa pesan utama “Improve Your Language Proficiency” dan membantu peserta mendekatkan peluang global melalui kemampuan bahasa.</p>
            <p>Di website ini, informasi program dan mentor tetap mengikuti data yang tersedia agar konten terasa profesional, jujur, dan mudah dipahami calon peserta.</p>
        </div>
    </div>
</section>

<section class="section section-soft">
    <div class="site-container why-grid reverse">
        <div class="why-copy" data-reveal>
            <p class="eyebrow">Our Approach</p>
            <h2>Build confidence through consistent practice.</h2>
            <div class="why-list">
                <div><i class="bi bi-soundwave"></i><div><h3>Speaking Practice</h3><p>Peserta didorong menggunakan English secara aktif, bukan hanya menghafal teori.</p></div></div>
                <div><i class="bi bi-book"></i><div><h3>Language Foundation</h3><p>Grammar, vocabulary, listening, dan reading dibangun sebagai dasar yang kuat.</p></div></div>
                <div><i class="bi bi-clipboard-check"></i><div><h3>Test Preparation</h3><p>Latihan IELTS/TOEFL diarahkan pada format soal, strategi, dan evaluasi kemampuan.</p></div></div>
            </div>
        </div>
        <div class="image-composition" data-reveal>
            <div class="image-frame">
                <img src="{{ asset('images/about/about dk2.png') }}" alt="DK Academy learning space">
            </div>
        </div>
    </div>
</section>
@endsection

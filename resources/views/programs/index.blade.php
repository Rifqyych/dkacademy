@extends('layouts.app')

@section('title', 'Programs - DK Academy Makassar')

@section('content')
<section class="page-hero">
    <div class="site-container page-hero-grid">
        <div>
            <p class="eyebrow">Programs</p>
            <h1>English programs for clear learning goals.</h1>
            <p>Pilih program yang sesuai dengan tujuanmu: IELTS Preparation, TOEFL Preparation, General English, atau IELTS & TOEFL Simulation Test.</p>
        </div>
        <div class="page-hero-mark logo-mark">
            <img src="{{ asset('images/dkacademy logo.png') }}" alt="DK Academy">
        </div>
    </div>
</section>

<section class="section section-white">
    <div class="site-container">
        @if($programs->isNotEmpty())
            <div class="program-grid wide">
                @foreach($programs as $program)
                    <article class="program-card" data-reveal>
                        <div class="program-media">
                            <img src="{{ asset($program->image) }}" alt="{{ $program->nama_program }}" style="object-position: {{ $program->imagePosition ?? 'center' }};">
                        </div>
                        <div class="program-body">
                            <h2>{{ $program->nama_program }}</h2>
                            <p>{{ $program->deskripsi }}</p>
                            <a href="{{ route('programs.show', $program->id) }}">Learn More <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <h2>Belum ada data program.</h2>
                <p>Tambahkan program melalui admin area agar halaman ini menampilkan data dari database.</p>
            </div>
        @endif
    </div>
</section>
@endsection

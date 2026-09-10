@extends('layouts.app')

@section('title', $program->nama_program . ' - DK Academy Makassar')

@section('content')
<section class="page-hero">
    <div class="site-container page-hero-grid">
        <div>
            <p class="eyebrow">Program Detail</p>
            <h1>{{ $program->nama_program }}</h1>
            <p>{{ $program->deskripsi }}</p>
            <div class="button-row">
                <a href="{{ route('kursus.daftar', ['program' => $program->nama_program]) }}" class="btn btn-primary">Register for This Program</a>
                <a href="{{ route('programs.index') }}" class="btn btn-outline">Back to Programs</a>
            </div>
        </div>
        <div class="detail-visual">
            <img src="{{ asset($program->image) }}" alt="{{ $program->nama_program }}" style="object-position: {{ $program->imagePosition ?? 'center' }};">
        </div>
    </div>
</section>

<section class="section section-white">
    <div class="site-container detail-layout">
        <div class="detail-main" data-reveal>
            <p class="eyebrow">About This Program</p>
            <h2>What you will learn</h2>
            <p>{{ $program->deskripsi }}</p>
            <p>Program ini dapat membantu kamu menentukan fokus belajar, berdiskusi dengan tim DK Academy, dan memilih kelas yang paling sesuai dengan target Bahasa Inggrismu.</p>
        </div>
        <aside class="detail-side" data-reveal>
            <h3>Program Information</h3>
            <dl>
                <div>
                    <dt>Name</dt>
                    <dd>{{ $program->nama_program }}</dd>
                </div>
            </dl>
            <a href="{{ route('kursus.daftar', ['program' => $program->nama_program]) }}" class="btn btn-primary full-width">Register Now</a>
        </aside>
    </div>
</section>
@endsection

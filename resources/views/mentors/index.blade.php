@extends('layouts.app')

@section('title', 'Mentors - DK Academy Makassar')

@section('content')
<section class="page-hero">
    <div class="site-container page-hero-grid">
        <div>
            <p class="eyebrow">Mentors</p>
            <h1>Learn with DK Academy mentors.</h1>
            <p>Profil mentor akan ditampilkan dari database. Jika belum ada data, halaman tetap memberi konteks tanpa membuat nama mentor palsu.</p>
        </div>
        <div class="page-hero-mark logo-mark">
            <img src="{{ asset('images/dkacademy logo.png') }}" alt="DK Academy">
        </div>
    </div>
</section>

<section class="section section-white">
    <div class="site-container">
        @if($mentors->isNotEmpty())
            <div class="mentor-grid">
                @foreach($mentors as $mentor)
                    <article class="mentor-card" data-reveal>
                        <img src="{{ $mentor->foto ? asset($mentor->foto) : asset('images/mentor/mentor1.png') }}" alt="{{ $mentor->nama_mentor }}">
                        <div class="mentor-body">
                            <h2>{{ $mentor->nama_mentor }}</h2>
                            <span>{{ $mentor->spesialisasi }}</span>
                            <p>{{ $mentor->deskripsi }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <h2>Profil mentor belum tersedia.</h2>
                <p>Data mentor di tabel mentors masih kosong. Tambahkan nama, spesialisasi, deskripsi, dan foto resmi agar tampil otomatis di halaman ini.</p>
            </div>
        @endif
    </div>
</section>
@endsection

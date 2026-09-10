@extends('layouts.admin')

@section('title', 'Dashboard Admin - DK Academy')
@section('heading', 'Dashboard')

@section('content')
<section class="admin-stat-grid">
    <article class="admin-stat-card admin-stat-primary">
        <i class="bi bi-people"></i>
        <span>Total Pendaftar</span>
        <strong>{{ $totalPendaftar }}</strong>
        <a href="{{ route('admin.registrations.index') }}">Lihat data <i class="bi bi-arrow-right"></i></a>
    </article>
    <article class="admin-stat-card">
        <i class="bi bi-journal-bookmark"></i>
        <span>Program Aktif</span>
        <strong>{{ $totalPrograms }}</strong>
        <a href="{{ route('admin.programs.index') }}">Kelola program <i class="bi bi-arrow-right"></i></a>
    </article>
    <article class="admin-stat-card">
        <i class="bi bi-person-workspace"></i>
        <span>Data Mentor</span>
        <strong>{{ $totalMentors }}</strong>
        <a href="{{ route('admin.mentors.index') }}">Kelola mentor <i class="bi bi-arrow-right"></i></a>
    </article>
</section>

<section class="admin-welcome">
    <div>
        <p class="admin-kicker">Ringkasan</p>
        <h2>Kelola informasi kursus dari satu tempat.</h2>
        <p>Gunakan menu di samping untuk memeriksa pendaftar, memperbarui program, dan mengatur data mentor.</p>
    </div>
    <a href="{{ route('admin.registrations.index') }}" class="btn btn-primary">Buka Pendaftar</a>
</section>
@endsection

@extends('layouts.app')

@section('title', 'Registration - DK Academy Makassar')

@section('content')
@php
    $selected = old('program', $selectedProgram ?? '');
    $selectedLevelValue = old('level', $selectedLevel ?? '');
    $fallbackPrograms = ['IELTS Preparation', 'TOEFL Preparation', 'General English', 'IELTS & TOEFL Simulation Test'];
@endphp

<section class="page-hero compact-hero">
    <div class="site-container page-hero-grid">
        <div>
            <p class="eyebrow">Registration</p>
            <h1>Start your English learning journey.</h1>
            <p>Complete the form and DK Academy will follow up with the next registration steps.</p>
        </div>
        <div class="page-hero-mark">
            <img src="{{ asset('images/registration/regis.png') }}" alt="DK Academy registration">
        </div>
    </div>
</section>

<section class="section section-soft">
    <div class="site-container registration-grid">
        <aside class="registration-note" data-reveal>
            <h2>Before You Register</h2>
            <p>Gunakan email dan nomor WhatsApp yang aktif agar tim DK Academy mudah menghubungi kamu untuk konsultasi program.</p>
            <ul>
                <li><i class="bi bi-check2"></i> Form ini tetap memakai sistem registration yang sudah ada.</li>
                <li><i class="bi bi-check2"></i> Data pendaftaran masuk ke tabel registrations.</li>
                <li><i class="bi bi-check2"></i> Admin menerima notifikasi WhatsApp otomatis setelah form dikirim.</li>
            </ul>
        </aside>

        <div class="form-panel" data-reveal>
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-error">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('kursus.simpan') }}" method="POST" class="form-stack">
                @csrf

                <label>
                    Full Name
                    <input type="text" name="full_name" value="{{ old('full_name') }}" placeholder="Your full name" required>
                </label>

                <div class="form-two">
                    <label>
                        Email
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="you@example.com" required>
                    </label>
                    <label>
                        WhatsApp / Phone
                        <input type="text" name="phone" value="{{ old('phone') }}" placeholder="08xxxxxxxxxx" required>
                    </label>
                </div>

                <label>
                    Program
                    <select name="program" required>
                        <option value="">Choose a program</option>
                        @if($programs->isNotEmpty())
                            @foreach($programs as $program)
                                <option value="{{ $program->nama_program }}" {{ $selected === $program->nama_program ? 'selected' : '' }}>
                                    {{ $program->nama_program }}
                                </option>
                            @endforeach
                        @else
                            @foreach($fallbackPrograms as $programName)
                                <option value="{{ $programName }}" {{ $selected === $programName ? 'selected' : '' }}>
                                    {{ $programName }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </label>

                <label>
                    Current English Level
                    <select name="level" required>
                        <option value="">Choose your level</option>
                        @foreach(['Beginner', 'Elementary', 'Intermediate', 'Upper Intermediate', 'Advanced'] as $level)
                            <option value="{{ $level }}" {{ $selectedLevelValue === $level ? 'selected' : '' }}>{{ $level }}</option>
                        @endforeach
                    </select>
                </label>

                <label>
                    Message
                    <textarea name="message" rows="5" placeholder="Tell us your learning goal or preferred schedule.">{{ old('message') }}</textarea>
                </label>

                <button type="submit" class="btn btn-primary full-width">Submit Registration</button>
            </form>
        </div>
    </div>
</section>
@endsection

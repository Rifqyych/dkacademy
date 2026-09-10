@extends('layouts.admin')

@section('title', 'Tambah Mentor - Admin DK Academy')
@section('heading', 'Tambah Mentor')

@section('content')
<div class="admin-form-card">
    <form action="{{ route('admin.mentors.store') }}" method="POST" class="form-stack">
        @csrf
        <label>Nama Mentor <input type="text" name="nama_mentor" value="{{ old('nama_mentor') }}" required></label>
        <label>Spesialisasi <input type="text" name="spesialisasi" value="{{ old('spesialisasi') }}" placeholder="Contoh: IELTS Preparation" required></label>
        <label>Deskripsi <textarea name="deskripsi" rows="6" required>{{ old('deskripsi') }}</textarea></label>
        <div class="admin-form-actions"><a href="{{ route('admin.mentors.index') }}" class="btn btn-outline">Batal</a><button type="submit" class="btn btn-primary">Simpan Mentor</button></div>
    </form>
</div>
@endsection

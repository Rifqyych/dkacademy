@extends('layouts.admin')

@section('title', 'Edit Mentor - Admin DK Academy')
@section('heading', 'Edit Mentor')

@section('content')
<div class="admin-form-card">
    <form action="{{ route('admin.mentors.update', $mentor) }}" method="POST" class="form-stack">
        @csrf
        @method('PUT')
        <label>Nama Mentor <input type="text" name="nama_mentor" value="{{ old('nama_mentor', $mentor->nama_mentor) }}" required></label>
        <label>Spesialisasi <input type="text" name="spesialisasi" value="{{ old('spesialisasi', $mentor->spesialisasi) }}" required></label>
        <label>Deskripsi <textarea name="deskripsi" rows="6" required>{{ old('deskripsi', $mentor->deskripsi) }}</textarea></label>
        <div class="admin-form-actions"><a href="{{ route('admin.mentors.index') }}" class="btn btn-outline">Batal</a><button type="submit" class="btn btn-primary">Simpan Perubahan</button></div>
    </form>
</div>
@endsection

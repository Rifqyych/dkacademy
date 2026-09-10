@extends('layouts.admin')
@section('title', 'Edit Program - Admin DK Academy')
@section('heading', 'Edit Program')
@section('content')
<div class="admin-form-card">
    <form action="{{ route('admin.programs.update', $program->id) }}" method="POST" class="form-stack">
                @csrf @method('PUT')
        <label>Icon <input type="text" name="icon" value="{{ old('icon', $program->icon) }}" maxlength="50"></label>
        <label>Nama Program <input type="text" name="nama_program" value="{{ old('nama_program', $program->nama_program) }}" required></label>
        <label>Deskripsi <textarea name="deskripsi" rows="6" required>{{ old('deskripsi', $program->deskripsi) }}</textarea></label>
        <div class="admin-form-actions"><a href="{{ route('admin.programs.index') }}" class="btn btn-outline">Batal</a><button type="submit" class="btn btn-primary">Simpan Perubahan</button></div>
    </form>
</div>
@endsection

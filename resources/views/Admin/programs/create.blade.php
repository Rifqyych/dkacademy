@extends('layouts.admin')
@section('title', 'Tambah Program - Admin DK Academy')
@section('heading', 'Tambah Program')
@section('content')
<div class="admin-form-card">
    <form action="{{ route('admin.programs.store') }}" method="POST" class="form-stack">
                @csrf
        <label>Icon <input type="text" name="icon" value="{{ old('icon') }}" placeholder="Contoh: GE" maxlength="50"></label>
        <label>Nama Program <input type="text" name="nama_program" value="{{ old('nama_program') }}" required></label>
        <label>Deskripsi <textarea name="deskripsi" rows="6" required>{{ old('deskripsi') }}</textarea></label>
        <div class="admin-form-actions"><a href="{{ route('admin.programs.index') }}" class="btn btn-outline">Batal</a><button type="submit" class="btn btn-primary">Simpan Program</button></div>
    </form>
</div>
@endsection

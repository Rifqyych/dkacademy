@extends('layouts.admin')

@section('title', 'Program - Admin DK Academy')
@section('heading', 'Kelola Program')

@section('content')
<div class="admin-page-actions">
    <p>{{ $programs->count() }} program tersedia</p>
    <a href="{{ route('admin.programs.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i>Tambah Program</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="admin-table-card admin-table-scroll">
    <table class="admin-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Icon</th>
                        <th>Nama Program</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($programs as $key => $program)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td class="admin-program-icon">{{ $program->icon }}</td>
                        <td><strong>{{ $program->nama_program }}</strong></td>
                        <td class="admin-description">{{ $program->deskripsi }}</td>
                        <td class="admin-table-actions">
                            <a href="{{ route('admin.programs.edit', $program->id) }}" class="admin-icon-button" aria-label="Edit {{ $program->nama_program }}" title="Edit program"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('admin.programs.destroy', $program->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin hapus program ini?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="admin-icon-button" aria-label="Hapus {{ $program->nama_program }}" title="Hapus program"><i class="bi bi-trash3"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
    </table>
</div>
@endsection

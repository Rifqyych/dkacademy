@extends('layouts.admin')

@section('title', 'Mentor - Admin DK Academy')
@section('heading', 'Kelola Mentor')

@section('content')
<div class="admin-page-actions">
    <p>{{ $mentors->count() }} mentor tercatat</p>
    <a href="{{ route('admin.mentors.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i>Tambah Mentor</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="admin-table-card admin-table-scroll">
    @if($mentors->isNotEmpty())
        <table class="admin-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Mentor</th>
                            <th>Spesialisasi</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mentors as $key => $mentor)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td><strong>{{ $mentor->nama_mentor }}</strong></td>
                                <td><span class="admin-badge">{{ $mentor->spesialisasi }}</span></td>
                                <td class="admin-description">{{ $mentor->deskripsi }}</td>
                                <td class="admin-table-actions">
                                    <a href="{{ route('admin.mentors.edit', $mentor) }}" class="admin-icon-button" aria-label="Edit {{ $mentor->nama_mentor }}" title="Edit mentor"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ route('admin.mentors.destroy', $mentor) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus mentor ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="admin-icon-button" aria-label="Hapus {{ $mentor->nama_mentor }}" title="Hapus mentor"><i class="bi bi-trash3"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
    @else
        <div class="admin-empty-state"><i class="bi bi-person-workspace"></i><p>Belum ada data mentor.</p></div>
    @endif
</div>
@endsection

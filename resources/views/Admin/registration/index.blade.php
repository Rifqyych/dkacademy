@extends('layouts.admin')

@section('title', 'Pendaftar - Admin DK Academy')
@section('heading', 'Data Pendaftar')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="admin-table-card">
        <div class="admin-table-head">
            <p>{{ $registrations->count() }} pendaftar tercatat</p>
        </div>
        <div class="admin-table-scroll">
            <table class="admin-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Program</th>
                                <th>Level</th>
                                <th>Tanggal Daftar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($registrations as $key => $reg)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td><strong>{{ $reg->full_name }}</strong></td>
                                <td>{{ $reg->email }}</td>
                                <td>{{ $reg->program }}</td>
                                <td><span class="admin-badge">{{ $reg->level }}</span></td>
                                <td>{{ \Carbon\Carbon::parse($reg->tanggal_daftar ?? $reg->created_at)->format('d M Y') }}</td>
                                <td>
                                    <form action="{{ route('admin.registrations.destroy', $reg->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pendaftar atas nama {{ $reg->full_name }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="admin-icon-button" aria-label="Hapus {{ $reg->full_name }}" title="Hapus pendaftar"><i class="bi bi-trash3"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Daftar Team</h1>

    <!-- Button to create new team -->
    <a href="{{ route('teambuilders.create') }}" class="btn btn-success mb-3">
        <i class="fas fa-plus-circle"></i> Buat Team Baru
    </a>

    <!-- Success and Error Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Gagal!</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Table with team builders -->
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Nama Team</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($teambuilders as $teambuilder)
                    <tr>
                        <td>{{ $teambuilder->name_team }}</td>
                        <td>{{ Str::limit($teambuilder->description, 50) }}</td> <!-- Limit description to 50 chars -->
                        <td>
                            <a href="{{ route('teambuilders.show', $teambuilder->id) }}" class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i> Lihat
                            </a>
                            <a href="{{ route('teambuilders.edit', $teambuilder->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('teambuilders.destroy', $teambuilder->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus tim ini?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

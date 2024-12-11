@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1 class="mt-4">Daftar Craft Essence</h1>

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Craft Essence Management</h5>
                    <div class="btn-group">
                        <a href="{{ route('craftessences.create') }}" class="btn btn-light">
                            <i class="fas fa-plus me-2"></i>Tambah Craft Essence
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('craftessences.index') }}" class="mb-3">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                    <input type="text" name="search" class="form-control"
                                        placeholder="Search by name" value="{{ request('search') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <select name="rarity" class="form-select">
                                    <option value="">All Rarities</option>
                                    @foreach([1,2,3,4,5] as $rarity)
                                        <option value="{{ $rarity }}" {{ request('rarity') == $rarity ? 'selected' : '' }}>
                                            {{ $rarity }} Star
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-filter me-2"></i>Filter
                                </button>
                            </div>
                        </div>
                    </form>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Gambar</th>
                                    <th>Nama</th>
                                    <th>Rarity</th>
                                    <th>Max Level</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($craftessences as $index => $ce)
                                    <tr>
                                        <td>{{ ($craftessences->currentPage() - 1) * $craftessences->perPage() + $loop->iteration }}</td>
                                        <td>
                                            <img src="{{ asset($ce->img_ce) }}"
                                                alt="{{ $ce->name_ce }}" 
                                                class="img-thumbnail material-image"
                                                style="width: 50px; height: 50px; object-fit: cover;">
                                        </td>
                                        <td>{{ $ce->name_ce }}</td>
                                        <td>
                                            @for($i = 0; $i < $ce->rarity_ce; $i++)
                                                <i class="fas fa-star text-warning"></i>
                                            @endfor
                                        </td>
                                        <td>{{ $ce->max_level_ce }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="{{ route('craftessences.show', $ce) }}" 
                                                   class="btn btn-info btn-sm" 
                                                   data-bs-toggle="tooltip" 
                                                   title="View">
                                                    View
                                                </a>
                                                <a href="{{ route('craftessences.edit', $ce) }}" 
                                                   class="btn btn-warning btn-sm" 
                                                   data-bs-toggle="tooltip" 
                                                   title="Edit">
                                                    Edit
                                                </a>
                                                <form action="{{ route('craftessences.destroy', $ce) }}" 
                                                      method="POST" 
                                                      class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn btn-danger btn-sm delete-btn" 
                                                            data-bs-toggle="tooltip" 
                                                            title="Delete">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">
                                            <div class="alert alert-info">
                                                Tidak ada data Craft Essence.
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            Showing {{ $craftessences->firstItem() }} to {{ $craftessences->lastItem() }} 
                            of {{ $craftessences->total() }} entries
                        </div>
                        <div>
                            {{ $craftessences->appends(request()->input())->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteBtns = document.querySelectorAll('.delete-btn');
        deleteBtns.forEach(btn => {
            btn.addEventListener('click', function(e) {
                if (!confirm('Apakah Anda yakin ingin menghapus Craft Essence ini?')) {
                    e.preventDefault();
                }
            });
        });

        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    });
</script>
@endpush

@push('styles')
<style>
    .material-image {
        transition: transform 0.3s ease;
        cursor: pointer;
    }
    .material-image:hover {
        transform: scale(1.1);
    }

    .text-warning {
        color: gold !important;
        text-shadow: 0 0 5px rgba(255,215,0,0.5);
    }
</style>
@endpush
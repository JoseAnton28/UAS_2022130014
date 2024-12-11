@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1 class="mt-4 mb-3">Daftar Servant</h1>

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Servant Management</h5>
                    <div>
                        <a href="{{ route('servants.create') }}" class="btn btn-light">
                            Tambah Servant
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('servants.index') }}" class="mb-4">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                    <input type="text" name="search" class="form-control" placeholder="Cari servant..."
                                        value="{{ request('search') }}">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <select name="class" class="form-select">
                                    <option value="">Semua Kelas</option>
                                    @foreach($classes as $class)
                                        <option value="{{ $class }}" {{ request('class') == $class ? 'selected' : '' }}>
                                            {{ $class }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3">
                                <select name="rarity" class="form-select">
                                    <option value="">Semua Rarity</option>
                                    @for($i = 1; $i <= 5; $i++)
                                        <option value="{{ $i }}" {{ request('rarity') == $i ? 'selected' : '' }}>
                                            {{ $i }} Star
                                        </option>
                                    @endfor
                                </select>
                            </div>

                            <div class="col-md-2 d-flex gap-2">
                                <button type="submit" class="btn btn-primary flex-grow-1">
                                    Filter
                                </button>
                                <a href="{{ route('servants.index') }}" class="btn btn-secondary">
                                    Reset
                                </a>
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
                                    <th>Foto</th>
                                    <th>Name</th>
                                    <th>Class</th>
                                    <th>Rarity</th>
                                    <th>Base HP</th>
                                    <th>Base ATK</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($servants as $servant)
                                    <tr>
                                        <td>
                                            @if($servant->img_sv)
                                                <img src="{{ asset($servant->img_sv) }}" alt="{{ $servant->name_sv }}"
                                                    class="img-thumbnail" style="width: 80px; height: 80px; object-fit: cover;">
                                            @else
                                                <span class="badge bg-secondary">No Image</span>
                                            @endif
                                        </td>
                                        <td>{{ $servant->name_sv }}</td>
                                        <td>{{ $servant->class_sv }}</td>
                                        <td>
                                            @for($i = 0; $i < $servant->rarity_sv; $i++)
                                                <i class="fas fa-star text-warning"></i>
                                            @endfor
                                        </td>
                                        <td>{{ $servant->base_hp_sv }}</td>
                                        <td>{{ $servant->base_atk_sv }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('servants.show', $servant) }}"
                                                    class="btn btn-info btn-sm">
                                                    View
                                                </a>
                                                <a href="{{ route('servants.edit', $servant) }}"
                                                    class="btn btn-warning btn-sm">
                                                    Edit
                                                </a>
                                                <button type="button" class="btn btn-danger btn-sm" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#deleteModal{{ $servant->id }}">
                                                    Hapus
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Delete Confirmation Modal -->
                                    <div class="modal fade" id="deleteModal{{ $servant->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menghapus servant {{ $servant->name_sv }}?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <form action="{{ route('servants.destroy', $servant) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-muted">
                            Menampilkan {{ $servants->firstItem() }} hingga {{ $servants->lastItem() }}
                            dari {{ $servants->total() }} entri
                        </div>
                        {{ $servants->appends(request()->input())->links('pagination::bootstrap-5') }}
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
        
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endpush
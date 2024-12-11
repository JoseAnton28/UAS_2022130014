@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            @if($servant->img_sv)
                <div class="card mb-4">
                    <img src="{{ asset($servant->img_sv) }}" 
                         alt="{{ $servant->name_sv }}" 
                         class="card-img-top" 
                         style="max-height: 400px; object-fit: cover;">
                </div>
            @else
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <p class="text-muted">Tidak ada foto servant</p>
                        <form action="{{ route('servants.upload-photo', $servant) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <input type="file" name="img_sv" class="form-control" accept="image/*" required>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-upload"></i> Upload Foto
                            </button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
        
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h1 class="h4 mb-0">{{ $servant->name_sv }}</h1>
                    <span class="badge bg-light text-dark">{{ $servant->class_sv }}</span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h5 class="mb-3">Informasi Servant</h5>
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Rarity
                                    <span class="badge bg-primary">{{ $servant->rarity_sv }} Star</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Base HP
                                    <span class="badge bg-success">{{ $servant->base_hp_sv }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Base ATK
                                    <span class="badge bg-danger">{{ $servant->base_atk_sv }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <div>
                            <a href="{{ route('servants.edit', $servant) }}" class="btn btn-warning">
                                <i class="fas fa-edit me-2"></i>Edit Servant
                            </a>
                        </div>
                        <a href="{{ route('servants.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.querySelector('input[name="img_sv"]')?.addEventListener('change', function(e) {
        const file = e.target.files[0];
        const reader = new FileReader();
        
        reader.onload = function(event) {
            const imgElement = document.createElement('img');
            imgElement.src = event.target.result;
            imgElement.classList.add('img-fluid', 'mt-2', 'rounded');
            
            const prevPreview = document.querySelector('.img-preview');
            if (prevPreview) {
                prevPreview.remove();
            }
            
            const container = e.target.closest('.card-body');
            imgElement.classList.add('img-preview');
            container.appendChild(imgElement);
        }
        
        reader.readAsDataURL(file);
    });
</script>
@endpush

@push('styles')
<style>
    .card-img-top {
        width: 100%;
        height: 400px;
        object-fit: cover;
    }

    .list-group-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
</style>
@endpush
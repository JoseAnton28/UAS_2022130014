@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h1 class="h4 mb-0">Add New Servant</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('servants.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name_sv" class="form-label">Nama Servant</label>
                        <input type="text" name="name_sv" id="name_sv" class="form-control @error('name_sv') is-invalid @enderror" required>
                        @error('name_sv')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="class_sv" class="form-label">Kelas Servant</label>
                        <select name="class_sv" id="class_sv" class="form-select @error('class_sv') is-invalid @enderror" required>
                            <option value="">Pilih Kelas</option>
                            @foreach($classes as $class)
                                <option value="{{ $class }}" {{ old('class_sv') == $class ? 'selected' : '' }}>
                                    {{ $class }}
                                </option>
                            @endforeach
                        </select>
                        @error('class_sv')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="rarity_sv" class="form-label">Rarity</label>
                        <select name="rarity_sv" id="rarity_sv" class="form-select @error('rarity_sv') is-invalid @enderror" required>
                            <option value="">Pilih Rarity</option>
                            @for($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}" {{ old('rarity_sv') == $i ? 'selected' : '' }}>
                                    {{ $i }} Star
                                </option>
                            @endfor
                        </select>
                        @error('rarity_sv')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="base_hp_sv" class="form-label">Base HP</label>
                            <input type="number" name="base_hp_sv" id="base_hp_sv" 
                                   class="form-control @error('base_hp_sv') is-invalid @enderror" required>
                            @error('base_hp_sv')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="base_atk_sv" class="form-label">Base ATK</label>
                            <input type="number" name="base_atk_sv" id="base_atk_sv" 
                                   class="form-control @error('base_atk_sv') is-invalid @enderror" required>
                            @error('base_atk_sv')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="img_sv" class="form-label">Foto Servant</label>
                        <input type="file" name="img_sv" id="img_sv" 
                               class="form-control @error('img_sv') is-invalid @enderror" 
                               accept="image/*">
                        @error('img_sv')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        
                        <div id="image-preview" class="mt-3">
                            <img id="preview" src="" class="img-fluid" style="display:none; max-height: 300px;">
                        </div>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Tambah Servant
                        </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const imageInput = document.getElementById('img_sv');
        const preview = document.getElementById('preview');

        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            const reader = new FileReader();

            reader.onloadend = function() {
                preview.src = reader.result;
                preview.style.display = file ? 'block' : 'none';
            }

            if (file) {
                reader.readAsDataURL(file);
            }
        });
    });
</script>
@endpush
@endsection
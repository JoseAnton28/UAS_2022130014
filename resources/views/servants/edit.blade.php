@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h1 class="h4 mb-0">Edit Servant</h1>
                    <a href="{{ route('servants.index') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-arrow-left me-1"></i>Kembali
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('servants.update', $servant) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        {{-- Tampilkan foto jika ada --}}
                        @if($servant->img_sv)
                            <div class="mb-4 text-center">
                                <img src="{{ asset($servant->img_sv) }}" 
                                     class="img-fluid rounded shadow-sm" 
                                     style="max-width: 300px; max-height: 300px; object-fit: cover;">
                                <div class="mt-3">
                                    <a href="{{ route('servants.remove-photo', $servant) }}" 
                                       class="btn btn-danger btn-sm" 
                                       onclick="return confirm('Hapus foto servant?')">
                                        <i class="fas fa-trash me-1"></i>Hapus Foto
                                    </a>
                                </div>
                            </div>
                        @endif

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name_sv" class="form-label">Nama Servant</label>
                                <input type="text" class="form-control @error('name_sv') is-invalid @enderror" 
                                       id="name_sv" name="name_sv" 
                                       value="{{ old('name_sv', $servant->name_sv) }}" required>
                                @error('name_sv')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="class_sv" class="form-label">Kelas Servant</label>
                                <select class="form-select @error('class_sv') is-invalid @enderror" 
                                        id="class_sv" name="class_sv" required>
                                    <option value="">Pilih Kelas</option>
                                    @foreach($classes as $class)
                                        <option value="{{ $class }}" 
                                            {{ old('class_sv', $servant->class_sv) == $class ? 'selected' : '' }}>
                                            {{ $class }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('class_sv')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="rarity_sv" class="form-label">Rarity</label>
                                <select class="form-select @error('rarity_sv') is-invalid @enderror" 
                                        id="rarity_sv" name="rarity_sv" required>
                                    @for($i = 1; $i <= 5; $i++)
                                        <option value="{{ $i }}" 
                                            {{ old('rarity_sv', $servant->rarity_sv) == $i ? 'selected' : '' }}>
                                            {{ $i }} Star
                                        </option>
                                    @endfor
                                </select>
                                @error('rarity_sv')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="base_hp_sv" class="form-label">Base HP</label>
                                <input type="number" class="form-control @error('base_hp_sv') is-invalid @enderror" 
                                       id="base_hp_sv" name="base_hp_sv" 
                                       value="{{ old('base_hp_sv', $servant->base_hp_sv) }}" required>
                                @error('base_hp_sv')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="base_atk_sv" class="form-label">Base ATK</label>
                                <input type="number" class="form-control @error('base_atk_sv') is-invalid @enderror" 
                                       id="base_atk_sv" name="base_atk_sv" 
                                       value="{{ old('base_atk_sv', $servant->base_atk_sv) }}" required>
                                @error('base_atk_sv')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="img_sv" class="form-label">Ganti Foto Servant</label>
                                <input type="file" class="form-control @error('img_sv') is-invalid @enderror" 
                                       id="img_sv" name="img_sv" accept="image/*">
                                @error('img_sv')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                
                                {{-- Preview gambar --}}
                                <div id="image-preview" class="mt-3 text-center">
                                    <img id="preview" src="" class="img-fluid rounded shadow-sm" 
                                         style="display:none; max-height: 300px; max-width: 100%;">
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="skills_sv" class="form-label">Skills (JSON format)</label>
                                <textarea class="form-control @error('skills_sv') is-invalid @enderror" 
                                          id="skills_sv" name="skills_sv" rows="4">{{ old('skills_sv', $servant->skills_sv) }}</textarea>
                                @error('skills_sv')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="ascension_sv" class="form-label">Ascension (JSON format)</label>
                                <textarea class="form-control @error('ascension_sv') is-invalid @enderror" 
                                          id="ascension_sv" name="ascension_sv" rows="4">{{ old('ascension_sv', $servant->ascension_sv) }}</textarea>
                                @error('ascension_sv')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Update Servant
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
        const preview = document. querySelector('#preview');

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

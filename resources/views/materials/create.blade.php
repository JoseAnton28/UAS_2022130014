@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4 align-items-center">
        <div class="col">
            <h1 class="h3 mb-0">Add New Material</h1>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('materials.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="name_mt" class="form-label">Name</label>
                        <input type="text" 
                               class="form-control @error('name_mt') is-invalid @enderror" 
                               id="name_mt" 
                               name="name_mt" 
                               value="{{ old('name_mt') }}"
                               required>
                        @error('name_mt')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="type_mt" class="form-label">Type</label>
                        <select class="form-select @error('type_mt') is-invalid @enderror" 
                                id="type_mt" 
                                name="type_mt" 
                                required>
                            <option value="">Select Type</option>
                            @foreach($types as $type)
                                <option value="{{ $type }}" 
                                        {{ old('type_mt') == $type ? 'selected' : '' }}>
                                    {{ $type }}
                                </option>
                            @endforeach
                        </select>
                        @error('type_mt')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label for="drop_location_mt" class="form-label">Drop Location</label>
                        <input type="text" 
                               class="form-control @error('drop_location_mt') is-invalid @enderror" 
                               id="drop_location_mt" 
                               name="drop_location_mt"
                               value="{{ old('drop_location_mt') }}">
                        @error('drop_location_mt')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label for="img_mt" class="form-label">Image</label>
                        <input type="file" 
                               class="form-control @error('img_mt') is-invalid @enderror" 
                               id="img_mt" 
                               name="img_mt"
                               accept="image/*">
                        @error('img_mt')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        
                        <div id="imagePreview" class="mt-3">
                            <img id="previewImage" src="" class="img-fluid rounded" style="max-height: 200px; display: none;">
                        </div>
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-2"></i>Create Material
                    </button>
                    <a href="{{ route('materials.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    
    document.getElementById('img_mt').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const previewImage = document.getElementById('previewImage');
        
        if (file) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewImage.style.display = 'block';
            }
            
            reader.readAsDataURL(file);
        } else {
            previewImage.src = '';
            previewImage.style.display = 'none';
        }
    });
</script>
@endpush
@endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4 align-items-center">
        <div class="col">
            <h1 class="h3 mb-0">Edit Material</h1>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-light">
            <div class="d-flex align-items-center">
                <h5 class="card-title mb-0 me-auto">{{ $material->name_mt }}</h5>
                <a href="{{ route('materials.index') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-4 mb-md-0">
                    <div class="position-relative">
                        <img src="{{ route('materials.image', $material) }}" alt="{{ $material->name_mt }}"
                            class="img-fluid rounded shadow-sm"
                            style="max-height: 300px; width: 100%; object-fit: cover;">

                        <div class="position-absolute top-0 end-0 m-2">
                            <button class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#imageModal">
                                <i class="bi bi-zoom-in"></i>
                            </button>
                        </div>
                    </div>

                    <div id="imagePreview" class="mt-3">
                        <img id="previewImage" src="" class="img-fluid rounded" style="display: none;">
                    </div>

                    <div class="col-md-8">
                        <form action="{{ route('materials.update', $material) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="name_mt" class="form-label">Name</label>
                                    <input type="text" class="form-control @error('name_mt') is-invalid @enderror"
                                        id="name_mt" name="name_mt" value="{{ old('name_mt', $material->name_mt) }}"
                                        required>
                                    @error('name_mt')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="type_mt" class="form-label">Type</label>
                                    <select class="form-select @error('type_mt') is-invalid @enderror" id="type_mt"
                                        name="type_mt" required>
                                        <option value="">Select Type</option>
                                        @foreach($types as $type)
                                            <option value="{{ $type }}" {{ old('type_mt', $material->type_mt) == $type ? 'selected' : '' }}>
                                                {{ $type }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('type_mt')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="drop_location_mt" class="form-label">Drop Location</label>
                                    <input type="text"
                                        class="form-control @error('drop_location_mt') is-invalid @enderror"
                                        id="drop_location_mt" name="drop_location_mt"
                                        value="{{ old('drop_location_mt', $material->drop_location_mt) }}">
                                    @error('drop_location_mt')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="img_mt" class="form-label">Change Image</label>
                                    <input type="file" class="form-control @error('img_mt') is-invalid @enderror"
                                        id="image_mt" name="img_mt" accept="image/*">
                                    @error('img_mt')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="mt-4 d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-save me-2"></i>Update Material
                                    </button>
                                    <button type="reset" class="btn btn-outline-secondary">
                                        <i class="bi bi-arrow-clockwise me-2"></i>Reset
                                    </button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal untuk gambar penuh -->
        <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="imageModalLabel">{{ $material->name_mt }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img src="{{ route('materials.image', $material) }}" alt="{{ $material->name_mt }}"
                            class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.getElementById('image_mt').addEventListener('change', function (event) {
                const file = event.target.files[0];
                const previewImage = document.getElementById('previewImage');

                if (file) {
                    const reader = new FileReader();

                    reader.onload = function (e) {
                        previewImage.src = e.target.result;
                        previewImage.style.display = 'block'; 
                    };

                    reader.readAsDataURL(file);
                } else {
                    previewImage.src = ''; 
                    previewImage.style.display = 'none'; 
                }
            });

        </script>
    @endpush
    @endsection
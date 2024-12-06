@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4 align-items-center">
        <div class="col">
            <h1 class="h3 mb-0">Tambah Craft Essence Baru</h1>
        </div>
    </div>

    <form action="{{ route('craftessences.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nama Craft Essence</label>
                        <input type="text" name="name_ce" class="form-control @error('name_ce') is-invalid @enderror" 
                            value="{{ old('name_ce') }}" required>
                        @error('name_ce')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Rarity</label>
                        <select name="rarity_ce" class="form-select @error('rarity_ce') is-invalid @enderror" required>
                            @foreach($rarities as $rarity)
                                <option value="{{ $rarity }}" 
                                    {{ old('rarity_ce') == $rarity ? 'selected' : '' }}>
                                    {{ $rarity }} Star
                                </option>
                            @endforeach
                        </select>
                        @error('rarity_ce')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Max Level</label>
                        <input type="number" name="max_level_ce" 
                            class="form-control @error('max_level_ce') is-invalid @enderror" 
                            value="{{ old('max_level_ce', 100) }}" required>
                        @error('max_level_ce')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Base Attack</label>
                        <input type="number" name="base_attack_ce" 
                            class="form-control @error('base_attack_ce') is-invalid @enderror" 
                            value="{{ old('base_attack_ce') }}" required>
                        @error('base_attack_ce')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Base HP</label>
                        <input type="number" name="base_hp_ce" 
                            class="form-control @error('base_hp_ce') is-invalid @enderror" 
                            value="{{ old('base_hp_ce') }}" required>
                        @error('base_hp_ce')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label">Gambar Craft Essence</label>
                        <input type="file" name="img_ce" 
                            class="form-control @error('img_ce') is-invalid @enderror">
                        @error('img_ce')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label">Effects</label>
                        <div id="effects-container">
                            <div class="effect-row mb-2 d-flex align-items-center gap-2">
                                <input type="text" name="effects_ce[key][]" 
                                    placeholder="Effect Key" 
                                    class="form-control flex-grow-1">
                                <input type="text" name="effects_ce[value][]" 
                                    placeholder="Effect Value" 
                                    class="form-control flex-grow-1">
                                <button type="button" 
                                    class="btn btn-danger remove-effect">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-2"></i>Simpan
                </button>
                <a href="{{ route('craftessences.index') }}" class="btn btn-secondary ms-2">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>
    </form>
</div>
@endsection

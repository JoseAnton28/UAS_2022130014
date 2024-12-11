@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4 align-items-center">
        <div class="col">
            <h1 class="h3 mb-0">Edit Craft Essence: {{ $craftessence->name_ce }}</h1>
        </div>
    </div>

    <form action="{{ route('craftessences.update', $craftessence) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Detail Craft Essence</h5>
                <a href="{{ route('craftessences.index') }}" class="btn btn-light btn-sm">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </a>
            </div>
            <div class="card-body">
                <div class="row g-4">
                    <div class="col-lg-4 mb-3">
                        <label class="form-label">Gambar Craft Essence</label>
                        <input type="file" name="img_ce" 
                               class="form-control @error('img_ce') is-invalid @enderror" 
                               accept="image/*">
                        @if($craftessence->img_ce)
                            <div class="mt-3 text-center">
                                <img src="{{ asset($craftessence->img_ce) }}" 
                                     alt="Current Image" 
                                     class="img-fluid rounded shadow-sm" 
                                     style="max-height: 300px; object-fit: cover;">
                            </div>
                        @endif
                        @error('img_ce')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-lg-8">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Craft Essence</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-tag"></i></span>
                                    <input type="text" name="name_ce" 
                                           class="form-control @error('name_ce') is-invalid @enderror" 
                                           value="{{ old('name_ce', $craftessence->name_ce) }}" 
                                           required>
                                    @error('name_ce')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Rarity</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-star"></i></span>
                                    <select name="rarity_ce" 
                                            class="form-select @error('rarity_ce') is-invalid @enderror" 
                                            required>
                                        @foreach([1,2,3,4,5] as $rarity)
                                            <option value="{{ $rarity }}" 
                                                {{ old('rarity_ce', $craftessence->rarity_ce) == $rarity ? 'selected' : '' }}>
                                                {{ $rarity }} Star
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('rarity_ce')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Max Level</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-graph-up"></i></span>
                                    <input type="number" name="max_level_ce" 
                                           class="form-control @error('max_level_ce') is-invalid @enderror" 
                                           value="{{ old('max_level_ce', $craftessence->max_level_ce) }}" 
                                           required>
                                    @error('max_level_ce')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Base Attack</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-shield"></i></span>
                                    <input type="number" name="base_attack_ce" 
                                           class="form-control @error('base_attack_ce') is-invalid @enderror" 
                                           value="{{ old('base_attack_ce', $craftessence->base_attack_ce) }}" 
                                           required>
                                    @error('base_attack_ce')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Base HP</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-heart"></i></span>
                                    <input type="number" name="base_hp_ce" 
                                           class="form-control @error('base_hp_ce') is-invalid @enderror" 
                                           value="{{ old('base_hp_ce', $craftessence->base_hp_ce) }}" 
                                           required>
                                    @error('base_hp_ce')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Effect</label>
                                @php
                                    $effects = [];
                                    if (is_string($craftessence->effects_ce)) {
                                        $decoded = json_decode($craftessence->effects_ce, true);
                                        $effects = is_array($decoded) ? $decoded : [];
                                    } elseif (is_array($craftessence->effects_ce)) {
                                        $effects = $craftessence->effects_ce;
                                    }

                                    
                                    $firstEffectKey = key($effects);
                                    $firstEffectValue = $effects[$firstEffectKey] ?? '';
                                @endphp
                                
                                <div class="row g-2">
                                    <div class="col-md-4">
                                        <input type="text" name="effects_ce[key]" 
                                               placeholder="Effect Key" 
                                               class="form-control" 
                                               value="{{ is_string($firstEffectKey) ? htmlspecialchars($firstEffectKey) : '' }}" 
                                               required>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="effects_ce[value]" 
                                               placeholder="Effect Value" 
                                               class="form-control" 
                                               value="{{ is_string($firstEffectValue) ? htmlspecialchars($firstEffectValue) : '' }}" 
                                               required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-2"></i>Simpan
                </button>
                <a href="{{ route('craftessences.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>
    </form>
</div>
@endsection
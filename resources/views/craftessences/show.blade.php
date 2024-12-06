@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4 align-items-center">
        <div class="col">
            <h1 class="h3 mb-0">{{ $craftessence->name_ce }}</h1>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            @if($craftessence->img_ce)
                <div class="text-center mb-4">
                    <img src="{{ asset($craftessence->img_ce) }}" 
                         alt="Craft Essence Image" 
                         class="img-fluid rounded" 
                         style="max-width: 300px;">
                </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <h5 class="border-bottom pb-2 mb-3">Informasi</h5>
                </div>
            </div>

            <div class="row g-3">
                <div class="col-md-6">
                    <div class="d-flex align-items-center mb-2">
                        <strong class="me-2">Rarity:</strong>
                        <span class="badge bg-{{ $craftessence->rarity_ce == 5 ? 'warning' : 'secondary' }} text-dark">
                            {{ $craftessence->rarity_ce }} ⭐
                        </span>
                    </div>
                    <p class="mb-2">
                        <strong>Max Level:</strong> 
                        {{ $craftessence->max_level_ce }}
                    </p>
                </div>
                <div class="col-md-6">
                    <p class="mb-2">
                        <strong>Base Attack:</strong> 
                        {{ $craftessence->base_attack_ce }}
                    </p>
                    <p class="mb-2">
                        <strong>Base HP:</strong> 
                        {{ $craftessence->base_hp_ce }}
                    </p>
                </div>
            </div>
            
            <div class="row mt-4">
                <div class="col-12">
                    <h5 class="border-bottom pb-2 mb-3">Effects</h5>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <ul class="list-group">
                        @php
                            $effects = null;
                            if (is_string($craftessence->effects_ce)) {
                                $effects = json_decode($craftessence->effects_ce, true);
                            } elseif (is_array($craftessence->effects_ce)) {
                                $effects = $craftessence->effects_ce;
                            }
                        @endphp

                        @if(!empty($effects))
                            @if(isset($effects['key']) && isset($effects['value']))
                                @foreach($effects['key'] as $index => $key)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        {{ $key }}
                                        <span class="badge bg-primary rounded-pill">
                                            {{ $effects['value'][$index] ?? '' }}
                                        </span>
                                    </li>
                                @endforeach
                            @else
                                @foreach($effects as $key => $value)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        {{ $key }}
                                        <span class="badge bg-primary rounded-pill">
                                            {{ $value }}
                                        </span>
                                    </li>
                                @endforeach
                            @endif
                        @else
                            <li class="list-group-item text-muted">Tidak ada efek yang ditentukan.</li>
                        @endif
                    </ul>
                </div>
            </div>
            
            <div class="row mt-4">
                <div class="col-12">
                    <div class="d-flex gap-2">
                        <a href="{{ route('craftessences.edit', $craftessence) }}" class="btn btn-warning">
                            <i class="bi bi-pencil me-2"></i>Edit
                        </a>
                        <form action="{{ route('craftessences.destroy', $craftessence) }}" 
                              method="POST" 
                              class="d-inline" 
                              onsubmit="return confirm('Yakin hapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash me-2"></i>Hapus
                            </button>
                        </form>
                        <a href="{{ route('craftessences.index') }}" class="btn btn-secondary ms-auto">
                            <i class="bi bi-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
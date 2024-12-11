@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h2 class="mb-0">{{ $teambuilder->name_team }}</h2>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Deskripsi:</strong>
                        <p>{{ $teambuilder->description ?? 'Tidak ada deskripsi' }}</p>
                    </div>

                    <h4 class="mt-4">Komposisi Tim</h4>
                    <div class="row">
                        @foreach($teambuilder->servants as $index => $servant)
                            <div class="col-md-4 mb-3">
                                <div class="card">
                                    <div class="card-header bg-secondary text-white">
                                        Slot {{ $index + 1 }}
                                    </div>
                                    <div class="card-body position-relative">
                                        {{-- Gambar Servant --}}
                                        <div class="servant-image-container text-center mb-3 position-relative">
                                            <div class="servant-image-wrapper">
                                                @if($servant->img_sv)
                                                    <img src="{{ asset($servant->img_sv) }}" 
                                                         alt="{{ $servant->name_sv }}" 
                                                         class="img-fluid servant-avatar" 
                                                         style="width: 200px; height: 200px; object-fit: cover; object-position: center;">
                                                @else
                                                    <div class="bg-secondary text-white d-flex align-items-center justify-content-center servant-avatar" 
                                                         style="width: 200px; height: 200px; margin: 0 auto;">
                                                        <span class="text-center">No Image</span>
                                                    </div>
                                                @endif
                                            </div>
                                            
                                            {{-- Class Badge --}}
                                            <span class="badge bg-info position-absolute top-0 end-0 class-badge">
                                                {{ $servant->class_sv }}
                                            </span>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h5 class="card-title mb-0">{{ $servant->name_sv }}</h5>
                                        </div>
                                        
                                        <div class="servant-details">
                                            <p class="card-text mb-2">
                                                <strong>Rarity:</strong> 
                                                @for($i = 0; $i < $servant->rarity_sv; $i++)
                                                    <i class="fas fa-star text-warning"></i>
                                                @endfor
                                            </p>
                                            <div class="row">
                                                <div class="col-6">
                                                    <p class="card-text mb-2">
                                                        <strong>Base ATK:</strong> 
                                                        <span class="text-danger">{{ number_format($servant->base_atk_sv) }}</span>
                                                    </p>
                                                </div>
                                                <div class="col-6">
                                                    <p class="card-text mb-2">
                                                        <strong>Base HP:</strong> 
                                                        <span class="text-success">{{ number_format($servant->base_hp_sv) }}</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        @php
                                            $craftEssenceId = $servant->pivot->craftessence_id;
                                            $craftEssence = $craftEssenceId 
                                                ? \App\Models\Craftessence::find($craftEssenceId) 
                                                : null;
                                        @endphp

                                        @if($craftEssence)
                                            <div class="mt-3 card bg-light">
                                                <div class="card-body">
                                                    <div class="row align-items-center">
                                                        <div class="col-4 text-center">
                                                            @if($craftEssence->img_ce)
                                                                <img src="{{ asset($craftEssence->img_ce) }}" 
                                                                     alt="{{ $craftEssence->name_ce }}" 
                                                                     class="img-fluid rounded shadow-sm" 
                                                                     style="max-height: 100px; object-fit: contain;">
                                                            @endif
                                                        </div>
                                                        <div class="col-8">
                                                            <p class="card-text mb-2">
                                                                <strong>{{ $craftEssence->name_ce }}</strong>
                                                                <span class="ms-2">
                                                                    @for($i = 0; $i < $craftEssence->rarity_ce; $i++)
                                                                        <i class="fas fa-star text-warning" style="font-size: 0.8rem;"></i>
                                                                    @endfor
                                                                </span>
                                                            </p>
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <small class="text-muted">
                                                                        <i class="fas fa-shield-alt text-danger me-1"></i>
                                                                        {{ number_format($craftEssence->base_attack_ce) }}
                                                                    </small>
                                                                </div>
                                                                <div class="col-6">
                                                                    <small class="text-muted">
                                                                        <i class="fas fa-heart text-success me-1"></i>
                                                                        {{ number_format($craftEssence->base_hp_ce) }}
                                                                    </small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    @if($craftEssence->effects_ce)
                                                        <div class="mt-3 p-3 bg-info bg-opacity-10 rounded">
                                                            <div class="d-flex align-items-center mb-2">
                                                                <i class="fas fa-magic me-2 text-primary"></i>
                                                                <h6 class="mb-0 text-primary">Effect</h6>
                                                            </div>
                                                            <p class="text-muted mb-0 small">
                                                                <i class="fas fa-quote-left text-info me-1"></i>
                                                                {{ $craftEssence->effects_ce }}
                                                                <i class="fas fa-quote-right text-info ms-1"></i>
                                                            </p>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @else
                                            <p class="text-danger">Tidak ada Craft Essence</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('teambuilders.edit', $teambuilder->id) }}" class="btn btn-warning">
                        Edit Team
                    </a>
                    <a href="{{ route('teambuilders.index') }}" class="btn btn-secondary">
                        Kembali ke Daftar Team
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.servant-details {
    background-color: #f8f9fa; 
    border-radius: 5px;
    padding: 10px;
    margin-bottom: 15px;
}
.bg-info.bg-opacity-10 {
    background-color: rgba(13, 202, 240, 0.1) !important;
}
.servant-image-container {
    position: relative;
}
.servant-avatar {
    border: 3px solid #6c757d;
    transition: transform 0.3s ease;
}
.servant-avatar:hover {
    transform: scale(1.05);
}
.class-badge {
    position: absolute;
    top: -10px;
    right: 0;
    font-size: 0.7rem;
    padding: 0.3rem;
}
</style>
@endsection
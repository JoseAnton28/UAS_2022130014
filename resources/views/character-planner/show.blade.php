@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h2 class="mb-0">
                        <i class="fas fa-clipboard-list me-2"></i>Character Planner Details
                    </h2>
                </div>
                
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-4 text-center">
                            <div class="servant-avatar mb-3">
                                @php
                                    $servantImage = null;
                                    if ($planner->servant->img_sv) {
                                        
                                        if (str_starts_with($planner->servant->img_sv, 'http')) {
                                            $servantImage = $planner->servant->img_sv;
                                        } 
                                        
                                        elseif (Storage::exists($planner->servant->img_sv)) {
                                            $servantImage = asset('storage/' . $planner->servant->img_sv);
                                        } 
                                        
                                        elseif (file_exists(public_path($planner->servant->img_sv))) {
                                            $servantImage = asset($planner->servant->img_sv);
                                        }
                                    }
                                @endphp

                                @if($servantImage)
                                    <img 
                                        src="{{ $servantImage }}" 
                                        alt="{{ $planner->servant->name_sv }}" 
                                        class="img-fluid rounded shadow"
                                        style="max-width: 200px; max-height: 200px; object-fit: cover;"
                                    >
                                @else
                                    <div 
                                        class="bg-secondary text-white rounded d-flex align-items-center justify-content-center mx-auto"
                                        style="width: 200px; height: 200px; font-size: 64px;"
                                    >
                                        {{ substr($planner->servant->name_sv, 0, 1) }}
                                    </div>
                                @endif
                            </div>
                            <h3 class="mt-2">{{ $planner->servant->name_sv }}</h3>
                            <div class="text-muted">
                                {{ $planner->servant->class_sv }} | Rarity: 
                                @for($i = 0; $i < $planner->servant->rarity_sv; $i++)
                                    <i class="fas fa-star text-warning"></i>
                                @endfor
                            </div>
                        </div>
                        
                        <div class="col-md-8">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h4 class="card-title mb-3">
                                        <i class="fas fa-boxes me-2"></i>Required Materials
                                    </h4>
                                    <div class="row">
                                        @forelse($planner->materials as $material)
                                            <div class="col-md-4 mb-2">
                                                <div class="material-item p-2">
                                                    <div class="d-flex justify-content-between align-items-start">
                                                        <div>
                                                            <strong class="{{ $material->type_mt == 'Gold' ? 'text-warning' : ($material->type_mt == 'Silver' ? 'text-secondary' : 'text-brown') }}">
                                                                {{ $material->name_mt }}
                                                            </strong>
                                                            <div class="text-muted mt-1">
                                                                <span class="badge bg-{{ $material->type_mt == 'Gold' ? 'warning' : ($material->type_mt == 'Silver' ? 'secondary' : 'brown') }} text-dark">
                                                                    {{ $material->type_mt }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <span class="badge bg-primary">
                                                                Qty: {{ $material->pivot->quantity }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="col-12">
                                                <p class="text-muted">No materials selected</p>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('character-planner.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Planners
                        </a>
                        <a href="{{ route('character-planner.edit', $planner->id) }}" class="btn btn-primary">
                            <i class="fas fa-edit me-2"></i>Edit Planner
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .servant-avatar img, .servant-avatar div {
        border: 4px solid #f8f9fa;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

    .material-item {
        background-color: #f8f9fa;
        border-radius: 8px;
        margin-bottom: 10px;
    }

    .text-brown {
        color: #8B4513;
    }

    .bg-brown {
        background-color: #D2691E;
        color: white;
    }
</style>
@endpush
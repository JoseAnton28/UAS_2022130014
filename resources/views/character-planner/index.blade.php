@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2 text-black">Character Planners</h1>
        <a href="{{ route('character-planner.create') }}" class="btn btn-success">
            <i class="fas fa-plus-circle me-2"></i>Create New Planner
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4 w-25 text-black">Servant</th>
                            <th class="w-50 text-black">Materials Required</th>
                            <th class="text-center w-25 text-black">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($planners as $planner)
                            <tr>
                                <td class="ps-4 align-middle">
                                    <div class="d-flex align-items-center">
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
                                                class="rounded me-3" 
                                                style="width: 45px; height: 45px; object-fit: cover;"
                                            >
                                        @else
                                            <div 
                                                class="rounded me-3 bg-primary text-white d-flex align-items-center justify-content-center" 
                                                style="width: 45px; height: 45px;"
                                            >
                                                {{ substr($planner->servant->name_sv, 0, 1) }}
                                            </div>
                                        @endif
                                        <div>
                                            <span class="fw-bold d-block text-black">{{ $planner->servant->name_sv }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <div class="d-flex flex-wrap gap-2 align-items-center">
                                        @foreach($planner->materials as $material)
                                            <div class="d-flex align-items-center me-2">
                                                @php
                                                    $materialImage = null;
                                                    if ($material->img_mt) {
                                                        
                                                        if (str_starts_with($material->img_mt, 'http')) {
                                                            $materialImage = $material->img_mt;
                                                        } 
                                                        
                                                        elseif (Storage::exists($material->img_mt)) {
                                                            $materialImage = asset('storage/' . $material->img_mt);
                                                        } 
                                                        
                                                        elseif (file_exists(public_path($material->img_mt))) {
                                                            $materialImage = asset($material->img_mt);
                                                        }
                                                    }
                                                @endphp

                                                @if($materialImage)
                                                    <img 
                                                        src="{{ $materialImage }}" 
                                                        alt="{{ $material->name_mt }}" 
                                                        class="rounded me-1" 
                                                        style="width: 30px; height: 30px; object-fit: cover;"
                                                    >
                                                @endif
                                                <span class="badge bg-info text-black">
                                                    {{ $material->name_mt }} 
                                                    <span class="badge bg-light text-dark ms-1">
                                                        x{{ $material->pivot->quantity }}
                                                    </span>
                                                </span>
                                            </div>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="text-center align-middle">
                                    <div class="btn-group" role="group">
                                        <a 
                                            href="{{ route('character-planner.show', $planner->id) }}" 
                                            class="btn btn-sm btn-outline-info" 
                                            title="View Details"
                                        >
                                            <i class="fas fa-eye text-black"></i>
                                        </a>
                                        <a 
                                            href="{{ route('character-planner.edit', $planner->id) }}" 
                                            class="btn btn-sm btn-outline-warning" 
                                            title="Edit Planner"
                                        >
                                            <i class="fas fa-edit text-black"></i>
                                        </a>
                                        <form 
                                            action="{{ route('character-planner.destroy', $planner->id) }}" 
                                            method="POST" 
                                            class="d-inline"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button 
                                                type="submit" 
                                                class="btn btn-sm btn-outline-danger" 
                                                onclick="return confirm('Are you sure you want to delete this planner?')"
                                                title="Delete Planner"
                                            >
                                                <i class="fas fa-trash text-black"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
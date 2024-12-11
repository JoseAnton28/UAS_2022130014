@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h2 class="mb-0">
                        <i class="fas fa-edit me-2"></i>Edit Character Planner
                    </h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('character-planner.update', $planner->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <!-- Servant Selection -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Select Servant</label>
                            <select name="servant_id" class="form-control form-select" required>
                                @foreach($servants as $servant)
                                    <option value="{{ $servant->id }}" 
                                        {{ $planner->servant_id == $servant->id ? 'selected' : '' }}>
                                        {{ $servant->name_sv }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Material Selection -->
                        <div id="materials-container">
                            <h4 class="mb-3">Required Materials</h4>
                            @foreach($planner->materials as $index => $material)
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <label class="form-label">Material {{ $index + 1 }}</label>
                                                <select 
                                                    name="materials[{{ $index }}][id]" 
                                                    class="form-control form-select"
                                                >
                                                    <option value="">Select Material</option>
                                                    @foreach($materials as $mat)
                                                        <option value="{{ $mat->id }}" 
                                                            {{ $material->id == $mat->id ? 'selected' : '' }}>
                                                            {{ $mat->name_mt }} ({{ $mat->type_mt }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Quantity</label>
                                                <input type="number" 
                                                       name="materials[{{ $index }}][quantity]" 
                                                       class="form-control" 
                                                       placeholder="Quantity" 
                                                       min="1" 
                                                       value="{{ $material->pivot->quantity }}"
                                                >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <!-- Add extra empty slots if less than 3 materials -->
                            @for($i = $planner->materials->count(); $i < 3; $i++)
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <label class="form-label">Material {{ $i + 1 }}</label>
                                                <select 
                                                    name="materials[{{ $i }}][id]" 
                                                    class="form-control form-select"
                                                >
                                                    <option value="">Select Material</option>
                                                    @foreach($materials as $mat)
                                                        <option value="{{ $mat->id }}">
                                                            {{ $mat->name_mt }} ({{ $mat->type_mt }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Quantity</label>
                                                <input type="number" 
                                                       name="materials[{{ $i }}][quantity]" 
                                                       class="form-control" 
                                                       placeholder="Quantity" 
                                                       min="1" 
                                                       value="1"
                                                >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-save me-2"></i>Update Planner
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
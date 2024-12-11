@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ isset($planner) ? 'Edit' : 'Create' }} Character Planner</h1>
    <form action="{{ isset($planner) ? route('character-planner.update', $planner->id) : route('character-planner.store') }}" 
          method="POST">
        @csrf
        @if(isset($planner))
            @method('PUT')
        @endif
        
        <!-- Servant Selection -->
        <div class="form-group">
            <label>Select Servant</label>
            <select name="servant_id" class="form-control" required>
                @foreach($servants as $servant)
                     <option value="{{ $servant->id }}" {{ isset($planner) && $planner->servant_id == $servant->id ? 'selected' : '' }}>
                        {{ $servant->name_sv }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Material Selection -->
        <div id="materials-container">
            @for($i = 0; $i < 3; $i++)
                <div class="form-group">
                    <label>Material {{ $i + 1 }}</label>
                    <select name="materials[{{ $i }}][id]" class="form-control">
                        <option value="">Select Material</option>
                        @foreach($materials as $material)
                            <option value="{{ $material->id }}" 
                                {{ isset($planner) && isset($existingMaterials[$i]) && $existingMaterials[$i]['id'] == $material->id ? 'selected' : '' }}>
                                {{ $material->name_mt }} ({{ $material->type_mt }})
                            </option>
                        @endforeach
                    </select>
                    <input type="number" 
                           name="materials[{{ $i }}][quantity]" 
                           class="form-control" 
                           placeholder="Quantity" 
                           min="1" 
                           value="{{ isset($planner) && isset($existingMaterials[$i]) ? $existingMaterials[$i]['quantity'] : 1 }}">
                </div>
            @endfor
        </div>

        <button type="submit" class="btn btn-primary">{{ isset($planner) ? 'Update' : 'Create' }} Planner</button>
    </form>
</div>
@endsection
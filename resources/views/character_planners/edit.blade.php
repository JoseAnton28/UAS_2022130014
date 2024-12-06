@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Edit Character Planner</h1>

        <form action="{{ route('character_planners.update', $planner->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="servant_id" class="form-label">Servant</label>
                <select name="servant_id" id="servant_id" class="form-select">
                    @foreach($servants as $servant)
                        <option value="{{ $servant->id }}" {{ $servant->id == $planner->servant_id ? 'selected' : '' }}>
                            {{ $servant->name_sv }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
    <label for="materials" class="form-label">Materials</label>
    <div class="material-fields">
        @foreach($planner->materials as $index => $material)
            <div class="material-field mb-2">
                <select name="materials[{{ $index }}][id]" class="form-select">
                    @foreach($materials as $availableMaterial)
                        <option value="{{ $availableMaterial->id }}" 
                            {{ $material->id == $availableMaterial->id ? 'selected' : '' }}>
                            {{ $availableMaterial->name_mt }}
                        </option>
                    @endforeach
                </select>
                <input type="number" name="materials[{{ $index }}][amount]" class="form-control mt-2" value="{{ $material->pivot->amount }}" min="1">
            </div>
        @endforeach
    </div>
</div>


            <button type="submit" class="btn btn-primary">Update Planner</button>
        </form>
    </div>
@endsection

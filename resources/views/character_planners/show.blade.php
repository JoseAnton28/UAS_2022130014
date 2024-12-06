@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Character Planner Details</h1>

        <div>
            <h3>Servant: {{ $planner->servant->name_sv }}</h3>
            <h4>Materials</h4>
            @foreach(json_decode($planner->materials) as $material)
                <p>{{ $material->name_mt }} ({{ $material->amount }})</p>
            @endforeach
        </div>

        <a href="{{ route('character_planners.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
@endsection

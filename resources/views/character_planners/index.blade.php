@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Character Planners</h1>

        <a href="{{ route('character_planners.create') }}" class="btn btn-primary mb-3">Create New Planner</a>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Servant</th>
                    <th>Materials</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($planners as $planner)
                    <tr>
                        <td>{{ $planner->id }}</td>
                        <td>{{ $planner->servant->name_sv }}</td>
                        <td>
                            @foreach($planner->materials as $material)
                                {{ $material->name_mt }} ({{ $material->pivot->amount }})<br>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('character_planners.show', $planner->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('character_planners.edit', $planner->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('character_planners.destroy', $planner->id) }}" method="POST" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

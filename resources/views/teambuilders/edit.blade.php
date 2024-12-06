@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Edit Tim</h1>

    <form action="{{ route('teambuilders.update', $teambuilder->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name_team" class="form-label">Nama Tim</label>
            <input type="text" class="form-control" id="name_team" name="name_team" value="{{ old('name_team', $teambuilder->name_team) }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $teambuilder->description) }}</textarea>
        </div>

        <h5>Pilih 6 Servant dan Craft Essence</h5>
        @for($i = 0; $i < 6; $i++)
            <div class="mb-3">
                <label for="servants[{{ $i }}]" class="form-label">Servant {{ $i + 1 }}</label>
                <select class="form-select" id="servants[{{ $i }}]" name="servants[]" required>
                    <option value="">Pilih Servant</option>
                    @foreach($servants as $servant)
                        <option value="{{ $servant->id }}" 
                            @if(in_array($servant->id, $selectedServants)) selected @endif>
                            {{ $servant->name_sv }}
                        </option>
                    @endforeach
                </select>

                <label for="craft_essences[{{ $i }}]" class="form-label">Craft Essence {{ $i + 1 }}</label>
                <select class="form-select" id="craft_essences[{{ $i }}]" name="craft_essences[]" required>
                    <option value="">Pilih Craft Essence</option>
                    @foreach($craftEssences as $craftEssence)
                        <option value="{{ $craftEssence->id }}" 
                            @if(in_array($craftEssence->id, $selectedCraftEssences)) selected @endif>
                            {{ $craftEssence->name_ce }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endfor

        <button type="submit" class="btn btn-primary">Perbarui Tim</button>
    </form>
</div>
@endsection

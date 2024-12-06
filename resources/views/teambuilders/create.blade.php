@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Buat Team Baru</h1>
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('teambuilders.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name_team" class="form-label">Nama Team</label>
            <input type="text" class="form-control" id="name_team" name="name_team" value="{{ old('name_team') }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
        </div>
        <h5>Pilih 6 Servant dan Craft Essence</h5>
        @for($i = 0; $i < 6; $i++)
            <div class="mb-3">
                <label for="servants[{{ $i }}]" class="form-label">Servant {{ $i + 1 }}</label>
                <select class="form-select" id="servants[{{ $i }}]" name="servants[]" required>
                    <option value="">Pilih Servant</option>
                    @foreach($servants as $servant)
                        <option value="{{ $servant->id }}" {{ old('servants.' . $i) == $servant->id ? 'selected' : '' }}>
                            {{ $servant->name_sv }}
                        </option>
                    @endforeach
                </select>
                <label for="craft_essences[{{ $i }}]" class="form-label">Craft Essence {{ $i + 1 }}</label>
                <select class="form-select" id="craft_essences[{{ $i }}]" name="craft_essences[]" required>
                    <option value="">Pilih Craft Essence</option>
                    @foreach($craftEssences as $craftEssence)
                        <option value="{{ $craftEssence->id }}" {{ old('craft_essences.' . $i) == $craftEssence->id ? 'selected' : '' }}>
                            {{ $craftEssence->name_ce }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endfor
        <button type="submit" class="btn btn-success">Simpan Team</button>
    </form>
</div>
@endsection

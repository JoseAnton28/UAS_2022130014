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
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $servant->name_sv }}</h5>
                                        <p class="card-text">
                                            <strong>Kelas:</strong> {{ $servant->class_sv }}<br>
                                            <strong>Rarity:</strong> {{ $servant->rarity_sv }}
                                        </p>

                                        @if($servant->pivot->craftessence_id)
                                            <div class="mt-3">
                                                <h6>Craft Essence</h6>
                                                <p>
                                                    <strong>Nama:</strong>
                                                    {{ $servant->pivot->craftessence->name_ce ?? 'Tidak ada Craft Essence' }}<br>
                                                    <strong>Rarity:</strong>
                                                    {{ $servant->pivot->craftessence->rarity_ce ?? '-' }}
                                                </p>
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
@endsection
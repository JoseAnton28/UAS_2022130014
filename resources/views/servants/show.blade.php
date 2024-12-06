@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            @if($servant->img_sv)
                <div class="card mb-4">
                    <img src="{{ asset($servant->img_sv) }}" 
                         alt="{{ $servant->name_sv }}" 
                         class="card-img-top" 
                         style="max-height: 400px; object-fit: cover;">
                </div>
            @else
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <p class="text-muted">Tidak ada foto servant</p>
                        <form action="{{ route('servants.upload-photo', $servant) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <input type="file" name="img_sv" class="form-control" accept="image/*" required>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-upload"></i> Upload Foto
                            </button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
        
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">{{ $servant->name_sv }}</h1>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Informasi Dasar</h5>
                            <p><strong>Kelas:</strong> {{ $servant->class_sv }}</p>
                            <p><strong>Rarity:</strong> {{ $servant->rarity_sv }} Star</p>
                            <p><strong>Base HP:</strong> {{ $servant->base_hp_sv }}</p>
                            <p><strong>Base ATK:</strong> {{ $servant->base_atk_sv }}</p>
                        </div>
                        
                        <div class="col-md-6">
                            <h5>Skills</h5>
                            @if($servant->skills_sv)
                                @php
                                    $skills = json_decode($servant->skills_sv, true);
                                @endphp
                                @if(is_array($skills))
                                    @foreach($skills as $skill)
                                        <div class="mb-2">
                                            <strong>{{ $skill['name'] ?? 'Unnamed Skill' }}</strong>
                                            <p class="text-muted">{{ $skill['description'] ?? 'No description' }}</p>
                                        </div>
                                    @endforeach
                                @else
                                    <p class="text-muted">Format skills tidak valid</p>
                                @endif
                            @else
                                <p class="text-muted">Tidak ada informasi skills</p>
                            @endif
                        </div>
                    </div>

                    <hr>

                    <h5>Ascension</h5>
                    @if($servant->ascension_sv)
                        @php
                            $ascensions = json_decode($servant->ascension_sv, true);
                        @endphp
                        @if(is_array($ascensions))
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Level</th>
                                            <th>Bahan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($ascensions as $ascension)
                                            <tr>
                                                <td>{{ $ascension['level'] ?? 'N/A' }}</td>
                                                <td>
                                                    @if(isset($ascension['materials']) && is_array($ascension['materials']))
                                                        {{ implode(', ', $ascension['materials']) }}
                                                    @else
                                                        Tidak ada informasi bahan
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-muted">Format ascension tidak valid</p>
                        @endif
                    @else
                        <p class="text-muted">Tidak ada informasi ascension</p>
                    @endif
                </div>
                
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <div>
                            <a href="{{ route('servants.edit', $servant) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        </div>
                        <a href="{{ route('servants.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    
    document.querySelector('input[name="img_sv"]')?.addEventListener('change', function(e) {
        const file = e.target.files[0];
        const reader = new FileReader();
        
        reader.onload = function(event) {
            const imgElement = document.createElement('img');
            imgElement.src = event.target.result;
            imgElement.classList.add('img-fluid', 'mt-2');
            
            
            const prevPreview = document.querySelector('.img-preview');
            if (prevPreview) {
                prevPreview.remove();
            }
            
            
            const container = e.target.closest('.card-body');
            imgElement.classList.add('img-preview');
            container.appendChild(imgElement);
        }
        
        reader.readAsDataURL(file);
    });
</script>
@endpush

@push('styles')
<style>
    .card-img-top {
        width: 100%;
        height: 400px;
        object-fit: cover;
    }
</style>
@endpush
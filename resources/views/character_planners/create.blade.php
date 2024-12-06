@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Create Character Planner</h1>

    <form action="{{ route('character_planners.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="servant_id" class="form-label">Servant</label>
            <select name="servant_id" id="servant_id" class="form-select">
                @foreach($servants as $servant)
                    <option value="{{ $servant->id }}">{{ $servant->name_sv }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3" id="materials-container">
            <label for="materials" class="form-label">Materials</label>
            <div class="material-container">
                <!-- Placeholder untuk dynamic material inputs -->
            </div>
            <button type="button" id="add-material-button" class="btn btn-secondary mt-2">
                Add Material
            </button>
        </div>

        <button type="submit" class="btn btn-primary">Save Planner</button>
    </form>
</div>

<script>
    // Menyediakan data material secara langsung dalam JavaScript
    const materials = [
        @foreach($materials as $material)
            { id: {{ $material->id }}, name: "{{ $material->name_mt }}" },
        @endforeach
    ];

    let materialCount = 0;
    const maxMaterials = 3;

    document.getElementById('add-material-button').addEventListener('click', function () {
        if (materialCount >= maxMaterials) {
            alert(`You can only add up to ${maxMaterials} materials.`);
            return;
        }

        const container = document.querySelector('.material-container'); // Selector untuk kontainer input material
        const div = document.createElement('div');
        div.classList.add('material-field', 'mb-2');

        // Dropdown untuk material
        const select = document.createElement('select');
        select.name = `materials[${materialCount}][id]`;  // Pastikan format name sesuai
        select.classList.add('form-select');
        materials.forEach(function (material) {
            const option = document.createElement('option');
            option.value = material.id;
            option.textContent = material.name;
            select.appendChild(option);
        });

        // Input untuk jumlah material
        const input = document.createElement('input');
        input.type = 'number';
        input.name = `materials[${materialCount}][amount]`;  // Pastikan format name sesuai
        input.classList.add('form-control', 'mt-2');
        input.placeholder = 'Amount';
        input.min = 1;

        div.appendChild(select);
        div.appendChild(input);
        container.appendChild(div);

        materialCount++;
    });
</script>


@endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-lg-8 mx-auto">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Material Details</h5>
                    <a href="{{ route('materials.index') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-arrow-left me-2"></i>Back to List
                    </a>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 text-center mb-3">
                            <img src="{{ route('materials.image', $material) }}" 
                                 alt="{{ $material->name_mt }}" 
                                 class="img-thumbnail mb-3" 
                                 style="max-width: 250px; max-height: 250px; object-fit: cover;"
                                 data-bs-toggle="modal" 
                                 data-bs-target="#imageModal"
                                 role="button">
                        </div>
                        <div class="col-md-8">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th class="w-25 bg-light">Name</th>
                                        <td>{{ $material->name_mt }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-light">Type</th>
                                        <td>{{ $material->type_mt }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-light">Drop Location</th>
                                        <td>{{ $material->drop_location_mt ?? 'N/A' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="mt-3">
                                <a href="{{ route('materials.edit', $material) }}" class="btn btn-warning me-2">
                                    <i class="fas fa-pencil-alt me-2"></i>Edit
                                </a>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                    <i class="fas fa-trash me-2"></i>Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">{{ $material->name_mt }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img src="{{ route('materials.image', $material) }}" 
                         alt="{{ $material->name_mt }}" 
                         class="img-fluid rounded">
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete the material <strong>{{ $material->name_mt }}</strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('materials.destroy', $material) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .img-thumbnail {
        cursor: pointer;
        transition: opacity 0.3s ease;
    }
    .img-thumbnail:hover {
        opacity: 0.8;
    }
</style>
@endpush
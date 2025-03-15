@extends('layouts.app')

@section('subtitle', 'Kategori')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Kategori')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Manage Kategori</div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <a href="/kategori/create" class="btn btn-primary btn-sm px-3">
                        <i class="fas fa-plus"></i> Add Kategori
                    </a>
                </div>
                
                {{ $dataTable->table(['class' => 'table-striped']) }}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush

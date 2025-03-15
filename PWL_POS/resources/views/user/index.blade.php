@extends('layouts.app')

@section('subtitle', 'Users')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Users')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Manage Users</div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <a href="/user/create" class="btn btn-primary btn-sm px-3">
                        <i class="fas fa-plus"></i> Add User
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

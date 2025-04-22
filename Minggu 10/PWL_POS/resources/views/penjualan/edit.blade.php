@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('penjualan/' . $penjualan->penjualan_id) }}" class="form-horizontal">
                @csrf
                @method('PUT')

                <div class="form-group row">
                    <label class="col-2 col-form-label">ID User</label>
                    <div class="col-10">
                        <select class="form-control" id="user_id" name="user_id" required>
                            <option value="">Id User</option>
                            @foreach ($user as $item)
                                <option value="{{ $item->user_id }}"
                                    {{ $item->user_id == $penjualan->user_id ? 'selected' : '' }}>{{ $item->user_id }}</option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-2 col-form-label">Nama Pembeli</label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="pembeli" name="pembeli"
                            value="{{ old('pembeli', $penjualan->pembeli) }}" required>
                        @error('pembeli')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-2 col-form-label">Kode Penjualan</label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="penjualan_kode" name="penjualan_kode"
                            value="{{ old('penjualan_kode', $penjualan->penjualan_kode) }}" required>
                        @error('penjualan_kode')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-2 col-form-label">Tanggal Penjualan</label>
                    <div class="col-10">
                        <input type="date" class="form-control" id="tanggal_penjualan" name="tanggal_penjualan"
                            value="{{ old('tanggal_penjualan', $penjualan->tanggal_penjualan ? date('Y-m-d', strtotime($penjualan->tanggal_penjualan)) : '') }}"
                            required>
                        @error('tanggal_penjualan')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-10 offset-2">
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        <a href="{{ url('penjualan') }}" class="btn btn-sm btn-secondary ml-1">Kembali</a>
                    </div>
            </form>
        </div>
    </div>
@endsection

@push('css')
@endpush

@push('js')
@endpush

@extends('layouts.app')

@section('subtitle', 'Kategori')
@section('content_header_title', 'Kategori')
@section('content_header_subtitle', 'Edit')

@section('content')
    <div class="container">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit Kategori</h3>
            </div>

            <form method="post" action="/kategori/update/{{ $data->kategori_id }}">
                @csrf
                @method('PUT')

                <div class="card-body">
                    <div class="form-group">
                        <label for="kodeKategori">Kode Kategori</label>
                        <input type="text" class="form-control" id="kodeKategori" name="kategori_kode" value="{{ $data->kategori_kode }}" placeholder="contoh: MKN" required>
                    </div>

                    <div class="form-group">
                        <label for="namaKategori">Nama Kategori</label>
                        <input type="text" class="form-control" id="namaKategori" name="kategori_nama" value="{{ $data->kategori_nama }}" placeholder="Nama" required>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Ubah</button>
                    <a href="/kategori" class="btn btn-danger">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection

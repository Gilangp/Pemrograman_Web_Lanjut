@extends('layouts.app')

@section('subtitle', 'User')
@section('content_header_title', 'User')
@section('content_header_subtitle', 'Edit')

@section('content')
    <div class="container">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit User</h3>
            </div>

            <form method="post" action="/user/update/{{ $data->user_id }}">
                @csrf
                @method('PUT')

                <div class="card-body">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username" value="{{ $data->username }}">
                    </div>
                    <div class="form-group">
                        <label for="namaUser">Nama User</label>
                        <input type="text" class="form-control" id="namaUser" name="namaUser" placeholder="Masukkan Nama User" value="{{ $data->nama }}">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="text" class="form-control" id="password" name="password" placeholder="Masukkan Password" value="{{ $data->password }}">
                    </div>
                    <div class="form-group">
                        <label for="idLevel">ID Level</label>
                        <input type="text" class="form-control" id="idLevel" name="idLevel" placeholder="Masukkan ID Level" value="{{ $data->idLevel }}">
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

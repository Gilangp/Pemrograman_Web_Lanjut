@extends('adminlte::page')
@section('title', 'Form User')
@section('content_header')
    <h1>Form User</h1>
@stop

@section('content')
<div class="card-body">
    <form>
        <div class="row">
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                    <label>Level Id Pengguna</label>
                    <input type="number" class="form-control" placeholder="Masukkan Level ID">
                    <label>Username</label>
                    <input type="text" class="form-control" placeholder="Masukkan Username">
                    <label>Nama</label>
                    <input type="text" class="form-control" placeholder="Masukkan Nama">
                    <label>Password</label>
                    <input type="password" class="form-control" placeholder="Masukkan Password">

                    <button type="submit" class="btn btn-info mt-2">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop

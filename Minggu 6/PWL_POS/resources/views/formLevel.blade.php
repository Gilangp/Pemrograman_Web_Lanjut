@extends('adminlte::page')
@section('title', 'Form Level')
@section('content_header')
    <h1>Form Level</h1>
@stop

@section('content')
<div class="card-body">
    <form>
        <div class="row">
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                    <label>Kode Level</label>
                    <input type="number" class="form-control" placeholder="Masukkan Kode Level">
                    <label>Nama Level</label>
                    <input type="text" class="form-control" placeholder="Masukkan Nama Level">

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

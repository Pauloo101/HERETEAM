@extends('layouts.master')
@section('content')

    <div class="m-5">
    <form method="POST" enctype="multipart/form-data" action="{{route('import_parse')}}"></form>
    @csrf
        <div class="card">
            <div class="card-header">
                importexcel
            </div>
            <div class="card-body">
                <input class="form-control form-control-sm" type="file" name="file_ex" />
                <br>
                <input type="checkbox" name="header" checked class="form-control"> File has Header??
                <br>
                <button class="btn btn-sm btn-outline-danger" type="submit"> parse file </button>
            </div>
        </div>
    </div>

@endsection

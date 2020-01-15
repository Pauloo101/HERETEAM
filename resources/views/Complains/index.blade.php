@extends('layouts.master')
@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Complain System</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Complain System</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row m-0">
        <div class="col">
           <complain></complain>
            <p>reply</p>
        </div>

        <div class="col">
            <notification></notification>
        </div>

    </div>





@endsection

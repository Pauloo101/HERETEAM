@extends('layouts.master')
@section('content')

     <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Settings</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Settings</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row m-0">
        <div class="col-md-4">
            <session></session>
            <div class="mt-4"></div>
            <term></term>
        </div>
        <div class="col-md-8">
            <settings></settings>
        </div>
    </div>










@endsection

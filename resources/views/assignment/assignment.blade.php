@extends('layouts.master')
@section('content')
<vue-progress-bar></vue-progress-bar>
<div>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Assignment</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">assignment</li>
                        <li class="breadcrumb-item active">create assignment</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div>
       <create-assignment></create-assignment>
    </div>
</div>




    @endsection


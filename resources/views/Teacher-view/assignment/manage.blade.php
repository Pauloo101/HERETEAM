@extends('layouts.teacher')
{{-- Teacher-view manage assignment --}}
@section('content')
<vue-progress-bar></vue-progress-bar>
<div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Assignment</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Assignment</a></li>
                        <li class="breadcrumb-item active">Manage Assignment</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div>
         <manage-assignment></manage-assignment>
    </div>
@endsection

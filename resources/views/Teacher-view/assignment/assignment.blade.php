@extends('layouts.teacher')
{{-- Teacher-view assignment --}}
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
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Assignment</li>
                        <li class="breadcrumb-item active">Create Assignment</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div>
         <create-assignment-teacher></create-assignment-teacher>
    </div>
@endsection

@extends('layouts.master')
@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Class</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Class</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-md-2">
            <div class="shadow card">
                <div class="card-header p-2">
                    <h3 class="card-title">ToolBar</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item active">
                            <router-link to="/createclass" class="nav-link">
                                <i class="fa fa-inbox"></i> Create Class
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-info-circle"></i> Student Information
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa fa-file-text-o"></i> Drafts
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa fa-filter"></i> Junk
                                <span class="badge bg-warning float-right">65</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-upload"></i> Import Student
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>


        <div class="col-md-10">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    Class Management
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="table-responsive">
                            <classroom :classroom = "{{$classroom}}" ></classroom>
                            </div>
                        </div>
                        <div class="col-md-4">
                        <createclass></createclass>
                        <createsection></createsection>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

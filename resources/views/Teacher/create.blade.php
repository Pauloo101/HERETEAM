@extends('layouts.master')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create new Student</div>

                    <div class="card-body">
                        <form enctype="multipart/form-data" method="post" action="{{ route('teacher.store') }}">
                            @csrf
                            <input type="text" class="form-control" name="name" placeholder="Name"
                                   style="  margin-bottom: 10px;"/>
                            <input class="form-control" type="text" name="username" placeholder="username"
                                   style="  margin-bottom: 10px;"/>
                            <input type="text" class="form-control" name="email" placeholder="email"
                                   style="  margin-bottom: 10px;"/>
                            <input type="text" ibnclass="form-control" name="class_id" placeholder="class_id"
                                   style="  margin-bottom: 10px;"/>
                            <input type="text" class="form-control" name="role" placeholder="role"
                                   style="margin-bottom: 10px;"/>
                            <input type="file" name="photo">
                            <button type="submit" class="btn-primary">Create Teacher</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
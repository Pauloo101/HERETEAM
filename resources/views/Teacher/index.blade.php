@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">

                    <h3 class="card-title">
                        Teacher
                    </h3>

                </div>
                <div class="col text-right">
                    <select class="form-control-sm" style="margin-right: 3px; width: 110px; height: 37px" name="" id="">
                        <option value="" selected>Select Class</option>
                    </select>
                    <router-link :to="{ name: 'CreateStudent'}" class="btn btn-primary">
                        More Options
                    </router-link>

                </div>
            </div>

        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div id="example1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="example1" class="table table-bordered table-striped dataTable" role="grid"
                               aria-describedby="example1_info">
                            <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Rendering engine: activate to sort column descending"
                                    aria-sort="ascending">
                                    ID
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Rendering engine: activate to sort column descending"
                                    aria-sort="ascending">
                                    Passport
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Browser: activate to sort column ascending">
                                    Name
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Platform(s): activate to sort column ascending">
                                    Username
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Engine version: activate to sort column ascending">
                                    Email
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending">
                                   Role
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending">
                                    Class Taking
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending">
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($teacher as $teachers)
                                <tr role="row" class="odd">
                                    <td class="sorting_1">{{$teachers->id}}</td>
                                    <td><img src="/img/{{$teachers->photo}}" style="width: 50px; height: 50px; border-radius: 50%;" alt=""></td>
                                    <td>{{$teachers->name}}</td>
                                    <td>{{$teachers->username}}</td>
                                    <td>{{$teachers->email}}</td>
                                    <td>{{$teachers->role}}</td>
                                    <td>{{$teachers->class_id}}</td>
                                    <td>
                                        <form action="{{ route('teacher.destroy',$teachers->id) }}" method="POST">

                                            <a class="btn btn-info" href="{{ route('teacher.show',$teachers->id) }}">Show</a>

                                            <a class="btn btn-primary" href="{{ route('teacher.edit',$teachers->id) }}">Edit</a>

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th rowspan="1" colspan="1">ID</th>
                                <th rowspan="1" colspan="1">Photo</th>
                                <th rowspan="1" colspan="1">Name</th>
                                <th rowspan="1" colspan="1">Username</th>
                                <th rowspan="1" colspan="1">Email</th>
                                <th rowspan="1" colspan="1">Role</th>
                                <th rowspan="1" colspan="1">Class Assigned to</th>
                                <th rowspan="1" colspan="1">Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
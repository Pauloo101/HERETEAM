@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-header ">
            <div class="row">
                <div class="col">
                    <h3 class="card-title"> Class</h3>
                </div>
                    <div class="col text-right">
                    <a href="/Class/create" class="btn btn-primary"> create class </a>
                    </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                <tr role="row">
                    <th>ID</th>
                    <th>Class Name</th>
                    <th>Class Subsection</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($classroom as $classrooms)
                <tr>
                    <td>{{$classrooms->id}}</td>
                    <td>{{$classrooms->name}}</td>
                    <td>Class Subsection</td>
                    <td>Action</td>
                </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endsection
@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h3 class="card-title"> Class</h3>
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
            <tr>
                <td>ID</td>
                <td>Class Name</td>
                <td>Class Subsection</td>
                <td>Action</td>
            </tr>
            </tbody>
        </table>
        </div>
    </div>
@endsection
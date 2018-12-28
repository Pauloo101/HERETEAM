@extends('layouts.master')
@section('content')

    <div class="container">
    <div class="card">
        <div class="card-header">
            Grade system
        </div>
        <div class="card-body">
            <div class="col-sm-10">
                <table class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>grade</th>
                        <th>Range</th>
                        <th>Remark</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1</td>
                        <td>A</td>
                        <td>100 - 70</td>
                        <td>Grade A</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    </div>

@endsection
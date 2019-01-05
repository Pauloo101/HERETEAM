@extends('layouts.master')
@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <h3 class="card-title">Subject</h3>
                    </div>
                    <div class="col text-right">
                        <a href="/subject/create" class="btn btn-primary"> Create Subject</a>
                        <router-link :to="{name: 'subject'}" class="btn btn-primary">subject create vue</router-link>
                    </div>
                </div>

            </div>
            <div class="card-body">
                <table class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <th> ID </th>
                        <th> Name </th>
                        <th>Assign to a class</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($subjects as $subject)
                        <tr>
                        <td>{{$subject->id}}</td>
                        <td>{{$subject->name}}</td>
                        <td>
                            <button class="btn btn-primary">assign</button>
                            <a class="btn btn-info" href="{{ route('subject.show',$subject->id) }}">Show</a>
                        </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

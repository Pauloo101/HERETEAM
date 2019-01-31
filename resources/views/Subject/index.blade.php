@extends('layouts.master')
@section('style')

@endsection
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
                        <th> ID</th>
                        <th> Name</th>
                        <th>Assign to a class</th>
                        <th>Register Students</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($subjects as $subject)
                        <tr>
                            <td>{{$subject->id}}</td>
                            <td>{{$subject->name}}</td>
                            <td>
                                <button class="btn btn-primary" data-toggle="modal" data-target='#{{$subject->name}}'>
                                    assign
                                </button>
                                <div role="group" class="btn-group">
                                    @foreach($subject->classrooms as $classrooms)
                                        @if ($classrooms->name)
                                            <button class="btn btn-primary"
                                                    type="button">{{$classrooms->name}}</button>
                                        @else
                                            <button class="btn btn-primary" type="button">no class
                                            </button>
                                        @endif
                                    @endforeach
                                </div>
                                {{--modal to assign subject to a class--}}
                                <div class="modal fade" id='{{$subject->name}}' tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">

                                        <div class="modal-content">
                                            <form method="post" action="{{ route('subject.assignclass') }}">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="exampleModalCenterTitle"> {{$subject->name}} </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    @csrf
                                                    Classes already Assigned
                                                    <input type="hidden" name="subject_id" value="{{$subject->id}}"
                                                           class="form-control">
                                                    <hr>
                                                    <div role="group" class="btn-group">
                                                        @foreach($subject->classrooms as $classrooms)
                                                            @if ($classrooms->name)
                                                                <button class="btn btn-primary"
                                                                        type="button">{{$classrooms->name}}</button>
                                                            @else
                                                                <button class="btn btn-primary" type="button">no class
                                                                </button>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                    <hr>
                                                    <label>Assign a new one </label><br>
                                                    <select name="classroom_id[]" class="form-control" multiple>
                                                        @foreach($classroom as $classrooms)
                                                            <option value="{{$classrooms->id}}"> {{$classrooms->name}} </option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">
                                                        Close
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </td>
                            <td><a class="btn btn-info" href="{{ route('subject.show',$subject->id) }}">Show</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
@stop

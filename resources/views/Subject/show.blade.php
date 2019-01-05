@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <ul class="list-group">
                @foreach($subject as $classrooms)
                    <li class="list-group-item">
                        <span>{{$classrooms->name}}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

@endsection
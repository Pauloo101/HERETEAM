@extends('layouts.master')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">
                    create Subject
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('subject.store')}}">
                        @csrf
                        <input type="text" class="form-control" name="name" placeholder="Class Name ...  e.g JSS1">
                        <button type="submit" class="btn btn-primary"> save </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
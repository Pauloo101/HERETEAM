@extends('layouts.master')
@section('style')
    {{--<link rel="stylesheet" href="{{asset('css/select2.min.css')}}">--}}
@endsection
@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Configurations</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item active">
                            <a href="#" class="nav-link">
                                <i class="fa fa-inbox"></i> Time Table
                                <span class="badge bg-primary float-right">12</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa fa-envelope-o"></i> Teachers
                                <span class="badge bg-warning float-right">5</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa fa-file-text-o"></i> Books
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa fa-filter"></i> Assignments
                                <span class="badge bg-warning float-right">65</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa fa-trash-o"></i> Record Management
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /. box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Registered classes</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <ul class="nav nav-pills flex-column">
                        @foreach($subject as $classrooms)
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    {{$classrooms->name}}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <!-- /.card-body -->
            </div>


            <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">{{$subname->name}}</h3>
                    {{--seacrh here --}}
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" placeholder="search for anything">
                            <div class="input-group-append">
                                <div class="btn btn-primary">
                                    <i class="fa fa-search"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body ">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h6>Register Subject to all students in a class</h6>
                                </div>
                                <form action="{{route('subject.RegClass')}}" method="post">
                                    <input name="subject_id" value="{{$subname->id}}" type="hidden">
                                    @csrf
                                    <div class="card-body">
                                        <select class="form-control form-group" name="classroom_id">
                                            <optgroup label="select a class">
                                                @foreach($subject as $classrooms)
                                                    <option value="{{$classrooms->id}}">{{$classrooms->name}}</option>
                                                @endforeach
                                            </optgroup>
                                        </select>
                                        <button class=" btn btn-outline-secondary" type="submit"> Register</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h6>Register Subject to one or more student(s)</h6>
                                </div>
                                <div class="card-body">
                                    <form method="post" action="{{ route('subject.Regstudent')}}">
                                        <input name="subject_id" value="{{$subname->id}}" type="hidden">
                                        @csrf
                                        <select class="form-control form-group select2" name="student_id[]"
                                                multiple="multiple" data-placeholder="Select or type matric_no">
                                            @foreach($students as $student)
                                                <option value="{{$student->id}}">{{$student->matric_no}}</option>
                                            @endforeach
                                        </select>
                                        <button class="btn btn-outline-secondary form-group" type="submit"
                                                style="margin-top: 10px"> Register
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h6> Record Management </h6>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <div class="example table-responsive">
                                    <table id="example5" class="table table-bordered table-hover dataTable example1">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Matric_no</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Class</th>
                                            <th>test one</th>
                                            <th>test two</th>
                                            <th>test three</th>
                                            <th>exam</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                             @foreach($studentsub as $ss)
                                        <tr>
                                            <td>{{$ss->pivot->id}}</td>
                                            <td>{{$ss->matric_no}}</td>
                                            <td>{{$ss->first_name}}</td>
                                            <td>{{$ss->last_name}}</td>
                                            <td>{{$ss->pivot->classroom_name}}</td>
                                            <td>{{$ss->pivot->testone}}</td>
                                            <td>{{$ss->pivot->testtwo}}</td>
                                            <td>{{$ss->pivot->testthree}}</td>
                                            <td>{{$ss->pivot->exam}}</td>
                                        </tr>
                                             @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /. box -->
        </div>
    </div>

@endsection
@section('javascript')
    <script src="{{ asset('plugins/jquery/jquery.min.js')}}"></script>
    {{--<script type="text/javascript" src="{{ URL::asset('plugins/jquery/jquery.js') }}"></script>--}}
    <script src="{{ asset('js/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/jquery.tabledit.min.js') }}"></script>
    {{--<script src="{{ asset('js/babel-external-helpers.js') }}"></script>--}}
    <script src="{{asset('js/jqtabledit.js')}}"></script>
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()
        })
    </script>
    <script>
    </script>
    <script>
        // //table search
        // $(function () {
        //     $('#search_field').on('keyup', function() {
        //         var value = $(this).val();
        //         var patt = new RegExp(value, "i");
        //
        //         $('#myTable').find('tr').each(function() {
        //             if (!($(this).find('td').text().search(patt) >= 0)) {
        //                 $(this).not('.myHead').hide();
        //             }
        //             if (($(this).find('td').text().search(patt) >= 0)) {
        //                 $(this).show();
        //             }
        //
        //         });
        //     });
        // })

    </script>
    <script>
        $(function () {
            $(".example1").DataTable();

        });

    </script>


@stop

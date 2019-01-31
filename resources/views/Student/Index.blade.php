@extends('layouts.master')
@section('content')
    <div class="container text-right">
    </div>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h3 class="card-title">Student</h3>
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
                        <table id="example1" class="table table-bordered table-hover dataTable" role="grid"
                               aria-describedby="example1_info">
                            <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Rendering engine: activate to sort column descending"
                                    aria-sort="ascending">
                                    ID
                                </th>
                                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Rendering engine: activate to sort column descending"
                                    aria-sort="ascending">
                                    Passport
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Browser: activate to sort column ascending">
                                    Matric Number
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Platform(s): activate to sort column ascending">
                                    First Name
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="Engine version: activate to sort column ascending">
                                    Last Name
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending">
                                    Gender
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending">
                                    DOB
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending">
                                    Class
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                    aria-label="CSS grade: activate to sort column ascending">
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($student as $students)
                                <tr role="row" class="odd">
                                    <td class="sorting_1">{{$students->id}}</td>
                                    <td><img src="/img/{{$students->photo}}"
                                             style="width: 50px; height: 50px; border-radius: 50%;"></td>
                                    <td>{{$students->matric_no}}</td>
                                    <td>{{$students->first_name}}</td>
                                    <td>{{$students->last_name}}</td>
                                    <td>{{$students->gender}}</td>
                                    <td>{{$students->DOB}}</td>
                                    <td>{{$students->classroom->name}}</td>
                                    <td>
                                        <form action="{{ route('student.destroy',$students->id) }}" method="POST">

                                            <a class="btn btn-info" href="{{ route('student.show',$students->id) }}"><i class="far fa-eye"></i></a>

                                            <a class="btn btn-primary" href="{{ route('student.edit',$students->id) }}"><i class="far fa-edit"></i></a>

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                        </form>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th rowspan="1" colspan="1">ID</th>
                                <th rowspan="1" colspan="1">Passport</th>
                                <th rowspan="1" colspan="1">Matric Number</th>
                                <th rowspan="1" colspan="1">First Name</th>
                                <th rowspan="1" colspan="1">Last Name</th>
                                <th rowspan="1" colspan="1">Gender</th>
                                <th rowspan="1" colspan="1">DOB</th>
                                <th rowspan="1" colspan="1">Class</th>
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

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Payments</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="jumbotron">
                        school fee
                        bus fee
                        hostel
                        feeding

                    </div>

                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Parent's info</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="jumbotron">
                        school fee
                        bus fee
                        hostel
                        feeding

                    </div>

                </div>
                <!-- /.card-body -->
            </div>
        </div>

    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Payments</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="jumbotron">
                    school fee
                    bus fee
                    hostel
                    feeding

                </div>

            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('javascript')
    <script src="./plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables -->
    <script src="./plugins/datatables/jquery.dataTables.js"></script>
    <script src="./plugins/datatables/dataTables.bootstrap4.js"></script>
    <!-- SlimScroll -->
    <script src="./plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="./plugins/fastclick/fastclick.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="./dist/js/demo.js"></script>

    <script>

    </script>
    <!-- page script -->
    <script>
        $(function () {
            $("#example1").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });

    </script>
@stop

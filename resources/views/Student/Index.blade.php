@extends('layouts.master')
@section('content')
<div class="container text-right">
</div>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h3 class="card-title">Students</h3>
                </div>
                <div class="col text-right">
                    <router-link :to="{ name: 'toolbar'}" class="btn btn-primary">
                        toolbar
                    </router-link>
                </div>
            </div>

        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div id="example1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                            <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column descending"  aria-sort="ascending">
                                    ID
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                                    Matric Number
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                    First Name
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">
                                    Last Name
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">
                                    Gender
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">
                                    DOB
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($student as $students)
                                <tr role="row" class="odd">
                                    <td class="sorting_1">{{$students->id}}</td>
                                    <td>{{$students->matric_no}}</td>
                                    <td>{{$students->first_name}}</td>
                                    <td>{{$students->last_name}}</td>
                                    <td>{{$students->gender}}</td>
                                    <td>{{$students->DOB}}</td>
                                    <td>
                                        <a href="{{route('student.edit',$students->id)}}" class="btn btn-success" type="submit" style="margin-left: 5px;">
                                            <i class="fas fa-edit" style="font-size: 15px;">
                                            </i>
                                        </a>
                                        <a href="#" class="btn btn-danger" type="submit" style="margin-left: 5px;"
                                           onclick="
                                var result = confirm('Are you sure u want to delete this student ?');
                                if(result){
                                    event.preventDefault();
                                    document.getElementById('delete-form').submit();}">
                                            <i class="fa fa-trash" style="font-size: 15px;"></i>
                                        </a>
                                        <button class="btn" type="submit" style="margin-left: 5px; background-color:#1A8D9D; ">
                                            <i class="fa fa-eye" style="font-size: 15px;"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th rowspan="1" colspan="1">ID</th>
                                <th rowspan="1" colspan="1">Matric Number</th>
                                <th rowspan="1" colspan="1">First Name</th>
                                <th rowspan="1" colspan="1">Last Name</th>
                                <th rowspan="1" colspan="1">Gender</th>
                                <th rowspan="1" colspan="1">DOB</th>
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

@endsection

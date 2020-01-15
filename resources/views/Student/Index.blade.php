@extends('layouts.master')
@section('content')
<vue-progress-bar></vue-progress-bar>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Student</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Student</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="row">

    <div class="col-md-2">
        <div class="shadow card">
            <div class="card-header">
                <h3 class="card-title">ToolBar</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item active">
                        <router-link :to="{name: 'admission'}" class="nav-link">
                            <i class="fa fa-inbox mr-3"></i>Student Admission
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{name: 'configstudent'}" class="nav-link">
                            <i class="fas fa-tachometer-alt mr-3"></i>Students Overview
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{name: 'promotestudents'}" class="nav-link">
                            <i class="fas fa-level-up-alt mr-3"></i>Promote Students
                        </router-link>
                    </li>
                    <!-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa fa-filter"></i> Junk
                                <span class="badge bg-warning float-right">65</span>
                            </a>
                        </li> -->
                    <li class="nav-item active">
                        <router-link to="/parents" class="nav-link">
                            Match student to parent
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{name: 'importstudent'}" class="nav-link">
                            <i class="fas fa-upload"></i> Import Student
                        </router-link>
                    </li>
                </ul>
            </div>
        </div>
    </div>


    <div class="col-md-10">
        <div class="card card-primary card-outline">
            <div class="card-header">
                Student Management
            </div>
            <router-view></router-view>
        </div>
    </div>
</div>




@endsection
@section('javascript')

<!-- Bootstrap 4 -->
{{--<script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>--}}
{{--<!-- DataTables -->--}}
{{--<script src="./plugins/datatables/jquery.dataTables.js"></script>--}}
{{--<script src="./plugins/datatables/dataTables.bootstrap4.js"></script>--}}
{{--<!-- SlimScroll -->--}}
{{--<script src="./plugins/slimScroll/jquery.slimscroll.min.js"></script>--}}
{{--<!-- FastClick -->--}}
{{--<script src="./plugins/fastclick/fastclick.js"></script>--}}
{{--<!-- AdminLTE for demo purposes -->--}}
{{--<script src="./dist/js/demo.js"></script>--}}

<script>

</script>
<!-- page script -->
{{-- <script>
        $(function () {
            $("#example1").DataTable();

        }); --}}

{{-- </script> --}}
@stop

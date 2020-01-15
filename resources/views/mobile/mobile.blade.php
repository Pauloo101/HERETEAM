@extends('layouts.master')
@section('content')

<vue-progress-bar></vue-progress-bar>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Mobile module</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Mobile module</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-2">
        <div class="card">
            <div class="card-header p-2">
                <h3 class="card-title">ToolBar</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <router-link to="/payment-overview" class="nav-link">
                            Payments Overview
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/pms" class="nav-link">
                            Payments System
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link to="/assignbill" class="nav-link">
                            Assign fee to student(s)
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link to="/debtors" class="nav-link">
                            Debtors
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link to="/transactions" class="nav-link">
                            Transcations
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/history" class="nav-link">
                               History
                            </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="notifications" class="nav-link">
                            Notification
                        </router-link>
                    </li>
                </ul>
            </div>
        </div>
        <div>
            <payment-utility></payment-utility>
        </div>
    </div>

    <div class="col-md-10 shadow">
        <router-view>

        </router-view>
    </div>


</div>
<div class="row">
    {{-- <calculator></calculator> --}}
</div>


@endsection

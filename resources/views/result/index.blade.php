@extends('layouts.master')
@section('content')
<vue-progress-bar></vue-progress-bar>
     <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Result</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Result System</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col ml-5 mr-5">
            <ul class="nav nav-tabs nav-fill">
                <li class="nav-item"><a class="nav-link active" role="tab" data-toggle="tab" href="#tab-1">Edit Results</a></li>
                <li class="nav-item"><a class="nav-link" role="tab" data-toggle="tab" href="#tab-2">Approve Result</a></li>
                <li class="nav-item"><a class="nav-link" role="tab" data-toggle="tab" href="#tab-3">Advanced Printing</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" role="tabpanel" id="tab-1">
                   <div class="bg-light">
                         <edit-result>
                       </edit-result>
                   </div>
                </div>
                <div class="tab-pane" role="tabpanel" id="tab-2">
                    <div class="bg-light">
                     <result-approve></result-approve>
                    </div>
                </div>
                <div class="tab-pane" role="tabpanel" id="tab-3">
                    <p>Content for tab 3.</p>
                </div>
            </div>
         </div>
    </div>


@endsection

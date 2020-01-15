@extends('layouts.master')
@section('content')

<div class="row mt-3">
    <div class="col-md-6 col-xl-3 mb-4">
        <div class="card shadow border-primary py-2">
            <div class="card-body">
                <div class="row align-items-center no-gutters">
                    <div class="col mr-2">
                        <div class="text-uppercase text-primary font-weight-bold text-xs mb-1"><span>Total Registered Student</span></div>
                        <div class="text-dark font-weight-bold h5 mb-0"><span>600</span></div>
                    </div>
                    <div class="col-auto"><i class="fas fa-graduation-cap fa-2x text-gray-300"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3 mb-4">
        <div class="card shadow border-success py-2">
            <div class="card-body">
                <div class="row align-items-center no-gutters">
                    <div class="col mr-2">
                        <div class="text-uppercase text-success font-weight-bold text-xs mb-1"><span>Total Registered Teachers</span></div>
                        <div class="text-dark font-weight-bold h5 mb-0"><span>85</span></div>
                    </div>
                    <div class="col-auto"><i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3 mb-4">
        <homesetting></homesetting>
    </div>
    <div class="col-md-6 col-xl-3 mb-4">
        <div class="card shadow border-secondary py-2">
            <div class="card-body">
                <div class="row align-items-center no-gutters">
                    <div class="col mr-2">
                        <div class="text-uppercase text-secondary font-weight-bold text-xs mb-1"><span>Pending Complains</span></div>
                        <div class="text-dark font-weight-bold h5 mb-0"><span>18</span></div>
                    </div>
                    <div class="col-auto"><i class="fas fa-comments fa-2x text-gray-300"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row  " >
    <div class="col">
       <notifications></notifications>
    </div>
    <div class="col">
       <complain-system></complain-system>
    </div>
     <div class="col">
        {{-- <div class="col">
            <!-- DIRECT CHAT SUCCESS -->
            <div class="card card-success card-outline direct-chat direct-chat-success">
                <div class="card-header">
                    <h3 class="card-title">Direct Chat</h3>

                    <div class="card-tools">
                        <span data-toggle="tooltip" title="3 New Messages" class="badge bg-success">3</span>
                        {{-- <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i> --}}
                        {{-- </button>
                        <button type="button" class="btn btn-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle">
                            <i class="fa fa-comments"></i></button> --}}
                        {{-- <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i> --}}
                        {{-- </button> --}}
                    {{-- </div> --}}
                {{-- </div> --}}
                <!-- /.card-header -->
                {{-- <div class="card-body" style="display: block;">
                    <!-- Conversations are loaded here -->
                    <div class="direct-chat-messages">
                        <!-- Message. Default to the left -->
                        <div class="direct-chat-msg">
                            <div class="direct-chat-info clearfix">
                                <span class="direct-chat-name float-left">Alexander Pierce</span>
                                <span class="direct-chat-timestamp float-right">23 Jan 2:00 pm</span>
                            </div> --}}
                            <!-- /.direct-chat-info -->
                            {{-- <img class="direct-chat-img" src="../dist/img/user1-128x128.jpg" alt="Message User Image">
                            <!-- /.direct-chat-img -->
                            <div class="direct-chat-text">
                                Is this template really for free? That's unbelievable!
                            </div> --}}
                            <!-- /.direct-chat-text -->
                        {{-- </div> --}}
                        <!-- /.direct-chat-msg -->

                        <!-- Message to the right -->
                        {{-- <div class="direct-chat-msg right">
                            <div class="direct-chat-info clearfix">
                                <span class="direct-chat-name float-right">Sarah Bullock</span>
                                <span class="direct-chat-timestamp float-left">23 Jan 2:05 pm</span>
                            </div> --}}
                            <!-- /.direct-chat-info -->
                            {{-- <img class="direct-chat-img" src="../dist/img/user3-128x128.jpg" alt="Message User Image">
                            <!-- /.direct-chat-img -->
                            <div class="direct-chat-text">
                                You better believe it!
                            </div>
                            <!-- /.direct-chat-text -->
                        </div>
                        <!-- /.direct-chat-msg -->
                    </div> --}}
                    <!--/.direct-chat-messages-->

                    <!-- Contacts are loaded here -->
                    {{-- <div class="direct-chat-contacts">
                        <ul class="contacts-list">
                            <li>
                                <a href="#">
                                    <img class="contacts-list-img" src="../dist/img/user1-128x128.jpg">

                                    <div class="contacts-list-info">
                                        <span class="contacts-list-name">
                                            Count Dracula
                                            <small class="contacts-list-date float-right">2/28/2015</small>
                                        </span>
                                        <span class="contacts-list-msg">How have you been? I was...</span>
                                    </div>
                                    <!-- /.contacts-list-info -->
                                </a>
                            </li>
                            <!-- End Contact Item -->
                        </ul>
                        <!-- /.contatcts-list -->
                    </div>
                    <!-- /.direct-chat-pane -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer" style="display: block;">
                    <form action="#" method="post">
                        <div class="input-group">
                            <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                            <span class="input-group-append">
                                <button type="submit" class="btn btn-success">Send</button>
                            </span>
                        </div>
                    </form>
                </div>
                <!-- /.card-footer-->
            </div> --}}
            <!--/.direct-chat
        </div>  -->
    <!-- </div> -->
</div>





@endsection

@extends('cms.layout.cmslayout')
@section('contents')
    <nav class="navbar navbar-expand-lg navbar-dark pb_navbar pb_scrolled-light" id="pb-navbar">
        <div class="container">
            <a class="navbar-brand" href="index.html"><img class="img-fluid" style="height: 70px" src="img/fountainlogo.png" alt="Fountain Int'l High school"></a>
            <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#probootstrap-navbar" aria-controls="probootstrap-navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span><i class="ion-navicon"></i></span>
            </button>
            <div class="collapse navbar-collapse" id="probootstrap-navbar">
                <ul class="navbar-nav ml-auto" >
                    <li class="nav-item"><a  class="nav-link" href="/">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="/about">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="#section-news">News and Events</a></li>
                    <li class="nav-item"><a class="nav-link" href="/gallery">Gallery</a></li>
                    <li class="nav-item"><a class="nav-link" href="/teachers">Staff</a></li>
                    <li class="nav-item"><a class="nav-link" href="#section-pricing">Facilities</a></li>

                </ul>
            </div>
        </div>
    </nav>

        <div class="container paragraph pt-5">
            <div class="row no-gutters pt-5 pb-5">
                <div class="col-md-8 border col-sm-12 ml-md-5 p-0 mb-5">
                        <div class="container p-0">
                            <div class="row no-gutters p-0">
                                <div class="col-12">
                                    <div class="">
                                        <img src="img/transport.jpg" alt="" class="img-fluid events">
                                        <h1 class="events-heading">
                                            <span class="events-heading-span">heading</span></h1>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div>
                                        <h2 class="heading-phrase text-info">Sub heading</h2>
                                        <P class="border-left pl-3">Content in full</P>

                                    </div>
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-12 col-md-6">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <img src="img/transport.jpg" class="img-fluid events" alt="">
                                            <h1 class="events-heading">
                                                <span class="events-heading-span">heading</span></h1>
                                        </div>
                                        <div class="col-12">
                                            <h2 class="heading-phrase text-info">Sub heading</h2>
                                            <P class="border-left pl-3">Content in full</P>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <img src="img/transport.jpg" class="img-fluid events" alt="">
                                            <h1 class="events-heading">
                                                <span class="events-heading-span">heading</span></h1>
                                        </div>
                                        <div class="col-12">
                                            <h2 class="heading-phrase text-info">Sub heading</h2>
                                            <P class="border-left pl-3">Content in full</P>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <img src="img/transport.jpg" class="img-fluid events" alt="">
                                            <h1 class="events-heading">
                                                <span class="events-heading-span">heading</span></h1>
                                        </div>
                                        <div class="col-12">
                                            <h2 class="heading-phrase text-info">Sub heading</h2>
                                            <P class="border-left pl-3">Content in full</P>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="row no-gutters">
                                        <div class="col-12">
                                            <img src="img/transport.jpg" class="img-fluid events" alt="">
                                            <h1 class="events-heading">
                                                <span class="events-heading-span">heading</span></h1>
                                        </div>
                                        <div class="col-12">
                                            <h2 class="heading-phrase text-info">Sub heading</h2>
                                            <P class="border-left pl-3">Content in full</P>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row border ml-0 mr-0 mb-2">
                                <div class="col-12">
                                    <div class="row ">
                                        <div class="col-3 p-0 m-0">
                                            <img src="img/transport.jpg" class="img-fluid events" alt="">

                                        </div>
                                        <div class="col-9">
                                            <h2 class="heading-name text-info">Sub heading</h2>
                                            <P class="border-left pl-3">Content in full</P>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row border m-0">
                                <div class="col-12">
                                    <div class="row ">
                                        <div class="col-3 p-0 m-0">
                                            <img src="img/transport.jpg" class="img-fluid events" alt="">

                                        </div>
                                        <div class="col-9">
                                            <h2 class="heading-name text-info">Sub heading</h2>
                                            <P class="border-left pl-3">Content in full</P>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                </div>
                <div class="col-md-3 col-sm-12 ml-md-5 ml-lg-5">
                    <div class="card bg-dark">
                        <div class="card-body text-center">
                            <h1 class="heading-name"> Quick links </h1>
                            <hr class="block bg-light">
                          <ul class="list-unstyled">
                              <li><a href="#">About us</a></li>
                              <li><a href="#">Our History</a></li>
                              <li><a href="#">Aim and Objectives</a></li>
                              <li><a href="#">Mission & Vision</a></li>
                              <li><a href="#">Career in Fountain</a></li>
                              <li><a href="#"> Entrepreneurship</a></li>
                              <li><a href="#">Ours Staffs</a></li>
                              {{--<li><a href="#"></a></li>--}}
                          </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@stop



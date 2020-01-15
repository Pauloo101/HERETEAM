@extends('cms.layout.cmslayout')
@section('style')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Acme" />
    <link rel="stylesheet" href="{{asset('css/Lightbox-Gallery.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css">
    @endsection

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
    <div class="container">
        <div class="jumbotron" style="background-image: url('img/school.png');background-color: rgba(156,181,205,0.2);">
            <div class="row mt-5 align-items-center">
                <div class="col text-center">
                    <h1 class="heading-phrase" style="font-family: Acme, sans-serif;font-weight: bold;color: rgb(255,255,255);">About Fountain </h1>
                </div>
                <div class="col"><img class="img-fluid " src="img/fountainlogo.png" style="width: 40%" /></div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="paragraph">
            <ul class="nav nav-tabs">
                <li class="nav-item"><a role="tab" data-toggle="tab" class="nav-link active" href="#tab-1">History</a></li>
                <li class="nav-item"><a role="tab" data-toggle="tab" class="nav-link" href="#tab-2">Aim and Objectives</a></li>
                <li class="nav-item"><a role="tab" data-toggle="tab" class="nav-link" href="#tab-3">Entrepreneurship</a></li>
                <li class="nav-item"><a role="tab" data-toggle="tab" class="nav-link" href="#tab-4">Staff</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade show active" id="tab-1">
                    <p>History</p>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab-2">
                    <ul class="mt-3">
                        <li>To instill both academic and moral discipline</li>
                        <li>To build future leaders that will make positive impact on their society</li>
                        <li>To guide the students towards achieving academic excellence.</li>
                        <li>To make the students self-reliant through teaching and learning entrepreneurial
                            skills
                        </li>
                        <li>To broaden the academic and social horizons of students through exposure to IT
                        </li>
                        <li>To develop in the students, spirit of tolerance and patriotism</li>
                        <li>To cater for the spiritual well-begin of the students</li>
                        <li>To build leadership qualities in students.</li>
                    </ul>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab-3">
                    <div class="photo-gallery">
                        <div class="container">
                            <div class="intro">
                                <h2 class="text-center">Entrepreneurship</h2>
                                <p class="text-center">  </p>
                            </div>
                            <div class="row photos">
                                <div class="col-sm-6 col-md-4 col-lg-3 item"><a data-lightbox="photos" href="img/gallery/DSC00856.jpg"><img class="img-fluid" src="img/gallery/DSC00856.JPG" /></a></div>
                                <div class="col-sm-6 col-md-4 col-lg-3 item"><a data-lightbox="photos" href="img/gallery/ComLab.JPG"><img class="img-fluid" src="img/gallery/ComLab.JPG" /></a></div>
                                <div class="col-sm-6 col-md-4 col-lg-3 item"><a data-lightbox="photos" href="img/gallery/sLab.JPG"><img class="img-fluid" src="img/gallery/sLab.JPG" /></a></div>
                                <div class="col-sm-6 col-md-4 col-lg-3 item"><a data-lightbox="photos" href="img/gallery/DSC02177.JPG"><img class="img-fluid" src="img/gallery/DSC02177.JPG" /></a></div>
                                <div class="col-sm-6 col-md-4 col-lg-3 item"><a data-lightbox="photos" href="img/gallery/r1.JPG"><img class="img-fluid" src="img/gallery/r1.JPG" /></a></div>
                                <div class="col-sm-6 col-md-4 col-lg-3 item"><a data-lightbox="photos" href="img/gallery/r2.JPG"><img class="img-fluid" src="img/gallery/r2.JPG" /></a></div>
                                <div class="col-sm-6 col-md-4 col-lg-3 item"><a data-lightbox="photos" href="img/gallery/te4.JPG"><img class="img-fluid" src="img/gallery/r2.JPG" /></a></div>
                                <div class="col-sm-6 col-md-4 col-lg-3 item"><a data-lightbox="photos" href="img/gallery/DSC02203.JPG"><img class="img-fluid" src="img/gallery/DSC02203.JPG" /></a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab-4">
                    <div class="photo-gallery">
                        <div class="container">
                            <div class="intro">
                                <h2 class="text-center">Staff</h2>
                                <p class="text-center"> </p>
                            </div>
                            <div class="row photos">
                                <div class="col-sm-6 col-md-4 col-lg-3 item"><a data-lightbox="photos" href="img/gallery/DSC00856.jpg"><img class="img-fluid" src="img/gallery/DSC00856.JPG" /></a></div>
                                <div class="col-sm-6 col-md-4 col-lg-3 item"><a data-lightbox="photos" href="img/gallery/ComLab.JPG"><img class="img-fluid" src="img/gallery/ComLab.JPG" /></a></div>
                                <div class="col-sm-6 col-md-4 col-lg-3 item"><a data-lightbox="photos" href="img/gallery/sLab.JPG"><img class="img-fluid" src="img/gallery/sLab.JPG" /></a></div>
                                <div class="col-sm-6 col-md-4 col-lg-3 item"><a data-lightbox="photos" href="img/gallery/DSC02177.JPG"><img class="img-fluid" src="img/gallery/DSC02177.JPG" /></a></div>
                                <div class="col-sm-6 col-md-4 col-lg-3 item"><a data-lightbox="photos" href="img/gallery/r1.JPG"><img class="img-fluid" src="img/gallery/r1.JPG" /></a></div>
                                <div class="col-sm-6 col-md-4 col-lg-3 item"><a data-lightbox="photos" href="img/gallery/r2.JPG"><img class="img-fluid" src="img/gallery/r2.JPG" /></a></div>
                                <div class="col-sm-6 col-md-4 col-lg-3 item"><a data-lightbox="photos" href="img/gallery/te4.JPG"><img class="img-fluid" src="img/gallery/r2.JPG" /></a></div>
                                <div class="col-sm-6 col-md-4 col-lg-3 item"><a data-lightbox="photos" href="img/gallery/DSC02203.JPG"><img class="img-fluid" src="img/gallery/DSC02203.JPG" /></a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('javascript')
    <script src="js/jquery-2.1.1.js"></script>
    <script src=" https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>
@stop

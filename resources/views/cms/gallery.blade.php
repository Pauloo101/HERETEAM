@extends('cms.layout.cmslayout')
@section('style')
    {{-- <link rel="stylesheet" href="{{asset('css/Lightbox-Gallery.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css"> --}}
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

<section class="pb_section bg-image pb-5" >
    <div class="container" >
        <div class="row align-items-center justify-content-center border no-gutters grad mt-5">
           <div class="col text-center">
              <div class="col text-center">
                      <h1 style="font-family: Crimson, sans-serif;" class="display-4 text-white" >Fountain</h1>
              </div>
               <div class="col text-center">
                   <h3 class="text-white">Gallery</h3>
               </div>
           </div>
            <div class="col-8">
                <div class="carousel slide" data-ride="carousel" id="carousel-1">
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active"><img class="w-100 d-block" src="img/computer.jpg" alt="Music" /></div>
                        <div class="carousel-item"><img class="w-100 d-block" src="img/computer.jpg" alt="computer" /></div>
                        <div class="carousel-item"><img class="w-100 d-block" src="img/computer.jpg" alt="science" /></div>
                        <div class="carousel-item"><img class="w-100 d-block" src="img/computer.jpg" alt="science" /></div>
                    </div>
                    <div><a class="carousel-control-prev" href="#carousel-1" role="button" data-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="sr-only">Previous</span></a><a class="carousel-control-next" href="#carousel-1" role="button"
                                                                                                                                                                                                                            data-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="sr-only">Next</span></a></div>
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-1" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-1" data-slide-to="1"></li>
                        <li data-target="#carousel-1" data-slide-to="2"></li>
                        <li data-target="#carousel-1" data-slide-to="3"></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="container">
<div class="row">
    <div class="col text-center">
    <h1 style="font-family: Crimson, cursive;">Sport Activities</h1>
    </div>
</div>

<section class="pb_section  pt-5 pb-5">

    <div class="container">
        <div class="row fbox3">
            <div class="col-sm-4 d-flex justify-content-center align-items-center">
                <a data-fancybox="gallery" data-caption="Milo Competition" href="img/gallery/DSC00743.JPG">
                    <div>
                        <img class="img-fluid" src="img/gallery/DSC00743.JPG" alt="fountain photo gallery" />
                        <div class="col w-100 h-25 p-3" style="background-color: rgba(114,198,123,0.74);margin-top: -57px;">
                            <span style="color: rgb(255,255,255);font-family: Crimson, cursive;">Milo Competition</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-4 d-flex justify-content-center align-items-center">
                <a data-fancybox="gallery" data-caption="Milo Stuff " href="img/gallery/r5.JPG">
                    <div>
                        <img class="img-fluid" src="img/gallery/r5.JPG" alt="fountain photo gallery" />
                        <div class="col w-100 h-25 p-3" style="background-color: rgba(114,198,123,0.74);margin-top: -57px;">
                            <span style="color: rgb(255,255,255);">Text</span></div>
                    </div>
                </a>
            </div>
            <div class="col-sm-4 d-flex justify-content-center align-items-center">
                <a data-fancybox="gallery" data-caption="Milo Stuff " href="img/gallery/r8.JPG">
                    <div>
                        <img class="img-fluid" src="img/gallery/r8.JPG" alt="fountain photo gallery" />
                        <div class="col w-100 h-25 p-3" style="background-color: rgba(114,198,123,0.74);margin-top: -57px;">
                            <span style="color: rgb(255,255,255);">Text</span></div>
                    </div>
                </a>
            </div>
            <div class="col-sm-4 d-flex justify-content-center align-items-center">
                <a data-fancybox="gallery" data-caption="Milo Stuff " href="img/gallery/DSC02177.JPG">
                    <div>
                        <img class="img-fluid" src="img/gallery/DSC02177.JPG" alt="fountain photo gallery" />
                        <div class="col w-100 h-25 p-3" style="background-color: rgba(114,198,123,0.74);margin-top: -57px;">
                            <span style="color: rgb(255,255,255);">Text</span></div>
                    </div>
                </a>
            </div>
            <div class="col-sm-4 d-flex justify-content-center align-items-center">
                <a data-fancybox="gallery" data-caption="Milo Stuff " href="img/gallery/ne1.JPG">
                    <div>
                        <img class="img-fluid" src="img/gallery/net.jpg" alt="fountain photo gallery" />
                        <div class="col w-100 h-25 p-3" style="background-color: rgba(114,198,123,0.74);margin-top: -57px;">
                            <span style="color: rgb(255,255,255);">Text</span></div>
                    </div>
                </a>
            </div>
            <div class="col-sm-4 d-flex justify-content-center align-items-center">
                <a data-fancybox="gallery" data-caption="Milo Stuff " href="img/gallery/DSC00856.JPG">
                    <div>
                        <img class="img-fluid" src="img/gallery/DSC00856.JPG" alt="fountain photo gallery" />
                        <div class="col w-100 h-25 p-3" style="background-color: rgba(114,198,123,0.74);margin-top: -57px;">
                            <span style="color: rgb(255,255,255);">Text</span></div>
                    </div>
                </a>
            </div>
        </div>
    </div>

</section>
</div>

<div class="container">
<div class="row">
    <div class="col text-center">
        <h1 style="font-family: Crimson, cursive;">School Events </h1>
    </div>
</div>

<section class="  pt-5 pb-0 h-100">

    <div class="container">
        <div class="row fbox3">
            <div class="col-sm-4 d-flex justify-content-center align-items-center">
                <a data-fancybox="gallery" data-caption="Milo Competition " href="img/events/eventseven.jpg">
                    <div>
                        <img class="img-fluid" src="img/events/eventseven.jpg" alt="fountain photo gallery" />
                        <div class="col w-100 h-25 p-3" style="background-color: rgba(114,198,123,0.74);margin-top: -57px;">
                            <span style="color: rgb(255,255,255);font-family: Crimson, cursive;">Text</span></div>
                    </div>
                </a>
            </div>
            <div class="col-sm-4 d-flex justify-content-center align-items-center">
                <a data-fancybox="gallery" data-caption="Milo Stuff " href="img/events/four.jpg">
                    <div>
                        <img class="img-fluid" src="img/events/four.jpg" alt="fountain photo gallery" />
                        <div class="col w-100 h-25 p-3" style="background-color: rgba(114,198,123,0.74);margin-top: -57px;">
                            <span style="color: rgb(255,255,255);">Text</span></div>
                    </div>
                </a>
            </div>
            <div class="col-sm-4 d-flex justify-content-center align-items-center">
                <a data-fancybox="gallery" data-caption="Milo Stuff " href="img/events/one.jpg">
                    <div>
                        <img class="img-fluid" src="img/events/one.jpg" alt="fountain photo gallery" />
                        <div class="col w-100 h-25 p-3" style="background-color: rgba(114,198,123,0.74);margin-top: -57px;">
                            <span style="color: rgb(255,255,255);">Text</span></div>
                    </div>
                </a>
            </div>
            <div class="col-sm-4 d-flex justify-content-center align-items-center">
                <a data-fancybox="gallery" data-caption="Milo Stuff " href="img/events/two.jpg">
                    <div>
                        <img class="img-fluid" src="img/events/two.jpg" alt="fountain photo gallery" />
                        <div class="col w-100 h-25 p-3" style="background-color: rgba(114,198,123,0.74);margin-top: -57px;">
                            <span style="color: rgb(255,255,255);">Text</span></div>
                    </div>
                </a>
            </div>
            <div class="col-sm-4 d-flex justify-content-center align-items-center">
                <a data-fancybox="gallery" data-caption="Milo Stuff " href="img/events/three.jpg">
                    <div>
                        <img class="img-fluid" src="img/events/three.jpg" alt="fountain photo gallery" />
                        <div class="col w-100 h-25 p-3" style="background-color: rgba(114,198,123,0.74);margin-top: -57px;">
                            <span style="color: rgb(255,255,255);">Text</span></div>
                    </div>
                </a>
            </div>
            <div class="col-sm-4 d-flex justify-content-center align-items-center">
                <a data-fancybox="gallery" data-caption="Milo Stuff " href="img/events/six.jpg">
                    <div>
                        <img class="img-fluid" src="img/events/six.jpg" alt="fountain photo gallery" />
                        <div class="col w-100 h-25 p-3" style="background-color: rgba(114,198,123,0.74);margin-top: -57px;">
                            <span style="color: rgb(255,255,255);">Text</span></div>
                    </div>
                </a>
            </div>
        </div>
    </div>

</section>
</div>





@section('javascript')
    {{-- <script src="js/jquery-2.1.1.js"></script>
    <script src=" https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script> --}}
@stop


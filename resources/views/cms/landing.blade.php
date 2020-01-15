<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Fountain</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/helpers.css">
    <link rel="stylesheet" href="css/landing-2.css">
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/slick-theme.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/Team-Boxed.css">
    <link rel="stylesheet" href="css/Dark-footer.css">
    <link rel="stylesheet" href="css/Highlight-Phone.css">
    <link rel="shortcut icon" type="image/jpg" href="img/logo.jpg">
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,600,900" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="fonts/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="fonts/law-icons/font/flaticon.css">

    <link rel="stylesheet" href="fonts/fontawesome/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Crimson+Text:400,400i,600|Montserrat:200,300,400" rel="stylesheet">
</head>
<body data-spy="scroll" data-target="#pb-navbar" data-offset="200" class="bg-white">

<nav class="navbar navbar-expand-lg navbar-dark pb_navbar pb_scrolled-light" id="pb-navbar">
    <div class="container">
        <a class="navbar-brand" href="index.html"><img class="img-fluid" style="height: 70px" src="img/fountainlogo.png" alt="Fountain Int'l High school"></a>
        <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#probootstrap-navbar" aria-controls="probootstrap-navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span><i class="ion-navicon"></i></span>
        </button>
        <div class="collapse navbar-collapse" id="probootstrap-navbar">
            <ul class="navbar-nav ml-auto" >
                <li class="nav-item"><a  class="nav-link" href="#section-home">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#section-about">About Us</a></li>
                <li class="nav-item"><a class="nav-link" href="#section-news">News and Events</a></li>
                <li class="nav-item"><a class="nav-link" href="/gallery">Gallery</a></li>
                <li class="nav-item"><a class="nav-link" href="/teachers">Staff</a></li>
                <li class="nav-item"><a class="nav-link" href="#section-pricing">Facilities</a></li>

                {{--<li class="nav-item cta-btn ml-xl-2 ml-lg-2 ml-md-0 ml-sm-0 ml-0"><a class="nav-link" href="https://uicookies.com/" target="_blank"><span class="pb_rounded-4 px-4">Get Started</span></a></li>--}}
            </ul>
        </div>
    </div>
</nav>
<!-- END nav -->

<section class="pb_cover_v3  overflow-hidden cover-bg-indigo cover-bg-opacity text-left pb_gradient_v1 pb_slant-light">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-6">
                <h2 class="heading mb-3">FOUNTAIN</h2>
                <div class="sub-heading">
                    <p class="mb-4">Internation High School
                        -Ado Ekiti</p>
                    <p class="mb-5"><a class="btn btn-success btn-lg pb_btn-pill smoothscroll" href="#section-pricing"><span class="pb_font-14 text-uppercase pb_letter-spacing-1">Apply Now</span></a></p>
                </div>
            </div>
            <div class="col-md-1">
            </div>
            <div class="col-md-5 relative align-self-center">

                <form action="#" class="bg-white rounded pb_form_v1">
                    <h2 class="mb-4 mt-0 text-center">Contact Us </h2>
                    <div class="form-group">
                        <input type="text" class="form-control pb_height-50 reverse" placeholder="Full name">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control pb_height-50 reverse" placeholder="mobile number">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control pb_height-50 reverse" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for=""></label>
                        <textarea class="form-control pb_height-100 reverse" name="" placeholder="Message" id="" rows="3"></textarea>
                    </div>
                    <div class="form-group">

                        <button class="btn btn-primary btn-lg btn-block pb_btn-pill">submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</section>
<!-- END section -->

<section class="pb_section bg-light overflow-hidden pb_slant-white pb_pb-250" id="section-about">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-6 text-center mb-5">
                <h5 class="text-uppercase pb_font-15 mb-2 pb_color-dark-opacity-3 pb_letter-spacing-2"><strong>FOUNTAIN</strong></h5>
                <h2>About us</h2>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-md-6">
                <h3>Mission</h3>
                <p>
                    To create awareness for all stakeholders in education to identify a secondary school of high repute, that meets the sound academic empowerment of young people in this technological age of perversion.
                </p>

                <h3>Vision</h3>
                <p>
                    To become a world class Secondary School through the provision of quality education to
                    our students.
                </p>
                <p class="mb-5"><a class="btn btn-info  pb_btn-pill smoothscroll" href="/about"><span class="pb_font-14 text-uppercase pb_letter-spacing-1">
          Learn more &rarr;
          </span></a></p>

            </div>
            <div class="col-md-6">

                <div class="carousel slide" data-ride="carousel" id="carousel-1">
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active"><img class="w-100 d-block" src="img/music.jpg" alt="Music" /></div>
                        <div class="carousel-item"><img class="w-100 d-block" src="img/computer.jpg" alt="computer" /></div>
                        <div class="carousel-item"><img class="w-100 d-block" src="img/gallery/DSC02143.JPG" alt="science" /></div>
                        <div class="carousel-item"><img class="w-100 d-block" src="img/gallery/DSC00743.JPG" alt="science" /></div>
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
<!-- END section -->

<section class="pb_section pb_slant-light ">
    <div class="team-boxed">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center">
                    <h5 class="text-uppercase pb_font-15 mb-2 pb_color-dark-opacity-3 pb_letter-spacing-2"><strong>FOUNTAIN'S</strong></h5>
                    <h2 class="p-0"> Principal Officer </h2>
                </div>
            </div>
            <div class="row people justify-content-center">
                <div class="col-md-6 col-lg-4 item">
                    <div class="box"><img class="rounded-circle" src="img/principal.jpg" style="height: 150px;width: 150px" />
                        <h3 class="name">Mr B.I Apkono</h3>
                        <p class="title">Princpal</p>
                        <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu gravida. Aliquam varius finibus est, et interdum justo suscipit id. Etiam dictum feugiat tellus, a semper massa. </p>
                        <div class="social"><a href="#"><i class="fa fa-facebook-official"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-instagram"></i></a></div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 item">
                    <div class="box"><img class="rounded-circle" src="img/vpone.JPG" style="height: 150px;width: 150px" />
                        <h3 class="name">Mr B.I Apkono</h3>
                        <p class="title">Vice Principal One</p>
                        <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu gravida. Aliquam varius finibus est, et interdum justo suscipit id. Etiam dictum feugiat tellus, a semper massa. </p>
                        <div class="social"><a href="#"><i class="fa fa-facebook-official"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-instagram"></i></a></div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 item">
                    <div class="box"><img class="rounded-circle" src="img/vptwo.JPG" style="height: 150px;width: 150px" />
                        <h3 class="name">Mr Adeniyi Samuel</h3>
                        <p class="title">Vice Principal Two</p>
                        <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu gravida. Aliquam varius finibus est, et interdum justo suscipit id. Etiam dictum feugiat tellus, a semper massa. </p>
                        <div class="social"><a href="#"><i class="fa fa-facebook-official"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-instagram"></i></a></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
</section>
<!-- END section -->

<section class="pb_section bg-light pb_slant-white">
    <div class="team-boxed">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center">
                    <h5 class="text-uppercase pb_font-15 mb-2 pb_color-dark-opacity-3 pb_letter-spacing-2"><strong>FOUNTAIN'S</strong></h5>
                    <h2 class="p-0"> Head Of Departments  </h2>
                </div>
            </div>
            <div class="row people justify-content-center">
                <div class="col-md-6 col-lg-4 item">
                    <div class="box"><img class="rounded-circle" src="img/hodbc.jpg" style="height: 131px;" />
                        <h3 class="name">Mr Adeniyi Samuel</h3>
                        <p class="title">BUSINESS DEPARTMENT</p>
                        <p class="description">
                            The business department is made up of subjects which include:
                            Financial accounting, Commerce, Office Practice, Business studies, Economics and Insurance.
                            The objectives of the department are:
                            To produce students that will become professional accountants, business administrators, and business men.
                            To produce good leaders of tomorrow in the business world.
                        </p>
                        <div class="social"><a href="#"><i class="fa fa-facebook-official"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-instagram"></i></a></div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 item">
                    <div class="box"><img class="rounded-circle" src="img/hodh.JPG" />
                        <h3 class="name">Mr Ojo Samuel</h3>
                        <p class="title">HUMANITIES</p>
                        <p class="description">
                            The department is made up of subjects which includes Nigerian languages,
                            literature- in- English, government, geography, visual art, French, music etc.
                            The objective is to train student to study law, journalism, philosophy,
                            international relations, sociology and music and to build students
                            to become future leaders of their generation.
                        </p>
                        <div class="social"><a href="#"><i class="fa fa-facebook-official"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-instagram"></i></a></div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 item">
                    <div class="box"><img class="rounded-circle" src="img/hodsc.JPG" style="height: 132px;width: 138px;" />
                        <h3 class="name"> Mr Olarinde Rotimi</h3>
                        <p class="title">SCIENCE & TECHNOLOGY</p>
                        <p class="description">
                            The department is made up of subjects which includes Chemistry,
                            Physics, Biology, Basic science and technology, Agric science,
                            Computer/ICT etc. The objectives of the department are;
                            To produce students who are God fearing and hardworking.
                            To produce good ambassadors who will be useful to the society at large.
                            To breed good and responsible scientists
                        </p>
                        <div class="social"><a href="#"><i class="fa fa-facebook-official"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-instagram"></i></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END section -->
    <!-- mobile -->

    <!-- mobile -->

<section class="pb_section pb_slant-white" id="section-news">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-6 text-center mb-5">
                <h5 class="text-uppercase pb_font-15 mb-2 pb_color-dark-opacity-3 pb_letter-spacing-2"><strong>FOUNTAIN'S</strong></h5>
                <h2>News and Events</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md">
                <div id="pb_faq" class="pb_accordion" data-children=".item">
                    <div class="item">
                        <a data-toggle="collapse" data-parent="#pb_faq" href="#pb_faq1" aria-expanded="true" aria-controls="pb_faq1" class="pb_font-22 py-4">Admission in progress</a>
                        <div id="pb_faq1" class="collapse show" role="tabpanel">
                            <div class="py-3">
                                <p>Admission to Junior secondary school one two three and Senior Secondary school one and two is still in Progress .</p>
                                <p> Forms are obtainable here on our <a href= "/apply">Site</a> or in the school premises At omisanajana Area Ado-Ekiti </p>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md">
                <div id="pb_faq" class="pb_accordion" data-children=".item">
                    <div class="item">
                        <a data-toggle="collapse" data-parent="#pb_faq" href="#pb_faq1" aria-expanded="true" aria-controls="pb_faq1" class="pb_font-22 py-4">Admission in progress</a>
                        <div id="pb_faq1" class="collapse show" role="tabpanel">
                            <div class="py-3">
                                <p>Admission to Junior secondary school one two three and Senior Secondary school one and two is still in Progress .</p>
                                <p> Forms are obtainable here on our <a href= "/apply">Site</a> or in the school premises At omisanajana Area Ado-Ekiti </p>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>


        <p class="mb-5 mt-5"><a class="btn btn-info  pb_btn-pill smoothscroll" href="/news"><span class="pb_font-14 text-uppercase pb_letter-spacing-1">
          Learn more &rarr;
          </span></a></p>
    </div>
</section>
<section class="pb_section  overflow-hidden pb_slant-light">
    <div class="highlight-phone">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="intro">
                        <h2>Fountain&#39;s Mobile App</h2>
                        <p>Stay in sync with your child&#39;s performance . The app helps parents to improve their
                            involvement in their child&#39;s or children&#39;s education</p><a
                                class="btn btn-primary" role="button" href="#">Download</a>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="d-none d-md-block iphone-mockup"><img class="device" src="svg/iphone.svg" />
                        <div class="screen"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<footer class="pb_footer bg-light" role="contentinfo">
    <div class="container">
        <div class="row text-center">
            <div class="col">
                <img src="img/fountainlogo.png" style="height: 108px;" />
            </div>
        </div>
        <div class="row">
            <div class="col text-center">
                <p class="pb_font-14">&copy; 2019. All Rights Reserved. <br>  Fountain <a href="https://buzzdroid.bss.design/">Powered by Buzzdroid</a> </p>
            </div>
        </div>
    </div>
</footer>

<div id="pb_loader" class="show fullscreen">
    <svg class="circular" width="48px" height="48px">
        <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/>
        <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#33CC72"/>
    </svg></div>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/slick.min.js"></script>
<script src="js/jquery.mb.YTPlayer.min.js"></script>
<script src="js/jquery.waypoints.min.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/main.js"></script>
{{--<script src="{{ asset('js/app.js') }}"></script>--}}
</body>


</html>

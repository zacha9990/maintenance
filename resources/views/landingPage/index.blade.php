<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Welcome to e-maintenance</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('lp/css/bootstrap.min.css') }}">
    <!-- style css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('lp/css/style.css') }}">
    <!-- Responsive-->
    <link rel="stylesheet" href="{{ asset('lp/css/responsive.css') }}">
    <!-- fevicon -->
    <link rel="icon" href="{{ asset('lp/images/fevicon.png') }}" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="{{ asset('lp/css/jquery.mCustomScrollbar.min.css') }}">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <!-- owl stylesheets -->
    <link rel="stylesheet" href="{{ asset('lp/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lp/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css"
        media="screen">
</head>

<body>
    <!--header section start -->
    <div class="header_section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="logo"><a href="#"><img src="{{ asset('lp/images/logo.png') }}"></a></div>
                </div>
                <div class="col-md-9">
                    <div class="menu_text">
                        <ul>
                            <div id="myNav" class="overlay">
                                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                                <div class="overlay-content">
                                    <a href="#">Home</a>
                                    <a href="#">Informasi Terbaru</a>
                                    <a href="#">Visi & Misi</a>
                                    <a href="#">Galery</a>
                                    <a href="#">Contact Us</a>
                                </div>
                            </div>
                            <span class="navbar-toggler-icon"></span>
                            <span onclick="openNav()"><img src="{{ asset('lp/images/toogle-icon.png') }}"
                                    class="toggle_menu"></span>
                    </div>
                    </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- banner section start -->
        <div class="banner_section">
            <div class="container-fluid padding_0">
                <div id="my_slider" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="padding_left_0">
                                        <h4 class="retailer_text p-0">Selamat Datang</h4>
                                        <h4 class="retailer_text p-0"> e-maintenance</h4>
                                        <p class="search_text">Aplikasi Maintenance Peralatan Pabrik!</p>
                                        <div class="btn_main">
                                            <div class="more_bt"><a href="{{ route('dashboard.index') }}">Ajukan
                                                    Sekarang</a></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div><img src="{{ asset('lp/images/img-1.png') }}" class="image_1" width="90%">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="padding_left_0">
                                        <h4 class="retailer_text p-0">Selamat Datang</h4>
                                        <h4 class="retailer_text p-0"> e-persik.id</h4>
                                        <p class="search_text">Aplikasi Pengajuan Pembangunan Perumahan Anda Lebih Mudah
                                            Sekarang!</p>
                                        <div class="btn_main">
                                            <div class="more_bt"><a href="{{ route('dashboard.index') }}">Ajukan
                                                    Sekarang</a></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div><img src="{{ asset('lp/images/img-1.png') }}" class="image_1" width="90%">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="padding_left_0">
                                        <h4 class="retailer_text p-0">Selamat Datang</h4>
                                        <h4 class="retailer_text p-0"> e-persik.id</h4>
                                        <p class="search_text">Aplikasi Pengajuan Pembangunan Perumahan Anda Lebih
                                            Mudah Sekarang!</p>
                                        <div class="btn_main">
                                            <div class="more_bt"><a href="{{ route('dashboard.index') }}">Ajukan
                                                    Sekarang</a></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div><img src="{{ asset('lp/images/img-1.png') }}" class="image_1"
                                            width="90%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <a class="carousel-control-prev" href="#my_slider" role="button" data-slide="prev">
                        <i class="fa fa-left"><img src="{{ asset('lp/images/left-arrow.png') }}"></i>
                    </a> --}}
                    {{-- <a class="carousel-control-next" href="#my_slider" role="button" data-slide="next">
                        <i class="fa fa-right"><img src="{{ asset('lp/images/right-arrow.png') }}"></i>
                    </a> --}}
                </div>
            </div>
        </div>
        <!-- banner section end -->
    </div>
    <!-- header section end -->
    {{--
    <div class="advisor_section mt-5">
        <div class="container">
            <h1 class="what_text">Informasi Terbaru</h1>
        </div>
    </div>
    <div class="advisor_section_2 layout_padding">
        <div class="container">
            <div class="box_section">
                <div class="row">
                    <div class="col-lg-4 col-sm-12">
                        <div class="box_main">
                            <div class="image_3"></div>
                            <h4 class="consultative_text">Lorem Ipsum</h4>
                            <p class="readable_text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias
                                porro placeat tempora soluta nisi enim voluptate officia provident ipsam excepturi?</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <div class="box_main active">
                            <div class="image_4 active"></div>
                            <h4 class="consultative_text active">Lorem Ipsum</h4>
                            <p class="readable_text active">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Nobis aliquam deleniti atque explicabo doloremque totam suscipit molestias magni,
                                provident vero.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <div class="box_main">
                            <div class="image_5"></div>
                            <h4 class="consultative_text">Lorem Ipsum</h4>
                            <p class="readable_text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis
                                aliquam deleniti atque explicabo doloremque totam suscipit molestias magni, provident
                                vero.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- about section start --> --}}
    <div class="about_section layout_padding">
        <div class="container">
            <div class="row">
                <div class="col-sm-5">
                    <div><img src="{{ asset('lp/images/img-9.jpeg') }}" class="image_8 rounded"></div>
                </div>
                <div class="col-sm-7">
                    <h1 class="about_taital">Visi & Misi</h1>
                    "Terwujudnya kawasan permukiman dan
                    perumahan yang produktif, harmonis dan berkelanjutan.”<br><br>

                    Misi Dinas Perumahan Rakyat dan Kawasan Permukiman Kabupaten
                    Mukomuko yakni :<br>
                    1. Meningkatkan ketersediaan dan kualitas prasarana dan sarana
                    permukiman.<br>2. fasilitasi ketersediaan dan kualitas perumahan yang terjangkau.<br>
                    Meningkatkan kinerja penyelenggaraan pemerintahan berbasis
                    pemberdayaan, kemitraan dan kemandirian.<br>4. Meningkatkan ketersediaan tanah perkantoran,
                    perumahan rakyat dan
                    fasilitas umum lainnya.<br>5. Meningkatkan kinerja penyelenggaraan bidang pertanahan dalam tata
                    kelola pemerintahan yang baik.<br>6. Sistem database pemerintah daerah.</p>

                </div>
            </div>
        </div>
    </div>
    <!-- about section end -->
    <!-- portfolio section start -->
    <div class="portfolio_section layout_padding mb-5">
        <div class="container">
            <h1 class="what_text">Galery</h1>
        </div>
        <div class="container-fluid">
            <div class="images_section">
                <div class="row zoom-gallery">
                    <div class="col-sm-4 padding_0">
                        <div class="container_1">
                            <img src="{{ asset('lp/images/rumah/rumah1.jpeg') }}" alt="Avatar" class="image"
                                style="width:100%">
                            <div class="middle">
                                <div class="text"><img src="{{ asset('lp/images/search-icon.png') }}"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 padding_0">
                        <div class="container_1">
                            <img src="{{ asset('lp/images/rumah/rumah2.jpeg') }}" alt="Avatar" class="image"
                                style="width:100%">
                            <div class="middle">
                                <div class="text"><img src="{{ asset('lp/images/search-icon.png') }}"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 padding_0">
                        <div class="container_1">
                            <img src="{{ asset('lp/images/rumah/rumah3.jpeg') }}" alt="Avatar" class="image"
                                style="width:100%">
                            <div class="middle">
                                <div class="text"><img src="{{ asset('lp/images/search-icon.png') }}"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 padding_0">
                        <div class="container_1">
                            <img src="{{ asset('lp/images/rumah/rumah4.jpeg') }}" alt="Avatar" class="image"
                                style="width:100%">
                            <div class="middle">
                                <div class="text"><img src="{{ asset('lp/images/search-icon.png') }}"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 padding_0">
                        <div class="container_1">
                            <img src="{{ asset('lp/images/rumah/rumah5.jpeg') }}" alt="Avatar" class="image"
                                style="width:100%">
                            <div class="middle">
                                <div class="text"><img src="{{ asset('lp/images/search-icon.png') }}"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 padding_0">
                        <div class="container_1">
                            <img src="{{ asset('lp/images/rumah/rumah1.jpeg') }}" alt="Avatar" class="image"
                                style="width:100%">
                            <div class="middle">
                                <div class="text"><img src="{{ asset('lp/images/search-icon.png') }}"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <!-- portfolio section end -->

    <!-- footer section start -->
    <div class="footer_section layout_padding mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <h4 class="address_text">Alamat</h4>
                    <p class="simply_text">Jl imam bnjol komplek perkantoran, Bandar Ratu, Kec. Kota Mukomuko,
                        Kabupaten Mukomuko, Bengkulu 38719</p>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <h4 class="address_text">QUICK LINKS</h4>
                    <div class="footer_menu_main">
                        <div class="footer_menu">
                            <ul>
                                <li><a href="index.html.html">Home</a></li>
                                <li><a href="blog.html">Blog</a></li>
                                <li><a href="about.html">About</a></li>
                                <li><a href="services.html">Services</a></li>
                                <li><a href="contact.html">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="newsletter_section">
                        <div class="newsletter_left">
                            <h6 class="address_text">Follow Sosial Media</h6>
                        </div>
                        <div class="newsletter_right">
                            <div class="social_icon">
                                <ul>
                                    <li><a href="#"><img src="{{ asset('lp/images/fb-icon.png') }}"></a></li>
                                    <li><a href="#"><img src="{{ asset('lp/images/twitter-icon.png') }}"></a>
                                    </li>
                                    <li><a href="#"><img src="{{ asset('lp/images/instagram-icon.png') }}"></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- footer section end -->
    <!-- copyright section start -->
    <div class="copyright_section">
        <div class="copyright_text">Copyright 2023 All Right Reserved By <a href="e-persik.id">e-persik.id</a></div>
    </div>
    <!-- copyright section end -->

    <!-- Magnific Popup-->
    <script src="{{ asset('assets/libs/magnific-popup/jquery.magnific-popup.min.js') }}"></script>

    <!-- lightbox init js-->
    <script src="{{ asset('assets/js/pages/lightbox.init.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <!-- Javascript files-->
    <script src="{{ asset('lp/js/jquery.min.js') }}"></script>
    <script src="{{ asset('lp/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('lp/js/jquery-3.0.0.min.js') }}"></script>
    <script src="{{ asset('lp/js/plugin.js') }}"></script>
    <!-- sidebar -->
    <script src="{{ asset('lp/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script src="{{ asset('lp/js/custom.js') }}"></script>
    <!-- javascript -->
    <script src="{{ asset('lp/js/owl.carousel.js') }}"></script>
    <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".fancybox").fancybox({
                openEffect: "none",
                closeEffect: "none"
            });

            $(".zoom").hover(function() {

                $(this).addClass('transition');
            }, function() {

                $(this).removeClass('transition');
            });
        });
    </script>
    <script>
        function openNav() {
            document.getElementById("myNav").style.width = "100%";
        }

        function closeNav() {
            document.getElementById("myNav").style.width = "0%";
        }
    </script>
</body>

</html>

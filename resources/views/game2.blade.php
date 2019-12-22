
<!DOCTYPE html>
 <html lang="zxx">

    <head>

    	<!-- Metas -->
        <meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
		<meta name="keywords" content="HTML5 Template Coco onepage themeforest" />
		<meta name="description" content="Coco - Onepage Multi-Purpose HTML5 Template" />
		<meta name="author" content="" />

		<!-- Title  -->
		<title>CHƠI GAMGE NGAY NHẬN QUÀ LIỀN TAY</title>

		<!-- Favicon -->
		<link rel="shortcut icon" href="img/logo.png" />

		<!-- Google Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Prompt&display=swap" rel="stylesheet">

		<!-- Plugins -->
		<link rel="stylesheet" href="css/plugins.css" />

        <!-- Core Style Css -->
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
        <link rel="stylesheet" href="{{asset('css/util.css')}}">
        <link rel="stylesheet" href="{{asset('game/css/style.css')}}" />
        <link rel="stylesheet" href="{{asset('game/style.css')}}">
        <link rel="stylesheet" href="{{asset('game/csshake.min.css')}}">
        <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
        <!-- <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet"> -->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <!-- firework -->
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css"> -->
        <!-- END firework -->
    </head>

    <body>
        <div class="filter" style="width: 100%; height: 10000px; background-color: #0000007d; position: fixed; z-index: 100;"></div>

    	<!-- =====================================
    	==== Start Loading -->

    	<div class="loading">
    		<div class="text-center middle">
    			<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
    		</div>
    	</div>
        
    	<!-- End Loading ====
    	======================================= -->

       
    	<!-- =====================================
    	==== Start Navbar -->

		<nav class="navbar navbar-expand-lg">
			<div class="container">

            <!-- Logo -->
            <a class="logo" href="#">
                <img src="img/logo.png" alt="logo">          
            </a>

			  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			    <span class="icon-bar"><i class="fas fa-bars"></i></span>
			  </button>

			  <!-- navbar links -->
			  <div class="collapse navbar-collapse" id="navbarSupportedContent">
			    <ul class="navbar-nav ml-auto">
			      <li class="nav-item">
			        <a class="nav-link active" href="#" data-scroll-nav="0">TRANG CHỦ</a>
			      </li>
			      <li class="nav-item">
                    <a class="nav-link" href="#" data-scroll-nav="1">NOKIA 8800</a>
                  </li>
			      <li class="nav-item">
			        <a class="nav-link" href="#" data-scroll-nav="2">VERTU</a>
			      </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#" data-scroll-nav="3">ĐỒNG HỒ CAO CẤP</a>
                  </li>
			      <li class="nav-item">
			        <a class="nav-link" href="#" data-scroll-nav="4">ĐĂNG NHẬP</a>
			      </li>
			      
			      </li>
			    </ul>
			  </div>
			</div>
		</nav>

    	<!-- End Navbar ====
    	======================================= -->


    	<!-- =====================================
    	==== Start Header -->

    	<header class="header valign bg-img" data-scroll-index="0" data-overlay-dark="7" data-background="img/background.png" data-stellar-background-ratio="0.5">

            <!-- particles -->
            <div id="particles-js"></div>

    		<div class="container cuong1">
    			<div class="text-center caption mt-30">
                    <h4>CHƠI GAME NGAY</h4>
                    <h1 class="cd-headline clip">
                        <span class="blc">Nhận QUÀ LIỀN TAY</span>
                        <br>
                        <span class="cd-words-wrapper" style="color: #d8b402;">
                          <b class="is-visible">Iphone 11 trị giá 30.000.000đ</b>
                          <b>Bao da Handmade lên tới 3.500.000 đồng</b>
                          <b>Gói bảo hành 1 năm trị giá lên tới 2.000.000đ</b>
                          <b>Voucher 1.000.000 đồng</b>
                          <b>Spa miễn phí 1 năm trị giá tới 1.500.000đ</b>
                          <b>01 hộp phụ kiện cao cấp lên tới 5.000.000đ</b>
                          <b>Voucher 500.000 đồng</b>
                        </span>
                    </h1>
                    <div class="row">
                        <div class="offset-md-1 col-md-10 offset-lg-2 col-lg-8">
                            <p>We are a passionate digital design agency that specializes in beautiful and easy-to-use digital design & web development services.</p>
                        </div>
                    </div>
                    <a href="#0" class="butn butn-light mt-30 start">
                        <span data-scroll-nav="1">BẮT ĐẦU NGAY</span>
                    </a>
                </div>
    		</div>

            <div class="container2 cuong2" style="z-index: 2;">
                <div class="copy m-t-100">

                </div>
                <div class="wrapper">
                    <div class="pointer-wrapper">
                        <img src="{{asset('images/pointer.png')}}" style="width: 50px;" alt="pointer">
                    </div>
                    <img width="100%" src="{{asset('images/vong-quay.png')}}" alt="spping wheel" class="wheel">
                    <div class="button">
                        <button class="btn" id="{{Auth::user()->id}}" style="font-weight: 800;">QUAY</button>
                        <img class="qoobee-display-none" src="{{asset('images/qoobee.gif')}}" width="80px" alt="placeholder+image">
                    </div>
                </div>
            </div>

            <div class="curve curve-bottom curve-center"></div>
    	</header>

    	<!-- End Header ====
    	======================================= -->



        <!-- =====================================
        ==== Start Hero -->

        
        

        

        <!-- End Hero ====
        ======================================= -->


        <!-- =====================================
        ==== Start Footer -->

        <footer class="text-center pos-re">
            <div class="container">
                <!-- Logo -->
                <a class="logo" href="#">
                    <img src="img/logo.png" alt="logo">          
                </a>
                
                <div class="social">
                    <a href="#0"><i class="fab fa-facebook-f"></i></a>
                    <a href="#0"><i class="fab fa-twitter"></i></a>
                    <a href="#0"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#0"><i class="fab fa-behance"></i></a>
                    <a href="#0"><i class="fab fa-pinterest-p"></i></a>
                </div>

                <p>&copy; 2018 UI-ThemeZ. All Rights Reserved.</p>
            </div>

            <div class="curve curve-top curve-center"></div>
        </footer>

        <!-- End Footer ====
        ======================================= -->



        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
        <script src='https://cdn.rawgit.com/vast-engineering/jquery-popup-overlay/1.7.13/jquery.popupoverlay.js'></script>
        <script  src="{{asset('js/index.js')}}"></script>
       
        <!-- jQuery -->
        <!-- <script src="{{asset('game/js/jquery-3.0.0.min.js')}}"></script> -->
        <!-- <script src="{{asset('game/js/jquery-migrate-3.0.0.min.js')}}"></script> -->

        <!-- popper.min -->
        <script src="{{asset('game/js/popper.min.js')}}"></script>

        <!-- bootstrap -->
        <script src="{{asset('game/js/bootstrap.min.js')}}"></script>

        <!-- scrollIt -->
        <script src="{{asset('game/js/scrollIt.min.js')}}"></script>

        <!-- animated.headline -->
        <script src="{{asset('game/js/animated.headline.js')}}"></script>

        <!-- jquery.waypoints.min -->
        <script src="{{asset('game/js/jquery.waypoints.min.js')}}"></script>

        <!-- owl carousel -->
        <script src="{{asset('game/js/owl.carousel.min.js')}}"></script>

        <!-- jquery.magnific-popup js -->
        <script src="{{asset('game/js/jquery.magnific-popup.min.js')}}"></script>

        <!-- stellar js -->
        <script src="{{asset('game/js/jquery.stellar.min.js')}}"></script>

        <!-- isotope.pkgd.min js -->
        <script src="{{asset('game/js/isotope.pkgd.min.js')}}"></script>

        <!-- YouTubePopUp.jquery -->
        <script src="{{asset('game/js/YouTubePopUp.jquery.js')}}"></script>

        <!-- particles.min js -->
        <script src="{{asset('game/js/particles.min.js')}}"></script>

        <!-- app js -->
        <script src="{{asset('game/js/app.js')}}"></script>

        <!-- validator js -->
        <script src="{{asset('game/js/validator.js')}}"></script>

        <!-- custom scripts -->
        <script src="{{asset('game/js/scripts.js')}}"></script>

        <script  src="{{asset('game/script.js')}}"></script>

        <script type="text/javascript">
            $(document).ready(function(){
                $(".cuong2").hide();
            });
            $(document).on('click', '.start', function(event) {
                event.preventDefault();
                $(".cuong1").hide();
                $(".cuong2").show();
            });

        </script>

        
    </body>
</html>
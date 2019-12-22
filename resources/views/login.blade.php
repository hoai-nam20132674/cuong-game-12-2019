<!DOCTYPE html>
<html lang="vi-VN">
<head>
<title>VUI GIÁNG SINH - RINH QUÀ TẶNG</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta property="og:title" content="VUI GIÁNG SINH - RINH QUÀ KHỦNG"/>
<meta property="og:image" content="http://103.47.192.211/images/banner.png"/>
<meta property="og:url" content="http://103.47.192.211/login"/>
<meta property="og:description" content="Rất nhiều quà tặng hấp dẫn dành cho quý khách khi tới mua điện thoại Vertu, Nokia 8800 tại showroom"/>
<meta property="og:locale" content="vi_VN" />
<meta property="og:type" content="website" />


<meta property="og:site_name" content="VUI GIÁNG SINH - RINH QUÀ KHỦNG"/>
<meta name="twitter:title" content="VUI GIÁNG SINH - RINH QUÀ KHỦNG" />
<meta name="twitter:image" content="http://103.47.192.211/images/banner.png" />
<meta name="twitter:url" content="http://103.47.192.211/login" />
<link rel="canonical" href="http://103.47.192.211/login" />


<!--===============================================================================================-->  
  <link rel="icon" type="image/png" href="{{asset('images/shortcut-icon.png')}}"/>
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{asset('vendors/bootstrap/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{asset('fonts/Linearicons-Free-v1.0.0/icon-font.min.css')}}">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{asset('vendors/animate/animate.css')}}">
<!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="{{asset('vendors/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{asset('vendors/animsition/css/animsition.min.css')}}">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2.min.css')}}">
<!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="{{asset('vendors/daterangepicker/daterangepicker.css')}}">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{asset('css/util.css')}}">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">
<!--===============================================================================================-->
</head>
<body>
  
  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100 p-l-50 p-r-50 p-t-62 p-b-33">
        <form action="/postLogin" method="POST" class="login100-form validate-form flex-sb flex-w">
          <input type="hidden" name="_token" value="{{ csrf_token()}}">
          <span class="login100-form-title p-b-30">
            ĐĂNG NHẬP
          </span>

          <!-- <a href="#" class="btn-face m-b-20">
            <i class="fa fa-facebook-official"></i>
            Facebook
          </a>

          <a href="#" class="btn-google m-b-20">
            <img src="images/icons/icon-google.png" alt="GOOGLE">
            Google
          </a> -->
          @if( count($errors) > 0)
            <div class="alert alert-danger">
              <ul>
                @foreach($errors->all() as $error)
                  <li>{{$error}}</li>
                @endforeach
              </ul>
            </div>
          @endif
          @if( Session::has('flash_message'))
              <div style="background:red; color: #fff; font-size: 20px;" class="alert alert-{{ Session::get('flash_level')}}">
                  {{ Session::get('flash_message')}}
              </div>
          @endif
          <div class="p-t-31 p-b-9">
            <span class="txt1">
              SỐ ĐIỆN THOẠI
            </span>
          </div>
          <!-- <div class="wrap-input100 validate-input" data-validate = "Username is required">
            <input class="input100" type="text" name="username" >
            <span class="focus-input100"></span>
          </div> -->
          
          <!-- <div class="p-t-13 p-b-9">
            <span class="txt1">
              Password
            </span>

            <a href="#" class="txt2 bo1 m-l-5">
              Forgot?
            </a>
          </div> -->
          <div class="wrap-input100 validate-input" data-validate = "Password is required">
            <input class="input100" type="text" name="password" placeholder="Vui lòng nhập số điện thoại" >
            <span class="focus-input100"></span>
          </div>

          <div class="container-login100-form-btn m-t-17">
            <button class="login100-form-btn">
              Sign In
            </button>
          </div>

          <div class="w-full text-center p-t-55">
            <span class="txt2">
              Not a member?
            </span>

            <a href="#" class="txt2 bo1">
              Sign up now
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
  

  <div id="dropDownSelect1"></div>
  
<!--===============================================================================================-->
  <script src="{{asset('vendors/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
  <script src="{{asset('vendors/animsition/js/animsition.min.js')}}"></script>
<!--===============================================================================================-->
  <script src="{{asset('vendors/bootstrap/js/popper.js')}}"></script>
  <script src="{{asset('vendors/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
  <script src="{{asset('vendors/select2/select2.min.js')}}"></script>
<!--===============================================================================================-->
  <script src="{{asset('vendors/daterangepicker/moment.min.js')}}"></script>
  <script src="{{asset('vendors/daterangepicker/daterangepicker.js')}}"></script>
<!--===============================================================================================-->
  <script src="{{asset('vendors/countdowntime/countdowntime.js')}}"></script>
<!--===============================================================================================-->
  <script src="{{asset('js/main.js')}}"></script>
  <script type="text/javascript">
    $("div.alert").delay(3000).slideUp();
  </script>

</body>
</html>
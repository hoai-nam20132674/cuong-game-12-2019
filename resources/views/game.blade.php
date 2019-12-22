<!DOCTYPE html>
<html lang="en" >

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VUI GIÁNG SINH - RINH QUÀ TẶNG</title>
    <link rel="shortcut icon" type="image/png" href="{{asset('images/shortcut-icon.png')}}" />
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/util.css')}}">

  
</head>

<body>

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">

<div class="container">
  
<div class="copy m-t-100">

</div>
<div class="wrapper">
    <div class="pointer-wrapper">
        <img src="{{asset('images/pointer.png')}}" width="50px" alt="pointer">
    </div>
    <img width="100%" src="{{asset('images/vong-quay.png')}}" alt="spping wheel" class="wheel">
    <div class="button">
        <button class="btn" id="{{Auth::user()->id}}">QUAY</button>
        <img class="qoobee-display-none" src="{{asset('images/qoobee.gif')}}" width="80px" alt="placeholder+image">
    </div>
</div>

</div>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
<script src='https://cdn.rawgit.com/vast-engineering/jquery-popup-overlay/1.7.13/jquery.popupoverlay.js'></script>
<script  src="{{asset('js/index.js')}}"></script>

</body>

</html>

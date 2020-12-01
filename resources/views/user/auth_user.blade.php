<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Best Fleet Management System Around">
    <meta name="author" content="Rytegate Technologies">
    <meta name="msapplication-TileColor" content="#9f00a7">
    <meta name="msapplication-TileImage" content="{{URL::asset('assets/img/favicon/mstile-144x144.png')}}">
    <meta name="msapplication-config" content="{{URL::asset('assets/img/favicon/browserconfig.xml')}}">
    <meta name="theme-color" content="#ffffff">
    <link rel="manifest" href="{{URL::asset('assets/img/favicon/manifest.json')}}">
    <link rel="shortcut icon" href="{{URL::asset('assets/img/dr.png')}}">
    <title>Dream360- Fleet Management System</title>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>  
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>  <![endif]-->
    <link href="{{URL::asset('assets/css/vendors.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/css/styles.min.css')}}" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script charset="utf-8" src="//maps.google.com/maps/api/js?sensor=true"></script>


    <style type="text/css"> 
        
    </style>
  </head>
  
  <body class="page-login" init-ripples="">

<form class="form-horizontal" method="post" action="{{ url('/user/post_sign_up') }}">
      <div class="card bordered z-depth-2" style="margin:10% auto 0% auto; max-width:400px;">
        <div class="card-header">
          <div class="brand-logo">
            
            
              <center> <img src="{{URL::asset('assets/img/dreamlogo.png')}}" class="img-responsive" style ="height:50%; width:35%"> </center>

           
        </div>
        </div>
        <div class="card-content" style="padding:10px 25px">
          <div class="m-b-30">
            <div class="card-title strong pink-text" style="margin-left:-15px">Login</div>
            <p class="card-title-desc">  </p>
          </div>
          <form class="form-floating">
            <div class="form-group">
              
              <input type="email" class="form-control" name="email" id="email" placeholder="Email" required> </div>
            <div class="form-group">

              <input type="password" class="form-control" name="password" id="password" placeholder="Password" required> </div>
              <input type="hidden" name="_token" value="{{{ csrf_token() }}}">	
            <div class="form-group">
              <div class="checkbox">
                <label style="">
                  <input type="checkbox" name="remember"> Remember me </label>
              </div>
            </div>
          </form>
        </div>
        <div class="card-action clearfix">
          <div class="pull-right">
            <button type="button" class="btn btn-link black-text" style="font-size:9px; margin-right:10px">Forgot password</button>
		
            <button type="submit" class="btn btn-success" style="font-size:9px">Login</button>
          </div>
        </div>
      </Form>
    
	

    <script charset="utf-8" src="{{URL::asset('assets/js/vendors.min.js')}}"></script>
    <script charset="utf-8" src="{{URL::asset('assets/js/app.min.js')}}"></script>
  </body>

  </html>
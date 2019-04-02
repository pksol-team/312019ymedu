<?php use Illuminate\Support\Facades\DB; ?>
<?php use storage\framework\sessions; ?>
<!DOCTYPE html>
<html>

<head>
    <!-- set the encoding of your site -->
    <meta charset="utf-8">
    <link rel="icon" href="/frontend/images/5121.png">
    <!-- set the viewport width and initial-scale on mobile devices -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- set the HandheldFriendly -->
    <meta name="HandheldFriendly" content="True">
    <!-- set the description -->
    <!--<meta name="description" content="Ethical Hacking Course In Tamil">-->
    <!-- set the Keyword -->
    <meta name="keywords" content="Ethical Hacking Course In Tamil,tamil hacking course,tamil course">
    <meta name="author" content="Ashwin Pk">
    
    <!--<meta property="og:type" content="website" />-->
    <meta property="og:image" content="@yield('image')">
    
    <!--<meta property="og:title" content="@yield('title_des')">-->
    <!--<meta property="og:description" content="@yield('description')">-->
    <!--<meta property="og:url" content="@yield('url')">-->
    
    
    
    <!-- set the page title -->
    <title>@yield('title')</title>
    <!-- include google roboto font cdn link -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700,700i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <!-- include the site bootstrap stylesheet -->
    <link rel="stylesheet" href="/frontend/css/bootstrap.css">
    <!-- include the site stylesheet -->
    <link rel="stylesheet" href="/frontend/css/plugins.css">
    <!-- include the site stylesheet -->
    <link rel="stylesheet" href="/frontend/css/colors.css">
    <!-- include the site stylesheet -->
    <link rel="stylesheet" href="/frontend/css/style.css?<?php echo date('l jS \of F Y h:i:s A'); ?>">
    <!-- include the site responsive stylesheet -->
    <link rel="stylesheet" href="/frontend/css/responsive.css">
    <link href="/frontend/plugins/lity-2.3.1/dist/lity.css" rel="stylesheet">

    <link rel="stylesheet" href="/frontend/js/read-more.js">

    <!-- include SummerNote Editor CSS -->
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
        <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-127096773-1"></script>
<!-- include jQuery -->
<script src="/frontend/js/jquery.js"></script>


<link rel="stylesheet" href="/frontend/css/style_course_video.css">
<script src="/frontend/js/javascript_course_video.js"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-127096773-1');
</script>
</head>
<style>
#more {display: none;}
</style>
<body>
  <?php if (Auth::check()){
    $buyNow = 'https://imjo.in/MKwG5u';
  }else {
    $buyNow = '/frontend/login';
  }

  $user = Auth::user();
  ?>


    <!-- main container of all the page elements -->
    <div id="wrapper">
        <!-- header of the page -->
        <header id="page-header">
            <!-- top bar -->
            <div class="top-bar bg-dark text-gray">
                <div class="container">
                    <div class="row top-bar-holder">
                        <div class="col-xs-9 col">
                            <!-- bar links -->
                            <ul class="font-lato list-unstyled bar-links">
                                <li>
                                    <a href="tel:+91 9884014753">
                                        <strong class="dt element-block text-capitalize hd-phone">Call :</strong>
                                        <strong class="dd element-block hd-phone">+(91) 9884014753</strong>
                                        <i class="fas fa-phone-square hd-up-phone hidden-sm hidden-md hidden-lg"><span class="sr-only">phone</span></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="mailto:pkjournalintime@gmail.com">
                                        <strong class="dt element-block text-capitalize hd-phone">Email :</strong>
                                        <strong class="dd element-block hd-phone">pkjournalintime@gmail.com</strong>
                                        <i class="fas fa-envelope-square hd-up-phone hidden-sm hidden-md hidden-lg"><span class="sr-only">email</span></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-xs-3 col justify-end">
                            <!-- user links -->
                        <div style="text-align: center;">
                        <?php if (Auth::check() != true): ?>
                          <a href="/frontend/register" > <button class="buttonbuy1" style="vertical-align:middle"><span>Register </span></button></a>
                        <?php endif ?>
                        </div> </br>
                        <div style="text-align: center;">
                          <?php if (Auth::check()): ?>
                          <a href="/frontend/profile"> <button class="buttonbuy1" style="vertical-align:middle"><span><?php echo $user->name; ?> </span></button></a>
                        </div> </br>
                        <div style="text-align: center;">
                          <a href="/frontend/logout" onclick="return confirm('Are you sure want to Logout?')" > <button class="buttonbuy1" style="vertical-align:middle"><span>Logout </span></button></a>
                          <?php else: ?>
                            <a href="/frontend/login" > <button class="buttonbuy1" style="vertical-align:middle"><span>Login </span></button></a>
                          <?php endif ?>
                        </div> </br>
                        <!-- <div style="text-align: center;">
                        <a href="<?= $buyNow ?>" >  <button class="buttonbuy1" style="vertical-align:middle"><span>Buy Now </span></button></a></div> -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- header holder -->
            <div class="header-holder">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-6 col-sm-3">
                            <!-- logo -->
                            <div class="logo">
                                <a href="/">
                                    <img src="/frontend/images/8.png" alt="studylms">
                                </a>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-9 static-block">
                            <!-- nav -->
                            <nav id="nav" class="navbar navbar-default">
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                </div>
                                <!-- navbar collapse -->
                                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                    <!-- main navigation -->
                                    <ul class="nav navbar-nav navbar-right main-navigation text-uppercase font-lato">
                                        <li class="dropdown">
                                            <a href="/" class="dropdown-toggle">home</a>
                                        
                                        </li>
                                        <!-- <li class="dropdown">
                                            <a href="<?= $buyNow ?>" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Buy Now</a>
                                    
                                        </li> -->
                                        
                                        <li><a href="tel:+919884014753">coNTACT</a></li>
                                    </ul>
                                </div>
                            
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- contain main informative part of the site -->
    	@yield('content')
           <!-- footer area container -->
           <div class="footer-area bg-dark text-gray">
              <!-- aside -->
              <aside class="aside container">
                 <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-3 col">
                       <div class="logo"><a href="/frontend/home.html"><img src="/frontend/images/8.png" alt="Ashwin"></a></div>
                       <p>We have over 20 years experience providing expert Educational both businesses and individuals. Our Investment Committee brings cades the industry expertise in driving our investment approach. portfolio constructor and allocation</p>
                       <a href="https://frankeey.com/" class="btn btn-default text-uppercase">Start Leaning Now</a>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3 col hidden-xs">
                       <h3>Popular Courses</h3>
                       <!-- widget cources list -->
                       <ul class="widget-cources-list list-unstyled">
                          <li>
                             <a href="#">
                                <div class="alignleft">
                                   <img src="https://udemy-images.udemy.com/course/240x135/857010_8239_2.jpg" alt="image description">
                                </div>
                                <div class="description-wrap">
                                   <h4>Ethical Hacking In Tamil</h4>
                                   <strong class="price text-primary element-block font-lato text-uppercase">Rs.2000 /-</strong>
                                </div>
                             </a>
                          </li>
                       </ul>
                    </div>
                    <nav class="col-xs-12 col-sm-6 col-md-3 col">
                       <h3>Rules</h3>
                       <!-- fooer navigation -->
                       <ul class="fooer-navigation list-unstyled">
                          <li><a href="#">Don't Use It In illegal Way</a></li>
                          <li><a href="#">This Course Is Only To Defend Yourself From Hackers</a></li>
                          <li><a href="#">We Are Not Responsible If Any Damage Caused By You</a></li>
                          <li><a href="#">Call Us: 9884014753</a></li>
                       </ul>
                    </nav>
                    <div class="col-xs-12 col-sm-6 col-md-3 col">
                       <h3>contact us</h3>
                       <p>If you want to contact us about any issue our support available to help you 10am-11pm Everyday.</p>
                       <!-- ft address -->
                       <address class="ft-address">
                          <dl>
                             <dt><span class="fas fa-phone-square"><span class="sr-only">phone</span></span></dt>
                             <dd>Call: <a href="tel:+919884014753">+ 91 9884014753</a></dd>
                             <dt><span class="fas fa-envelope-square"><span class="sr-only">email</span></span></dt>
                             <dd>Email: <a href="mailto:pkjournalintime4@gmail.com">pkjournalintime4@gmail.com</a></dd>
                          </dl>
                       </address>
                    </div>
                 </div>
              </aside>
              <!-- page footer -->
              <footer id="page-footer" class="font-lato">
                 <div class="container">
                    <div class="row holder">
                       <div class="col-xs-12 col-sm-push-6 col-sm-6">
                          <ul class="socail-networks list-unstyled">
                             <li><a href="#"><span class="fab fa-facebook"></span></a></li>
                             <li><a href="#"><span class="fab fa-twitter"></span></a></li>
                             <li><a href="#"><span class="fab fa-instagram"></span></a></li>
                             <li><a href="#"><span class="fab fa-linkedin"></span></a></li>
                          </ul>
                       </div>
                       <div class="col-xs-12 col-sm-pull-6 col-sm-6">
                          <p><a href="#">Ashwin</a> | &copy; 2018 <a href="#"></a>, All rights reserved</p>
                       </div>
                    </div>
                 </div>
              </footer>
           </div>
           <!-- back top of the page -->
        </div>
        </div>
        <div class="popup-holder">
           <div id="popup1" class="lightbox-demo">
              <form action="#" class="user-log-form">
                 <h2>Login Form</h2>
                 <div class="form-group">
                    <input type="text" class="form-control element-block" placeholder="Username or email address *">
                 </div>
                 <div class="form-group">
                    <input type="password" class="form-control element-block" placeholder="Password *">
                 </div>
                 <div class="btns-wrap">
                    <div class="wrap">
                       <label for="rem" class="custom-check-wrap fw-normal font-lato">
                       <input type="checkbox" id="rem" class="customFormReset">
                       <span class="fake-label element-block">Remember me</span>
                       </label>
                       <button type="submit" class="btn btn-theme btn-warning fw-bold font-lato text-uppercase">Login</button>
                    </div>
                    <div class="wrap text-right">
                       <p>
                          <a href="#" class="forget-link">Lost your Password?</a>
                       </p>
                    </div>
                 </div>
              </form>
           </div>
           <div id="popup2" class="lightbox-demo">
              <form action="#" class="user-log-form">
                 <h2>Register Form</h2>
                 <div class="form-group">
                    <input type="email" class="form-control element-block" placeholder="Email address *">
                 </div>
                 <div class="form-group">
                    <input type="password" class="form-control element-block" placeholder="Password *">
                 </div>
                 <div class="btns-wrap">
                    <div class="wrap">
                       <button type="submit" class="btn btn-theme btn-warning fw-bold font-lato text-uppercase">Register</button>
                    </div>
                 </div>
              </form>
           </div>
        </div>
        <!-- include jQuery -->
        <!-- <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script> -->
        <script src="/frontend/js/plugins.js"></script>
        <!-- include jQuery -->
        <script src="/frontend/js/jquery.main.js"></script>
        <!-- include jQuery -->
        <script type="text/javascript" src="/frontend/js/init.js"></script>
        <script type="text/javascript" src="/frontend/plugins/lity-2.3.1/dist/lity.js"></script>

        
        <!-- include SummerNote Editor JS -->

        </body>
        </html>

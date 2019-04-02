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
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
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
                       <!--  <div class="col-xs-2 col">
                          </div> -->
                        <div class="col-xs-8 col">
                          <div class="logo">
                                <a href="/">
                                  <!-- <span>FRANKEEY</span> -->
                                    <img src="/frontend/images/logo.png" alt="studylms">
                                </a>
                            </div>

                            <section class="widget widget_search">
                              <!--  <h3>Course Search</h3> -->
                              <!-- search form -->
                              <form action="/search/" method="get" class="search-form" id="searchForm">
                                 <fieldset>
                                  <button id="searchSubmit" type="submit" class="fas fa-search"><span class="sr-only">Search For Courses</span></button>
                                    <input id="searchInput" placeholder=" Search For Courses" class="form-control" name="s" type="search">
                                    
                                 </fieldset>
                              </form>
                           </section>
                            
                        </div>
                        <div class="col-xs-4 col justify-end">
                            <!-- user links -->
                        <div style="text-align: center;" class="buttonbuy12">
                          <?php if (Auth::check()): ?>
                          <a href="/frontend/profile" class="buttonbuy1"><span><?php echo $user->name; ?> </span></a>
                        </div> </br>
                        <div style="text-align: center;">
                          <a href="/frontend/logout" onclick="return confirm('Are you sure want to Logout?')"> <button class="buttonbuy1" class="buttonbuy1"><span>LOGOUT </span></a>
                          <?php else: ?>
                            <a href="/frontend/login" class="buttonbuy1"><span>LOGIN </span></a>
                          <?php endif ?>
                        </div> </br>
                        <div style="text-align: center;"  class="buttonbuy13">
                        <?php if (Auth::check() != true): ?>
                          <a href="/frontend/register" class="buttonbuy1"><span>REGISTER </span></a>
                        <?php endif ?>
                        </div>
                        <!-- <div style="text-align: center;">
                        <a href="<?= $buyNow ?>" >  <button class="buttonbuy1" style="vertical-align:middle"><span>Buy Now </span></button></a></div> -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- header holder -->
            
        </header>
        <!-- contain main informative part of the site -->
    	@yield('content')
           <!-- footer area container -->
           
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

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
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
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
    <link href="https://fonts.googleapis.com/css?family=Quicksand:700" rel="stylesheet">
    <!-- include SummerNote Editor CSS -->
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
        <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-127096773-1"></script>
<!-- include jQuery -->
<script src="/frontend/js/jquery.js"></script>
<!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '366014760667756');
  fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=366014760667756&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->
<script>
  fbq('track', 'ViewContent', {
    value: 1,
    currency: 'INR',
  });
</script>

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

.ashwin {
    background-color: orange;
    padding: 20px;
    align-items: center;
    align-content: center;
    text-align: center;
    color: #0060B6;
    text-decoration: none;
    font-family: 'Quicksand', sans-serif;
    margin-top: 90px;
}

a {
    color: black;
    text-decoration: none;
    font-family: 'Quicksand', sans-serif;
}

h1 {
    font-family: 'Quicksand', sans-serif;
}

a:hover 
{
     color:#ff4300; 
     text-decoration:none; 
     cursor:pointer;  
}

.bbb {
    
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)
    
}

.shadowss {
    
    box-shadow: 11px 7px 73px -16px rgba(0,0,0,0.42);
    border-radius: 25px;
    
}

#shadowss {
    
    box-shadow: 11px 7px 73px -16px rgba(0,0,0,0.42);
    border-radius: 25px;
    
}

#timer {
 color: #ffffff;   
}

#footer-text {
   position:absolute;
   bottom:0;
   width:100%;
   height:60px;
   font-family: 'Quicksand', sans-serif;
}

</style>
<body>
  <?php if (Auth::check()){
    $buyNow = 'https://imjo.in/MKwG5u';
  }else {
    $buyNow = '/frontend/login_student';
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
                                    <img src="/frontend/images/logo (1).png" alt="studylms">
                                </a>
                            </div>

                            <section class="widget widget_search">
                              <!--  <h3>Course Search</h3> -->
                              <!-- search form -->
                              <form action="/search/" method="get" class="search-form" id="searchForm">
                                 <fieldset>
                                     
                                  <button id="searchSubmit" class="fas fa-search" disabled='true'><span class="sr-only">Search For Courses</span></button>
                                    <input id="searchInput" placeholder=" Search For Courses" class="form-control" name="s" type="search">
                                        <div class = "search_li">
                                        <ul id="display"></ul>
                                        </div>
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
                          <a href="/frontend/logout" onclick="return confirm('Are you sure want to Logout?')" class="buttonbuy1" class="buttonbuy1"><span>Logout</span></a>
                          <?php else: ?>
                            <a href="/frontend/login_student" class="buttonbuy1"><span>LOGIN </span></a>
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
        
        <div class="ashwin">
<a>Android App Development, Web Designing Courses For Just Rs.999/- Only Till <div id="timer"></div></a>
</div>
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
        <!--Start of Tawk.to Script-->
        <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/59f5bf214854b82732ff8984/default';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
        })();
        </script>
        <!--End of Tawk.to Script-->
        <script>
        // Set the date we're counting down to
        var countDownDate = new Date("Mar 31, 2019 23:00:00").getTime();
        
        // Update the count down every 1 second
        var x = setInterval(function() {
        
          // Get todays date and time
          var now = new Date().getTime();
            
          // Find the distance between now and the count down date
          var distance = countDownDate - now;
            
          // Time calculations for days, hours, minutes and seconds
          var days = Math.floor(distance / (1000 * 60 * 60 * 24));
          var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
          var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
          var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            
          // Output the result in an element with id="demo"
          document.getElementById("timer").innerHTML = days + "d " + hours + "h "
          + minutes + "m " + seconds + "s ";
            
          // If the count down is over, write some text 
          if (distance < 0) {
            clearInterval(x);
            document.getElementById("timer").innerHTML = "EXPIRED";
          }
        }, 1000);
        
        
        $(document).ready(function() {
           //On pressing a key on "Search box" in "search.php" file. This function will be called.
           $("#searchInput").keyup(function() {
               //Assigning search box value to javascript variable named as "name".
               var name = $('#searchInput').val();
              console.log(name);
               if (name == "") {
                   //Assigning empty value to "display" div in "search.php" file.
                   $("#display").html("");
               }
                else {
                    //AJAX is called.
                   $.ajax({
                       //AJAX type is "Post".
                       type: "POST",
                       //Data will be sent to "ajax.php".
                       url: "/searchcourse",
                       //Data, that will be sent to "ajax.php".
                       data: {
                           //Assigning value of "name" into "search" variable.
                           search: name,
                           _token: "{{ csrf_token() }}",
                       },
                       //If result found, this funtion will be called.
                       success: function(html) {
                           //Assigning result to "display" div in "search.php" file.
                           $('.search_li').show();
                          $("#display").html(html).show();
                        
                        // console.log($("#display"));
                       }
                   });
               }
           });
        });
        
        $("#searchInput").focusout(function(){
            $('.search_li').hide();
            console.log("click");
        });
      
      
        </script>
        
        <!-- include SummerNote Editor JS -->

        </body>
        </html>

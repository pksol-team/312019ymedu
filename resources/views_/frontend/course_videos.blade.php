<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    
     <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
     <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/frontend/css/style_course_video.css">
<script src="/frontend/js/javascript_course_video.js"></script>
     <!------ Include the above in your HEAD tag ---------->

   
    <!------ Include the above in your HEAD tag ---------->

   <style>
     body{
      background-color: black;
     }
   </style>

    </head>
    
<body>
    <div id="wrapper">
        <div class="overlay_2"></div>
    
        <!-- Sidebar -->
        <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
              
            <ul class="nav sidebar-nav" id="datatable">
                 <li class="head">
                     <h2>Course Content</h2>
                 </li>
                <li class="sidebar-brand">
                    {{-- <input id="searchInput" type="search" placeholder="Search" onkeyup="searchFunction()" /> --}}
                    <input id="searchInput" type="text" placeholder="Search Course Content" name="search" onkeyup="searchFunction()">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </li>

              @php
              $index = 1;
                $VideosData = trim($singleCourse->videos, '[]');
              
                if ($VideosData != '') {
                   if (strlen($VideosData) < 7) {
                       $explodedData = explode('""', $VideosData);                         
                    }else {
                       $explodedData = explode(',', $VideosData);
                    }

                   
                foreach ($explodedData as $SingleRowVD){                    
                  $getData = DB::table('videos')->WHERE('id', trim($SingleRowVD, '""'))->first();
                   $VideoTitle =  $getData->title;
                   $VideoDescription =  $getData->description;
                   $VideoVimeo = $getData->vimeo_link;
                   $VideoFile =  $getData->file;
                   $VideoType =  $getData->video_option;
                      
                   if($VideoType == 'vimeo'){
                       
                    $file = 'https://player.vimeo.com/video/'.$VideoVimeo.'?autoplay=1&loop=1';
                  }
                  else {
                  
                    $get_Video = DB::table('uploads')->WHERE('id', trim($VideoFile, '""'))->first(); 
                    $file = '/files/'.$get_Video->hash.'/'.$get_Video->name.''; 

                  }
                  $title = $index.". ".$VideoTitle." - Now Playing";
                   @endphp 

                <li>
                    <span class="sec">Section: {{ $index }}</span>
                    <a href="{{ $file }}" class="play_video caption_class" data-type="{{ $VideoType }}" data-href="{{ $file }}"data-title="{{ $title }}"><h3>{{ $VideoTitle }}</h3></a>
                    
                </li>
                 @php

                        $index++;
                  }
                  
                  }
                @endphp
            </ul>
        </nav>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <button type="button" class="hamburger is-closed" data-toggle="offcanvas">
                <i class="fa fa-list-ul" aria-hidden="true"></i>
            </button>
                    <div class="video purchased">
                        <div class="widget_intro-1">
                        </div><!-- /.course -->
                    </div>
                
          
        </div>
        <!-- /#page-content-wrapper -->

    </div>


<script>
  jQuery(document).ready(function($) { 
    $('a.play_video').on('click', function(e) {
      e.preventDefault();
      $('.caption_class').removeClass('active');
      $(this).addClass('active');
      // Uploaded Video
      var href_upload = $(this).attr('data-href');
      var video_type = $(this).attr('data-type');
      var video_title = $(this).attr('data-title');
      if(video_type == 'vimeo'){
        var video = '<iframe style="width: 100%; height: 99vh;" src="" frameborder="0" allowfullscreen="true" webkitallowfullscreen="true" mozallowfullscreen="true"  allow=autoplay class="play_video"></iframe>'
      }
      else{
        var video = '<video controls><source class="play_video" src="" type=""></video>';
      }
      

      // $('h2').html(video_title);
      $('.widget_intro-1').html(video);
      $('.play_video').attr('src', href_upload);
      $('video').attr('autoplay','1');


    });

    console.log($('ul li:nth-child(3) a'));
    $('ul li:nth-child(3) a').trigger('click');

  });
</script>
    <script>
  function searchFunction() {
      var input, filter, ul, li, a, i, txtValue;
      input = document.getElementById("searchInput");
      filter = input.value.toUpperCase();
      ul = document.getElementById("datatable");
      li = ul.getElementsByTagName("li");
      for (i = 2; i < li.length; i++) {
          a = li[i].getElementsByTagName("a")[0];
          txtValue = a.textContent || a.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
              li[i].style.display = "";
          } else {
              li[i].style.display = "none";
          }
      }
  }
</script>
  </body>
  </html>







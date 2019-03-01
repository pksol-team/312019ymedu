@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')

<?php use App\Http\Controllers\Frontend\IndexController; ?>
<?php use Illuminate\Support\Collection; ?>

<main id="main">
   <!-- breadcrumb nav -->
   <nav class="breadcrumb-nav">
      <div class="container">
         <!-- breadcrumb -->
         <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li>Course</li>
            <li class="active">Videos</li>
         </ol>
      </div>
   </nav>
   <!-- two columns -->
   <div id="two-columns" class="container">
      <div class="row">
         <!-- content -->
         <article id="content" class="col-xs-12 col-md-12">
          <div class="favourite col-lg-3 col-md-3 col-sm-3 col-xs-12 scrollStyle">
             <div class="fav search-form ">
              <input id="searchInput" type="search" placeholder="Search" onkeyup="searchFunction()" />
              <table class="datatable" id="datatable">

                <?php
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
                     ?>
                     <tr>
                           <th><span class="indexing">{{ $index }}. </span>
                            <a href="{{ $file }}" class="caption_class" data-type="{{ $VideoType }}" data-href="{{ $file }}"data-title="{{ $title }}">{{ $VideoTitle }}</a>
                          </th>
                        </tr>
                        <?php

                        $index++;
                  }
                  
                  }
                ?>
              </table>
             </div>
          </div><!-- /.fav -->
            <div class="purchased col-lg-9 col-md-9 col-sm-9 col-xs-12">
              <div class="course1 view-header">                  
                  <div class="col-xs-12 col-sm-9 d-flex1">
                    <h2></h2>
                    <div class="d-col1 widget_intro-1">
                    </div>
                  </div>
                </div><!-- /.course -->
            </div>
         </article>
      </div>
   </div>
</main>
<script>
  jQuery(document).ready(function($) { 
    $('.datatable tr a').on('click', function(e) {
      e.preventDefault();
      $('.caption_class').removeClass('active');
      $(this).addClass('active');
      // Uploaded Video
      var href_upload = $(this).attr('data-href');
      var video_type = $(this).attr('data-type');
      var video_title = $(this).attr('data-title');
      // console.log(href_upload);

      if(video_type == 'vimeo'){
        // var video = '<iframe src="" width="100%" height="307" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen class="play_video"></iframe>';
        var video = '<div class="embed-container"><iframe src="" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen class="play_video"></iframe></div>';
      }
      else{
        var video = '<video width="100%" controls><source class="play_video" src="" type=""></video>';
      }
      
      console.log(href_upload);

      $('h2').html(video_title);
      $('.widget_intro-1').html(video);
      $('.play_video').attr('src', href_upload);
      $('video').attr('autoplay','1');


    });

    $('.datatable tr:first-child a').trigger('click');

  });
</script>
<script>
  function searchFunction() {
      var input, filter, ul, li, a, i, txtValue;
      input = document.getElementById("searchInput");
      filter = input.value.toUpperCase();
      ul = document.getElementById("datatable");
      li = ul.getElementsByTagName("tr");
      for (i = 0; i < li.length; i++) {
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

<style>
.embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }
</style>
@stop
@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')

<?php use App\Http\Controllers\Frontend\IndexController; ?>
<?php use Illuminate\Support\Collection; ?>
<?php $user = Auth::user(); ?>
<main id="main">
   <!-- breadcrumb nav -->
   <nav class="breadcrumb-nav">
      <div class="container">
         <!-- breadcrumb -->
         <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li>Profile</li>
            <li class="active"><?php echo $user->name; ?></li>
         </ol>
      </div>
   </nav>
   <!-- two columns -->
   <div id="two-columns" class="container">
      <div class="row">
         <!-- content -->
         <article id="content" class="col-xs-12 col-md-12">
            <div class="purchased col-lg-8 col-md-8 col-sm-8 col-xs-12">
               <h2>Purchased Courses</h2>

               <?php
                  $foundbought = false; 
                  $userId = $user->id;
                  $AllCourses = DB::table('all_courses')->WHERE([
                    ['status', '=', 'Active'], 
                    ['purchased_by', 'like', '%"'.$userId.'"%']
                  ])->orderBy('created_at', 'DESC')->paginate(5);
                  
                  if ($AllCourses->count() > 0) {
                     foreach ($AllCourses as $key => $AllCourse) {
                     $arrayPurchased = explode(',', trim($AllCourse->purchased_by, "[]"));
                     if (in_array('"'.$userId.'"', $arrayPurchased)) { 
                        $foundbought = true;
               ?>
               <div class="course view-header">
                  <a href=""><h1><?= $AllCourse->name ?></h1></a> 
                  <div class="col-xs-12 col-sm-9 d-flex">
                     <div class="d-col">
                        <!-- post author -->
                        <div class="post-author">
                           <div class="alignleft no-shrink rounded-circle">
                              <a href="https://www.facebook.com/aminshoukat.1">
                                 <?php
                                   $User = DB::table('employees')->WHERE('id', $AllCourse->user_id)->first();
                                   $UserImageGet = DB::table('uploads')->WHERE('id', $User->image)->first();
                                   if ($UserImageGet) {
                                     $UserImage = "/files/$UserImageGet->hash/$UserImageGet->name";
                                   }else {
                                     $UserImage = "/frontend/images/defaultImage.jpg";
                                   } ?>
                              <img src="{{ $UserImage }}" class="rounded-circle" alt="image description"></a>
                           </div>
                           <div class="description-wrap">
                              <h2 class="author-heading"><a href="#">Instructor</a></h2>
                              <h3 class="author-heading-subtitle text-uppercase">{{ $User->name }}</h3>
                           </div>
                        </div>
                     </div>
                     <div class="d-col">
                        <!-- post author -->
                        <div class="post-author">
                           <div class="alignleft no-shrink icn-wrap">
                              <i class="far fa-bookmark"></i>
                           </div>
                           <div class="description-wrap">
                              <h2 class="author-heading"><a href="#">Category</a></h2>
                              <h3 class="author-heading-subtitle text-uppercase">
                                 <?php
                                    $categoryTrimed = trim($AllCourse->category, '[]');
                                    if ($categoryTrimed != '') {
                                       $exploded_categories = explode(',', $categoryTrimed);
                                       $categories = '';
                                       foreach ($exploded_categories as $exploded_category) {
                                         $get_slider_image = DB::table('categories')->WHERE('id', trim($exploded_category, '""'))->first();
                                         $categories .= '"'.$get_slider_image->name.'", ';
                                       }
                                         echo substr($categories, 0, -2);
                                    }
                                 ?>
                              </h3>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="make_fav">
                     <?php 
                     $arrayfavourite = explode(',', trim($AllCourse->favourite, "[]"));
                     if (in_array('"'.$userId.'"', $arrayfavourite)) { ?>
                        <a href="/profile/make_fav/<?= $AllCourse->id ?>/<?= $userId ?>"><i class="fa fa-heart heart-red"></i>  </a> My Favourite
                     <?php } else { ?>
                        <a href="/profile/make_fav/<?= $AllCourse->id ?>/<?= $userId ?>"><i class="fa fa-heart heart-black"></i> </a> Add to Favourite
                     <?php } ?>
                  </div>
                  <?php 
                     $CourseImageGet = DB::table('uploads')->WHERE('id', $AllCourse->image)->first();
                        if ($CourseImageGet) {
                           $CourseImage = "/files/$CourseImageGet->hash/$CourseImageGet->name";
                        }else {
                           $CourseImage = "/frontend/images/watch_video.jpg";
                        }
                  ?>
                  <a href="/single_course/<?= $AllCourse->id ?>"><img class="img" src="{{ $CourseImage }}" alt="Course" /></a>
               </div><!-- /.course -->
                <?php }else {
                    $error = '<p>You Have not buy Any Course !</p>';
                    }
                }  
               } else{
                  $error = '<p>No Course Found !</p>';
               }
               if ($foundbought != true) {
                echo $error;
               }
               ?>
           {{ $AllCourses->links() }}
            </div>
            <div class="favourite col-lg-4 col-md-4 col-sm-4 col-xs-12">
                  <h2>Featured Video</h2>
               <div class="light_box">
                   
                   <?php
                   $SingleRowVD = DB::table('sidebar_settings')->WHERE('id', 1)->first();
                   $getData = DB::table('videos')->WHERE('id', $SingleRowVD->featured_video)->first();                     

                     if($getData->video_option == 'vimeo'){

                      $featuredVideo = 'https://player.vimeo.com/video/'.$getData->vimeo_link.'?autoplay=1&loop=1';
                    }
                    else {

                      $get_Video = DB::table('uploads')->WHERE('id', trim($getData->file, '""'))->first(); 
                      $featuredVideo = '/files/'.$get_Video->hash.'/'.$get_Video->name.''; 

                    }
                     ?>
                  <a id="iframeopen" href="{{ $featuredVideo }}" data-lity><iframe id="iframe" allow="autoplay" src="{{ $featuredVideo }}" width="100%" height="100%" frameborder="0"></iframe></a>
               </div>
                <!--/.light_box -->
               <div class="fav">
                  <h2>Favourite Courses</h2>
                  <?php
                     $foundfav = false; 
                     $AllFavs = DB::table('all_courses')->WHERE([['status', '=', 'Active'], ['favourite', '!=', '[]']])->orderBy('created_at', 'DESC')->paginate(5);
                     if ($AllFavs->count() > 0) {
                        foreach ($AllFavs as $key => $AllFav) {
                        $arrayFav = explode(',', trim($AllFav->favourite, "[]"));
                        if (in_array('"'.$userId.'"', $arrayFav)) { 
                           $foundfav = true;
                  ?>
                  <div class="course">
                     <a href=""><h3>{{ $AllFav->name }}</h3></a>
                     <?php 
                        $FavCourseImageGet = DB::table('uploads')->WHERE('id', $AllFav->image)->first();
                           if ($FavCourseImageGet) {
                              $FavCourseImage = "/files/$FavCourseImageGet->hash/$FavCourseImageGet->name";
                           }else {
                              $FavCourseImage = "/frontend/images/watch_video.jpg";
                           }
                     ?>
                     <a href="/single_course/<?= $AllFav->id ?>"><img class="img" src="{{ $FavCourseImage }}" alt="Course" /></a>
                  </div>
                   <?php }else {
                       $error = '<p>Favourite Course Not Found !</p>';
                       }
                   }  
                  }
                  else{
                     $error = '<p>No Course Found !</p>';
                  }
                  if ($foundfav != true) {
                   echo $error;
                  }
                  ?>
               </div><!-- /.fav -->
            </div>
         </article>
      </div>
   </div>
</main>
@stop
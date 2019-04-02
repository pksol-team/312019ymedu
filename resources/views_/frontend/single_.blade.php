@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')





<?php use App\Http\Controllers\Frontend\IndexController; ?>
<?php use Illuminate\Support\Collection; ?>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>




{{-- Certificate  --}}
<?php if(Auth::user() != Null){ ?>

<!--<div id="html-holder" style="overflow:scroll;">-->
    <div id="html-content-holder">
<?php    $getCourse = DB::table('all_courses')->WHERE('id', $singleCourse->id )->first();  ?>
    
        <h1 class="nameUser">{{ Auth::user()->name }}</h1>
        <h2 class="courseHead_1">You Have SuceesFull Completed</h2>
	    <h2 class="courseHead_2">{{ $getCourse->name }} <?php echo "Course In Frankeey.com";?></h2>
	    <h3 style="color:white;" class="certificateDate">{{ date('d/m/Y') }}</h3>
		<img class="cerImage" src="/frontend/images/crtifict.jpg">
</div>
    
<!--</div>-->

<?php } ?>
{{-- Certificate end --}}

<?php $user = Auth::user(); 

 function vimeoVideoDuration($video_url) {
     
     
     
     
     $url = file_get_contents('https://vimeo.com/api/oembed.json?url=https%3A//vimeo.com/' . $video_url);
	            	 $duration =  json_decode($url)->duration;

	            	 $time = explode(":", gmdate("H:i:s", $duration));
	            	 
	            	 $hours = $time[0];
	            	 $minutes = $time[1];
	            	 $seconds = $time[2];
	            	  if($hours>0 && $hours<=9){
	              $hours = '0'.$hours.':';
	            }

	            if($hours == 0){
	              $hours = "";
	            }
	            
	            return "$hours$minutes:$seconds";

        //     $video_id = (int)substr(parse_url($video_url, PHP_URL_PATH), 1);

        //     $json_url = 'http://vimeo.com/api/v2/video/' . $video_id . '.xml';
            
           
        //     $ch = curl_init($json_url);
        //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //     curl_setopt($ch, CURLOPT_HEADER, 0);
        //     $data = curl_exec($ch);
        //     curl_close($ch);
        //     $data = new SimpleXmlElement($data, LIBXML_NOCDATA);

        //     if (!isset($data->video->duration)) {
        //         return null;
        //     }

        //     $duration = $data->video->duration;

        //     // return $duration; // in seconds
        //     $seconds = $duration;
        //     $hours = floor($seconds / 3600);
        //     $seconds -= $hours * 3600;
        //     $minutes = floor($seconds / 60);
        //     $seconds -= $minutes * 60;
            
        //   /* if($minutes>0 && $minutes<=9){
        //       $minutes = '0'.$minutes;
        //     }*/
        //     if($hours>0 && $hours<=9){
        //       $hours = '0'.$hours.':';
        //     }
        //     if($seconds>0 && $seconds<=9){
        //       $seconds = '0'.$seconds;
        //     }

        //     if($hours == 0){
        //       $hours = "";
        //     }
            
        //     return "$hours$minutes:$seconds"; //24:0:1
         }



?>


<main id="main">
   <!-- breadcrumb nav -->
   <nav class="breadcrumb-nav">
      <div class="container">
         <!-- breadcrumb -->
         <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li><a href="/">Course</a></li>
         </ol>
      </div>
   </nav>
   <?php
   if (Auth::check()){
      $userId = $user->id;
      $userName = $user->name;
      $userEmail = $user->email;
      $buyNow = '/frontend/buyNow/'.$singleCourse->id.'/'.$userId;
   }else {
      $userId = Null;
      $userName = Null;
      $userEmail = Null;
      $buyNow = '/frontend/login';
   }
   ?>
<!-- two columns -->

@if (Session::has('message'))

<div class="row" style="margin-top: 15px; margin-bottom: -56px;">
    <div class="col-sm-5 col-sm-offset-3">
        <div class="panel panel-danger">
            <div class="panel-heading panel-heading-custom">
                <h3 class="panel-title" style="text-align: center;">{!! session('message') !!}</h3>
            </div>
        </div>
    </div>
</div>  
@endif
<div id="two-columns" class="container">
   <div class="row">
      <!-- content -->
      <article id="content" class="col-xs-12 col-md-9">
         <!-- content h1 -->
         
         <h1 class="content-h1 fw-semi">{{ $singleCourse->name }}</h1>
         <!-- view header -->
         <header class="view-header row">
            <div class="col-xs-12 col-sm-9 d-flex">
               <div class="d-col">
                  <!-- post author -->
                  <div class="post-author">
                     <div class="alignleft no-shrink rounded-circle">
                        <?php
                        
                          $Usser = DB::table('employees')->WHERE('id', $singleCourse->user_id)->first();
                          $UserImageGet = DB::table('uploads')->WHERE('id', $Usser->image)->first();
                          if ($UserImageGet) {
                           // $UserImage = "/frontend/images/$UserImageGet->name";
                            $UserImage = "/files/$UserImageGet->hash/$UserImageGet->name";
                          }else {
                            $UserImage = "/frontend/images/defaultImage.jpg";
                          } ?>
                        <img src="{{ $UserImage }}" class="rounded-circle" alt="image description">
                     </div>
                     <div class="description-wrap">
                        <h2 class="author-heading"><a href="#">Instructor</a></h2>
                        <h3 class="author-heading-subtitle text-uppercase">{{ $Usser->name }}</h3>
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
                              $categoryTrimed = trim($singleCourse->category, '[]');
                              if ($categoryTrimed != '') {
                                 if (strlen($categoryTrimed) < 7) {
                                      $exploded_category = substr($categoryTrimed, 1, -1);
                                      $get_slider_image = DB::table('categories')->WHERE('id', $exploded_category)->first();
                                      echo $get_slider_image->name;
                                 }else {
                                 $exploded_categories = explode(',', $categoryTrimed);
                                 $categories = '';
                                 foreach ($exploded_categories as $exploded_category) {
                                   $get_slider_image = DB::table('categories')->WHERE('id', trim($exploded_category, '""'))->first();
                                   $categories .= '"'.$get_slider_image->name.'", ';
                                 }
                                   echo substr($categories, 0, -2);
                                 }
                              }
                           ?>
                        </h3>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-xs-12 col-sm-3">
               <div class="rating-holder">
                  <ul class="star-rating list-unstyled justify-end">
                     <?php
                                $total_stars = $singleCourse->add_stars;
                                $unfillStarts = 5-$singleCourse->add_stars;
                                if($total_stars>0){
                                    for($i = 0; $i < $total_stars; $i++){
                                        if($i < 5){
                                       ?>
                                            <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                                        <?php
                                        }
                                        
                                    }
                                }
                                
                                if($unfillStarts > 0){
                                    for($i = 0; $i < $unfillStarts; $i++){
                                        ?>
                                            <li><span class="far fa-star"><span class="sr-only">star</span></span></li>
                                        <?php
                                    }
                                }
                            ?>
                  </ul>
                  <?php
                
                  $CommentCount = DB::table('comments')->WHERE('course_id', $singleCourse->id)->whereNull('deleted_at')->count();
      

                  ?>
                  <strong class="element-block text-right subtitle fw-normal">
                    (<span class="countComment">{{ $CommentCount }}</span> Reviews)</strong>
               </div>
            </div>
         </header>
         
         
         <!--Payment form -->
         
                        <form method="POST" action="/createRequest" style="display: none;">
                            {{ csrf_field() }} 
                            
                            <input id="buyer_name" type="text" class="form-control" name="buyer_name" value="{{ $userName }}" required>
                            <input id="user_id" type="text" class="form-control" name="user_id" value="{{ $userId }}" required>
                            <input id="course_id" type="text" class="form-control" name="course_id" value="{{ $singleCourse->id }}" required>
                            <input id="amount" type="number" class="form-control" name="amount" value="{{ $singleCourse->price }}" required>
                            <input id="email" type="email" class="form-control" name="email" value="{{ $userEmail }}" required>
                            <input id="purpose" type="text" class="form-control" name="purpose" value="{{ $singleCourse->name }}" required>
                            <button type="submit" class="submitRequest" style="vertical-align:middle"><span>Buy Now Rs.<?= $singleCourse->price ?> /-</span></button>
                        </form> 
         
         
         <div class="aligncenter content-aligncenter">
            <section class="widget widget_intro">
               <h3>Course Intro</h3>
               <div class="aligncenter overlay">
                  <?php 
                     $extensions = ['avi', 'flv', 'wmv', 'mov', 'mp4', '3gp', 'webm'];

                     // Vimeo Work Start
                     $CourseIntroGet = DB::table('videos')->WHERE('id', $singleCourse->intro)->first();
                     $CourseVimeoLink = $CourseIntroGet->vimeo_link;
                     $CourseUploadVideo = $CourseIntroGet->file;
                     if(empty($CourseVimeoLink)){
                        $VideosTrimed = trim($CourseUploadVideo, '[]');
                   if ($VideosTrimed != '') {
                      if (strlen($VideosTrimed) < 7) {
                         $exploded_Videos = explode('""', $VideosTrimed);
                      }else {
                         $exploded_Videos = explode(',', $VideosTrimed);
                      }
                      $index = 0;
                      foreach ($exploded_Videos as $exploded_Video) {
                        $get_Video = DB::table('uploads')->WHERE('id', trim($exploded_Video, '""'))->first(); 
                        $CourseVideo = '/files/'.$get_Video->hash.'/'.$get_Video->name.'';
                      }
                     }
                  }else{
                     $CourseVideo = "https://vimeo.com/".$CourseVimeoLink;
                  } 
               // INtro Image
                   $CourseImageGet = DB::table('uploads')->WHERE('id', $singleCourse->image)->first();
                             if ($CourseImageGet) {
                                $CourseImage = "/files/$CourseImageGet->hash/$CourseImageGet->name";
                             }else {
                                $CourseImage = "/frontend/images/Image_not.jpg";
                             }

                             ?>

                             <a href="{{ $CourseVideo }}" class="btn-play far fa-play-circle lightbox fancybox.iframe"></a>
                  <img src="{{ $CourseImage }}" alt="image description" class="CourseImage">     
                  @section('image') <?= $CourseImage; ?>@stop
                  
               </div>
               <?php
             
                  if ($userId != Null) {
                       
                  $GetCourse = DB::table('all_courses')->WHERE([['id', $singleCourse->id], ['status', 'Active']])->orderBy('created_at', 'DESC')->first();
                     if ($GetCourse->purchased_by == '[]') { ?>
                     
                     <div style="text-align: center;">
                        <a href="#" class="payment"><button class="buttonbuy" style="vertical-align:middle"><span>Buy Now Rs.<?= $singleCourse->price ?> /-</span></button></a>
                     </div>
                  <?php }
                     else {   
                         
                        $arrayPurchased = explode(',', trim($GetCourse->purchased_by, "[]"));
                        if (in_array('"'.$userId.'"', $arrayPurchased)) { ?>
                           <div style="text-align: center;">
                              <a href="/questions/<?= $singleCourse->id; ?>"><button class="buttonbuy" style="vertical-align:middle"><span>Watch All Videos from this Course</span></button></a>
                           </div>

                        <?php                         

                      } else {?>
                        <div style="text-align: center;">
                           <a href="#" class="payment"><button class="buttonbuy" style="vertical-align:middle"><span>Buy Now Rs.<?= $singleCourse->price ?> /-</span></button></a>
                        </div>
                  <?php                 }
                     }
                  } 
                  else { ?>
                     <div style="text-align: center;">
                        <a href="<?= $buyNow; ?>" >   <button class="buttonbuy" style="vertical-align:middle"><span>Buy Now Rs.<?= $singleCourse->price ?> /-</span></button></a>
                     </div>
               <?php }
               
               
               ?>
            </section>
         </div>
         {!! $singleCourse->description !!}
         <strong>
             
            <p>The course is divided into <?= $singleCourse->no_of_section  ?> main sections:
            </p>
         </strong>
         <!-- sectionRow -->
         <section class="sectionRow">
            <h2 class="h6 text-uppercase fw-semi rowHeading"></h2>
            <!-- sectionRowPanelGroup -->
            <div class="panel-group sectionRowPanelGroup" id="accordion2" role="tablist" aria-multiselectable="true">
               <!-- panel -->
               <div class="panel panel-default">
                  <div class="panel-heading" role="tab" id="heading2Two">
                     <h3 class="panel-title fw-normal">
                        <a class="accOpener" role="button" data-toggle="collapse" data-parent="#accordion2" href="#collapse9Two" aria-expanded="false" aria-controls="collapse9Two">
                        <span class="accOpenerCol">
                        <i class="fas fa-chevron-circle-right accOpenerIcn"></i><i class="far fa-file inlineIcn"></i><span class="label label-warning text-white text-uppercase"><?= $singleCourse->no_of_section  ?> Sections Of This Course</span>
                        </span>
                        <span class="accOpenerCol hd-phone">
                        <time datetime="2011-01-12" class="timeCount">In This Course</time>
                        </span>
                        </a>
                     </h3>
                  </div>
                  <!-- collapseOne -->
                  <div id="collapse9Two" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading2Two">
                     <div class="panel-body">
                        {!! $singleCourse->content !!}
                     </div>
                  </div>
               </div>
         </section>
         <strong>
         <p>What You Will Learn From This Course:
         </p></strong>
         <!-- sectionRow -->
         <section class="sectionRow">
         <h2 class="h6 text-uppercase fw-semi rowHeading"></h2>
         <!-- sectionRowPanelGroup -->
         <div class="panel-group sectionRowPanelGroup" id="accordion2" role="tablist" aria-multiselectable="true">
         <!-- panel -->
         <div class="panel panel-default">
         <div class="panel-heading" role="tab" id="heading2Two">
         <h3 class="panel-title fw-normal">
         <a class="accOpener" role="button" data-toggle="collapse" data-parent="#accordion2" href="#collapse2Two" aria-expanded="false" aria-controls="collapse2Two">
         <span class="accOpenerCol">
         <i class="fas fa-chevron-circle-right accOpenerIcn"></i><i class="far fa-file inlineIcn"></i><span class="label label-success text-white text-uppercase">What you will learn</span>
         </span>
         <span class="accOpenerCol hd-phone">
         <time datetime="2011-01-12" class="timeCount">In This Course</time>
         </span>
         </a>
         </h3>
         </div>
         <!-- collapseOne -->
         <div id="collapse2Two" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading2Two">
         <div class="panel-body">
            {!! $singleCourse->what_learn !!}
         </div>
         </div>
         </div>
         </div>
         </section>          
         <!-- sectionRow -->
         <section class="sectionRow">
         <h2 class="h6 text-uppercase fw-semi rowHeading">Curriculum For This Course</h2>
         <!-- sectionRowPanelGroup -->
         <div class="panel-group sectionRowPanelGroup" id="accordion" role="tablist" aria-multiselectable="true">
         <!-- panel -->
         <?php 
         
            $VideosTrimed = trim($singleCourse->select_curriculum, '[]');
            if ($VideosTrimed != '') {
               $exploded_Videos = explode(',', $VideosTrimed);
               $categories = '';
               foreach ($exploded_Videos as $exploded_Video) {
                 $get_Video = DB::table('videos')->WHERE('id', trim($exploded_Video, '""'))->first();
         ?>
         <div class="panel panel-default">
         <div class="panel-heading" role="tab" id="headingOne">
         <h3 class="panel-title fw-normal">
         <a class="accOpener" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne<?= $get_Video->id ?>" aria-expanded="false" aria-controls="collapseOne">
         <span class="accOpenerCol">
         <i class="fas fa-chevron-circle-right accOpenerIcn"></i><i class="fas fa-play-circle inlineIcn"></i> <?= $get_Video->title ?> <span class="label label-primary text-white text-uppercase">Video</span>
         </span>
         <span class="accOpenerCol hd-phone">
         <time datetime="2011-01-12" class="timeCount">
          <?php
        
        //   var_dump($get_Video->vimeo_link);
        //   exit();
            if($get_Video->video_option == "vimeo"){
                     echo vimeoVideoDuration($get_Video->vimeo_link);   
         
            }
            else{
             $getVideo = DB::table('uploads')->WHERE('id', trim($get_Video->file, '""'))->first();
              $video_filehave = (storage_path().'/uploads/'.$getVideo->name);
              $getID3 = new getID3;
              $video_file = $getID3->analyze($video_filehave);
              if(isset($video_file['playtime_string'])) {
                  $duration_string = $video_file['playtime_string'];
                 echo ($duration_string);
              }
            } 
            
             ?>
         </time>
         </span>
         </a>
         </h3>
         </div>
         
         <!-- collapseOne -->
         <div id="collapseOne<?= $get_Video->id ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
         <div class="panel-body">                    
            
            <?php
            echo $get_Video->description;
            ?>
         
         </div>
         </div>
         </div>

             <?php }
            }
            else{
              echo "No Course available";
            }
         ?>
         <!-- panel -->
         </div>
         </section>            
             
             
             
             <?php
              
             if ($singleCourse->purchased_by != '[]') { 
                $arrayPurchased = explode(',', trim($singleCourse->purchased_by, "[]"));
                if (in_array('"'.$userId.'"', $arrayPurchased)) { 
              ?>
              
              <h2>Reviews</h2>
         @if(Auth::guest()) 
             @else
          <?php    
   
              $LoginUser = DB::table('employees')->WHERE('id', Auth::user()->id)->first();
              $LoginUserImage = DB::table('uploads')->WHERE('id', $LoginUser->image)->first();
              if ($LoginUserImage) {
               // $UserImage = "/frontend/images/$UserImageGet->name";
                $LoginImage = "/files/$LoginUserImage->hash/$LoginUserImage->name";
              }else {
                $LoginImage = "/frontend/images/defaultImage.jpg";
              } ?>
              <div class="post-author">
                     <div class="alignleft no-shrink rounded-circle">
                      <img src="{{ $LoginImage }}" class="rounded-circle" alt="image description">
                     </div>
                     <div class="description-wrap" style="width: 100%;">
                        {{ Form::open(['url' => '/comment', 'method' => 'post', 'id' => 'comment_form']) }}
                           <textarea name="current_user_comment" class="user_cmnt" placeholder="Write your comment here {{Auth::user()->name}}"></textarea>
                           <input type="hidden" name="course_name" value="{{ $singleCourse->id }}">
                           <input type="hidden" name="instructorID" value="{{ $singleCourse->user_id }}">
                           <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                           <input type="hidden" name="user_image" value="{{ $LoginImage }}">                          
                          <div class="displayButtons" style="display: none; float: right;">
                             <button type="submit" class="btn btn-success comment">Comment</button>
                             <button type="button" class="btn btn-danger cancel_btn"  onclick="cancel()">Cancel</button>
                          </div>
                        {{ Form::close() }}
                     </div>
               </div>
               @endif
         
         
              <?php
                }
             }
             ?>
          
             <div class="main_comment">      
         <?php
            $course_id = $singleCourse->id;
            $comments_id =  DB::table('comments')->whereNull('deleted_at')->WHERE('course_id', $course_id)->orderBy('id','DESC')->get();

            if (!empty($comments_id)) { ?>
             <h3 class="h6 fw-semi currentComment">Student's Feedback</h3>
            <?php foreach ($comments_id as $comment) { ?>
                  <div class="post-author">
                     <div class="alignleft no-shrink rounded-circle">
                        <?php 
                          $commented_user_image = DB::table('employees')->WHERE('id', $comment->user_id)->first();
                          if($commented_user_image != Null) {
                              $UserImageGet = DB::table('uploads')->WHERE('id', $commented_user_image->image)->first();
                              if ($UserImageGet) {
                                $UserImage = "/files/$UserImageGet->hash/$UserImageGet->name";
                              }else {
                                $UserImage = "/frontend/images/defaultImage.jpg";
                              }?>
                              <img src="{{ $UserImage }}" class="rounded-circle" alt="image description">
                         <?php }?>
                     </div>
                     <div class="description-wrap">
                        <h2 class="author-heading"><b>{{ $commented_user_image->name }}</b> {{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</h2>
                        <h3 class="author-heading-subtitle">{{ $comment->user_comments }}</h3>
                     </div>
                  </div> 
                  <?php   
                }
            }
            else{
                
              echo "<h3 class='h6 fw-semi currentComment'>No Feedback</h3>";
            }
         ?>
         </div>  
              
             
             
             
             
             
             
             
             
         

      </article>
      <!-- sidebar -->
      <aside class="col-xs-12 col-md-3" id="sidebar">
      <!-- widget tags -->
      <nav class="widget widget_tags">
      <h3>Tags</h3>
      <!-- tag clouds -->
      <ul class="list-unstyled tag-clouds font-lato">
         @php
       
          if($singleCourse->tag != ''){
            
            $explodedTags = explode(',', $singleCourse->tag);

            foreach ($explodedTags as $explodedTag) {
              @endphp
                <li><a href="#">{{ $explodedTag }}</a></li>  
              @php
            }

          }
          else{
            echo "<p>No Tags</p>";
          }
    
        @endphp
      </ul>
      </nav>
        
     

      <section class="widget widget_intro">
      <h3>Demo Of This Course</h3>
      <div class="aligncenter overlay">

      <?php

        $getVideo = DB::table('videos')->WHERE('id', $singleCourse->demo_video)->first();

        if($getVideo->vimeo_link == 0){
          
          $getVideoUploads = DB::table('uploads')->WHERE('id', $getVideo->file)->first();
          
          $demoVideo = '/files/'.$getVideoUploads->hash.'/'.$getVideoUploads->name.'';

          $VideoImage = "<video src='".$demoVideo."' style='margin-bottom:-6px; width:100%'></video>";
          
        //   $getVideoimg = DB::table('uploads')->WHERE('id', $singleCourse->image)->first();

        //   if ($getVideoimg) {
            
        //     $VideoImage = "/files/$getVideoimg->hash/$getVideoimg->name";
        //   } 
        //   else {
          
        //     $UserImage = "/frontend/images/defaultImage.jpg";
          
        //   }         

            } 
        else{
            
            $demoVideo = "https://player.vimeo.com/video/".$getVideo->vimeo_link;
            
            $headers = get_headers('https://vimeo.com/api/v2/video/'.$getVideo->vimeo_link.'.json');
            if(substr($headers[0], 9, 3) != '200'){
                $VideoImage = "<img src='/frontend/images/playvideoimage.png' alt='No Thumbnail'>";
                
            }
            
            else{
                $vimeo_json_data = json_decode(file_get_contents('https://vimeo.com/api/v2/video/'.$getVideo->vimeo_link.'.json'));
                
                 $VideoImage = "<img src='".$vimeo_json_data[0]->thumbnail_large."' alt='No Thumbnail'>";
                 
                // $VideoImage = $vimeo_json_data[0]->thumbnail_large;
                
            }
        }

      ?> 


      <a href="{{ $demoVideo }}" class="btn-play far fa-play-circle lightbox fancybox.iframe"></a>
      <?php echo $VideoImage; ?>
      <!--<img src="{{ $VideoImage }}" alt="No Thumbnail">-->
      </div>
      </section>
      <!-- widget course select -->
      <section class="widget widget_box widget_course_select">
      <header class="widgetHead text-center bg-theme">
      <h3 class="text-uppercase">Full Course In Tamil</h3>
      </header>
      <strong class="price element-block font-lato" data-label="price:"><?= $singleCourse->price ?> /-</strong>
      <ul class="list-unstyled font-lato">
      <li>
        <i class="far fa-user icn no-shrink"></i> 
       {{-- @php
            $students = trim($singleCourse->purchased_by, '[]');
        @endphp
        @if($students == '')
          0
        @else
          {{ count(explode(',', $students)) }}
        @endif --}}
        {{ $singleCourse->students}}
      Students</li>
      <li><i class="fas fa-bullhorn icn no-shrink"></i> Access on mobile and TV </li>
      <li>
        <i class="far fa-play-circle icn no-shrink"></i>
       {{-- @php
          $arrayVideo = trim($singleCourse->videos, '[]');          
          $Videos =  DB::table('videos')->WHERE('id', $singleCourse->image)->first();
          $totalSeconds = 0;
          $secondsFile = 0;
          $secondsVimeo = 0;
          
                
          $arrayVideo = trim($singleCourse->videos, '[]');
            if ($arrayVideo != '') {
                $VideosExplod = explode(',', $arrayVideo);
              foreach ($VideosExplod as $VideoExplod) {
                $get_Video = DB::table('videos')->WHERE('id', trim($VideoExplod, '""'))->first();
                if($get_Video->vimeo_link == 0){
                            
                  $getVideo = DB::table('uploads')->WHERE('id', $get_Video->file)->first();
                  
                  $video_filehave = (storage_path().'/uploads/'.$getVideo->name);
                  
                  $getID3 = new getID3;
                  
                  $video_file = $getID3->analyze($video_filehave);
                  
                  if(isset($video_file['playtime_string'])) {
                      $duration_string = $video_file['playtime_string'];
                      // Converting time into seconds
                      $timeFile = explode(':', $duration_string);
                      $fileDurationLength = count($timeFile);
                      if($fileDurationLength < 2){

                        $hoursTOsec = $timeFile[0]*60*60;
                        $mintTOsec = $timeFile[1]*60;
                        $sec = $timeFile[3];

                      }
                      else{
                        $mintTOsec = $timeFile[0]*60;  
                        $hoursTOsec = 0;   
                        $sec = $timeFile[1];
                      }
                     

                      $secondsFile = $hoursTOsec+$mintTOsec+$sec;
                  }
                }
                else{
                         
                $headers = get_headers('https://vimeo.com/'.$get_Video->vimeo_link);
                if(substr($headers[0], 9, 3) == '200'){   
                  $timeVimeo = explode(':',vimeoVideoDuration('https://vimeo.com/'.$get_Video->vimeo_link));
                  
                 $vimeoDurationLength = count($timeVimeo);
                      if($vimeoDurationLength < 2){

                        $hoursTOsecV = $timeVimeo[0]*60*60;
                        $mintTOsecV = $timeVimeo[1]*60;
                        $secV = $timeVimeo[3];

                      }
                      else{
                       $mintTOsecV = $timeVimeo[0]*60;  
                        $hoursTOsecV = 0;   
                        $secV = $timeVimeo[1];
                      }

                     $secondsVimeo = $hoursTOsecV+$mintTOsecV+$secV;              
                }
                }

                $totalSeconds = $secondsVimeo + $secondsFile + $totalSeconds;
               }
             }
             echo gmdate("H:i:s", $totalSeconds);
        @endphp --}}
        {{ $singleCourse->course_duration}} Course duration
      </li>
      
       @if(Auth::guest()) 
       @else
      <?php
         if ($singleCourse->purchased_by != '[]') { 
                $arrayPurchased = explode(',', trim($singleCourse->purchased_by, "[]"));
                if (in_array('"'.$userId.'"', $arrayPurchased)) { 
                    ?>
                      <li>
         <i class="far fa-address-card icn no-shrink"></i> 
             <!-- Certificate -->
               <div class="certificateButton">

                 <a class="btn-Convert-Html2Image" href="#"><button class="certificate-btn" style="background: white; border: none;  color: rgba(0,0,0,0.6);">Get Certificate</button></a>

                 <a class="scndBtn" href="#" style="display: none;"><button class="btn btn-success">Download</button></a>

               </div>
             
           {{-- Certificate of Completion --}}
      </li>
                    <?php
                }
         }
      ?>
        @endif
      
     
     
      </ul>
      </section>
      <section class="widget">
        <h3>Related Courses</h3>
      </section>      
      

      <?php
        $VideosTrimed = trim($singleCourse->sidebar, '[]');
            if ($VideosTrimed != '') {
               $exploded_Videos = explode(',', $VideosTrimed);
               $categories = '';
               foreach ($exploded_Videos as $exploded_Video) {
                 $get_Video = DB::table('videos')->WHERE('id', trim($exploded_Video, '""'))->first();
      ?>
      <section class="widget widget_intro">
        <h3>{{ $get_Video->title }}</h3>
        <div class="aligncenter overlay"> 
        
        
        <?php
        
        if($get_Video->vimeo_link == 0){
          
          $getVideoUploads = DB::table('uploads')->WHERE('id', $get_Video->file)->first();
          
          $relatedCourseVideo = '/files/'.$getVideoUploads->hash.'/'.$getVideoUploads->name.'';

          $VideoImage = "<video src='".$relatedCourseVideo."' style='margin-bottom:-6px; width:100%'></video>";
            } 
        else{
            
            $relatedCourseVideo = "https://player.vimeo.com/video/".$get_Video->vimeo_link;
            
            $headers = get_headers('https://vimeo.com/api/v2/video/'.$get_Video->vimeo_link.'.json');
            if(substr($headers[0], 9, 3) != '200'){
                $VideoImage = "<img src='/frontend/images/playvideoimage.png' alt='No Thumbnail'>";
                
            }
            
            else{
                $vimeo_json_data = json_decode(file_get_contents('https://vimeo.com/api/v2/video/'.$get_Video->vimeo_link.'.json'));
                
                 $VideoImage = "<img src='".$vimeo_json_data[0]->thumbnail_large."' alt='No Thumbnail'>";
                 
                
            }
        }

      ?> 


      <a href="{{ $relatedCourseVideo }}" class="btn-play far fa-play-circle lightbox fancybox.iframe"></a>
      <?php echo $VideoImage; ?>
        
        
        
        
        </div>
      </section>

      <?php

    }
  }
      ?>
      {{-- SideBar --}}

      <?php
      if (Auth::check()){$userId = $user->id;}else {$userId = Null;}
         if ($userId != Null) {
         $GetCourse = DB::table('all_courses')->WHERE([['id', $singleCourse->id], ['status', 'Active']])->orderBy('created_at', 'DESC')->first();
            if ($GetCourse->purchased_by == '[]') { ?>
            <div style="text-align: center;">
              <a href="#" class="payment"><button class="buttonbuy" style="vertical-align:middle"><span>Buy Now Rs.<?= $singleCourse->price ?> /-</span></button></a>
            </div>
         <?php 
       }
            else {             
               $arrayPurchased = explode(',', trim($GetCourse->purchased_by, "[]"));
               
               if (in_array('"'.$userId.'"', $arrayPurchased)) { } else {?>
               <div style="text-align: center;">
                  <a href="#" class="payment"><button class="buttonbuy" style="vertical-align:middle"><span>Buy Now Rs.<?= $singleCourse->price ?> /-</span></button></a>
               </div>
         <?php }
            }
         } else { ?>
            <div style="text-align: center;">
               <a href="<?= $buyNow; ?>" >   <button class="buttonbuy" style="vertical-align:middle"><span>Buy Now Rs.<?= $singleCourse->price ?> /-</span></button></a>
            </div>
      <?php }
      ?>
      </aside>
      </div>
   </div>
   </main>  



   <script>
      function cancel(){

         var displayButton = $('div.displayButtons'); 
        
         $(displayButton).hide();
        
         $('textarea[name=current_user_comment').val('');         
      }
      $(document).ready(function() {
         
         $('.user_cmnt').on('input', function(event) {
        
            var get_input = $(this).val();
            var displayButton = $('div.displayButtons');

            if(get_input != '' && $.trim(get_input)){
               $(displayButton).show();            
            }
          else{
            $(displayButton).hide(); 
          }

         });
         $('#comment_form').submit(function(e){            
            e.preventDefault();
            var $this = $(this);
            var commentData = $this.serializeArray();
            var action = $this.attr('action');
            $.ajax({
               type : 'POST',
               url : action,
               data: commentData,

            }).done(function(response){
            //   $(response).prependTo('.main_comment');
            $(response).appendTo('.currentComment');
            

               var comments = parseInt($('.countComment').html());
               
               $('.countComment').html(comments+1);

               $('.cancel_btn').trigger('click');
            });
         });


          // Certificate Jquery
          $(".btn-Convert-Html2Image").on('click', function(e) {
            e.preventDefault();
          var element = $("#html-content-holder"); // global variable
          
          certificateDownload(element);
          // $("a.scndBtn").trigger('click'); 
          });
          function certificateDownload(element){
            element.show();
            var getCanvas; // global variable
              
              
              
              
                   html2canvas(element, {
                       width:1423,
                  onrendered: function (canvas) {
                         getCanvas = canvas;
                    var imgageData = getCanvas.toDataURL("image/png");
                    var newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");
                    $(".scndBtn").attr("download", "Certificate.png").attr("href", newData);
                  }
                 }); 
                  setTimeout(function(){

                  $(".scndBtn")[0].click();

                  element.hide();                  

                  }, 50);


          }

      });
     
     
 

    $('.payment').on('click', function(e) {
       e.preventDefault();
       $('.submitRequest').trigger('click');

     });
   </script>
  
  
  <style>
      
      .CourseImage{
          height:477px;
      }
      

    .fancybox-slide>video{
         width:50% !important;
     }
     

      
  </style>
@stop
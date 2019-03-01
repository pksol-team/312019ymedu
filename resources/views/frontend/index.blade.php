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
				<li class="active"><a href="/">Home</a></li>
			</ol>
		</div>
	</nav>
<!-- two columns -->
<div id="two-columns" class="container">
   <div class="row">
      <!-- content -->
      <article id="content" class="col-xs-12 col-md-9">
         <!-- show head -->
         <header class="show-head">
            <p></p>
            <!-- <p> Showing 1–9 of 15 results</p> -->
            <!--<select class="chosen-select-no-single">-->
            <!--   <option value="0">All Courses</option>-->
            <!--   <option value="0">All Courses</option>-->
            <!--   <option value="0">All Courses</option>-->
            <!--   <option value="0">All Courses</option>-->
            <!--</select>-->
         </header>
         
         <div class="row flex-wrap">
            <?php
            
            if ($haveCourses): ?>
               <?php if ($haveCourses[0] == NULL): ?>
                  <p>No Courses Found</p>
               <?php  else: ?>
               <?php foreach ($haveCourses as $haveCourse): 
               if($haveCourse->deleted_at == NULL){
                  
              
               ?>
               
               <div class="col-xs-12 col-sm-6 col-lg-4">
                  <!-- popular post -->
                  <article class="popular-post">
                     <div class="aligncenter">
                        <?php 
                             $CourseImageGet = DB::table('uploads')->WHERE('id', $haveCourse->image)->first();
                             if ($CourseImageGet) {
                                 $CourseImage = "/files/$CourseImageGet->hash/$CourseImageGet->name";
                             }
                             else {
                                $CourseIntroGet = DB::table('uploads')->WHERE('id', $haveCourse->intro)->first();
                                if ($CourseIntroGet) {
                                    $extensions = ['avi', 'flv', 'wmv', 'mov', 'mp4', '3gp', 'webm'];
                                    if (in_array($CourseIntroGet->extension, $extensions)) {
                                         $CourseImage = "/frontend/images/Image_not.jpg";
                                    }else {
                                       $CourseImage = "/files/$CourseIntroGet->hash/$CourseIntroGet->name";
                                    }
                                }else {
                                   $CourseImage = "/frontend/images/Image_not.jpg";
                                }
                             }
                         ?>                        
                        <a href="/single_course/<?= $haveCourse->id; ?>"><img src="{{ $CourseImage }}" alt="image description"></a>
                     </div>
                     <div>
                         
                        <strong class="bg-success text-white font-lato text-uppercase price-tag"><?php echo ($haveCourse->price == 0) ? 'Free' : $haveCourse->price ; ?></strong>
                     </div>
                     <h3 class="post-heading"><a href="/single_course/<?= $haveCourse->id; ?>"><?= $haveCourse->name; ?></a></h3>
                     <div class="post-author">
                        <div class="alignleft no-shrink rounded-circle">
                           <?php
                             $User = DB::table('employees')->WHERE('id', $haveCourse->user_id)->first();
                             $UserImageGet = DB::table('uploads')->WHERE('id', $User->image)->first();
                             if ($UserImageGet) {
                               $UserImage = "/files/$UserImageGet->hash/$UserImageGet->name";
                             }else {
                               $UserImage = "/frontend/images/Image_not.jpg";
                             }
                           ?>
                           <a href="instructor-single.html"><img src="{{ $UserImage }}" class="rounded-circle" alt="image description"></a>
                        </div>
                        <h4 class="author-heading"><a href="instructor-single.html">
                           <?php
                             echo $User->name;
                           ?>
                        </a></h4>
                     </div>
                     <footer class="post-foot gutter-reset">
                        <ul class="list-unstyled post-statuses-list">
                           <li>
                              <a href="#">
                              <span class="fas icn fa-users no-shrink"><span class="sr-only">users</span></span>
                              <strong class="text fw-normal">{{ $haveCourse->students }}</strong>
                              </a>
                           </li>
                           <li>
                               <?php
                                 $CommentCount = DB::table('comments')->WHERE('course_id', $haveCourse->id)->whereNull('deleted_at')->count();
                                 if($CommentCount == 0)
                                 $CommentCount = 0
                               ?>
                              <a href="#">
                              <span class="fas icn no-shrink fa-comments"><span class="sr-only">comments</span></span>
                              <strong class="text fw-normal">{{ $CommentCount }}</strong>
                              </a>
                           </li>
                        </ul>
                        <ul class="star-rating list-unstyled">
                            <?php
                                $total_stars = $haveCourse->add_stars;
                                $unfillStarts = 5-$haveCourse->add_stars;
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
                           <!--<li><span class="fas fa-star"><span class="sr-only">star</span></span></li>-->
                           <!--<li><span class="fas fa-star"><span class="sr-only">star</span></span></li>-->
                           <!--<li><span class="fas fa-star"><span class="sr-only">star</span></span></li>-->
                           <!--<li><span class="fas fa-star"><span class="sr-only">star</span></span></li>-->
                           <!--<li><span class="far fa-star"><span class="sr-only">star</span></span></li>-->
                        </ul>
                        
                     </footer>
                  </article>
               </div>
               <?php 
               }
               endforeach ?>
               <?php endif ?>
            <?php else: ?>
               <p>No Courses Found</p>
            <?php endif ?>
         </div>
         <nav aria-label="Page navigation">
           {{ $haveCourses->links() }}
         </nav>
      </article>
      <!-- sidebar -->
      <aside class="col-xs-12 col-md-3" id="sidebar">
         <!-- widget search -->
         <section class="widget widget_search">
            <h3>Course Search</h3>
            <!-- search form -->
            <form action="/search/" method="get" class="search-form" id="searchForm">
               <fieldset>
                  <input id="searchInput" placeholder=" Search&hellip;" class="form-control" name="s" type="search">
                  <button id="searchSubmit" type="submit" class="fas fa-search"><span class="sr-only">search</span></button>
               </fieldset>
            </form>
         </section>
         <!-- widget categories -->
         <section class="widget widget_categories">
            <h3>Course Categories</h3>
            <ul class="list-unstyled text-capitalize font-lato">
               <?php if ($haveCategories): ?>
                  <?php foreach ($haveCategories as $haveCategory): ?>
                     <li class="cat-item cat-item-1"><a href="#"><?= $haveCategory->name ?></a></li>
                  <?php endforeach ?>
               <?php else: ?>
                  No Categories Found
               <?php endif ?>
            </ul>
         </section>
         <!-- widget intro -->
         
         <section class="widget widget_intro">
            <h3>Course Intro</h3>
             <div class="aligncenter overlay">
         <?php
            $getSidebar = DB::table('sidebar_settings')->WHERE('id', 1)->first();
            
            $videos = DB::table('videos')->WHERE('id', $getSidebar->course_intro)->first();
            // var_dump($videos);
            // exit();
             if($videos){
            if($videos->video_option == 'vimeo'){
                
                $introCourse = "https://vimeo.com/".$videos->vimeo_link;
                
                $headers = get_headers('https://vimeo.com/api/v2/video/'.$videos->vimeo_link.'.json');
                if(substr($headers[0], 9, 3) != '200'){
                $introImage = "<img src='/frontend/images/playvideoimage.png' alt='No Thumbnail'>";
            
            }
            
            else{
                
                $vimeo_json_data = json_decode(file_get_contents('https://vimeo.com/api/v2/video/'.$videos->vimeo_link.'.json'));
                
                 $introImage = "<img src='".$vimeo_json_data[0]->thumbnail_large."' alt='No Thumbnail'>";
                
            }
                
            }
            else{
                $get_Video = DB::table('uploads')->WHERE('id', $videos->file)->first(); 
                        $introCourse = '/files/'.$get_Video->hash.'/'.$get_Video->name.'';
                        $introImage = "<video src='".$introCourse."' style='width:100%; margin-bottom:-6px;' class='image'></video>";
            }
         ?>
         
           
               <a href="{{ $introCourse }}" class="btn-play far fa-play-circle lightbox fancybox.iframe"></a>
               <?php echo $introImage; ?>
               <!--<img src="/frontend/images/img32.jpg" alt="image description">-->
            
         <?php
            }else{
                echo "No Course Intro available";
            }
         ?>
         </div>
         </section>
         <!-- widget popular posts -->
         <section class="widget widget_popular_posts">
            <h3>Popular Courses</h3>
            <!-- widget cources list -->
            
           
            <ul class="widget-cources-list list-unstyled">
                
                
                 <?php
                
                 
                $arrayCourse = trim($getSidebar->popular_courses, '[]');
            if ($arrayCourse != '') {
                $CourseExplod = explode(',', $arrayCourse);
              foreach ($CourseExplod as $CourseExploded) {
                $getCourse = DB::table('all_courses')->WHERE('id', trim($CourseExploded, '""'))->first();
                if($getCourse){
                $getImage = DB::table('uploads')->WHERE('id', $getCourse->image)->first();
                 if ($getImage) {
                          $courseImage = "/files/$getImage->hash/$getImage->name";
                        } else {

                          $courseImage = "/frontend/images/Image_not.jpg";
                        } 
                
                ?>
                 <li>
                  <a href="/single_course/<?php echo $getCourse->id; ?>">
                     <div class="alignleft large">
                        <img src="<?php echo $courseImage; ?>" alt="image description">
                     </div>
                     <div class="description-wrap">
                        <h4><?php echo $getCourse->name; ?></h4>
                        <strong class="price text-primary element-block font-lato text-uppercase"><?php echo $getCourse->price; ?></strong>
                     </div>
                  </a>
               </li>
                <?php
              }
              }
            }else{
                echo "No Popular course yet";
            }
            
            ?>
              
            </ul>
         </section>
      </aside>
   </div>
</div>
</main>	

<script>
    function searchsubmit($){
      var inputS = $("#searchInput").val();

          if(inputS != '') {
              window.location = "<?= URL::to('/') . '/search/'; ?>"+inputS;
          } else {
              alert('Please enter query');
          }
    }
   jQuery(document).ready(function($) {
    
    
        
      $("#searchSubmit").click(function(e) {
        searchsubmit($);
            
       });
      $('#searchForm').submit(function(e) {
        e.preventDefault();
        searchsubmit($);
      });
   });
</script>

<style>
    .fancybox-slide>video{
         width:50% !important;
     }
     
</style>
@stop
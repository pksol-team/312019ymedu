@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')

<?php use App\Http\Controllers\Frontend\IndexController; ?>
<?php use Illuminate\Support\Collection; ?>

<main id="main">
	<!-- breadcrumb nav -->

<!-- two columns -->
<div id="two-columns" class="container">
   <div class="row">
      <!-- content -->
      <article id="content" class="col-xs-12 col-md-12">
         <!-- show head -->
         <div class="container">
<!--   <h2>Carousel Example</h2> -->  
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
  
    <!-- Wrapper for slides -->
    <div class="carousel-inner">
    @php
    $coursesCount_ = 13;
    if($coursesCount_ > 5){
        if($coursesCount_/5 > round($coursesCount_/5)){
          $total_slides_ = round($coursesCount_/5)+1;         

        }else{
          $total_slides_ = round($coursesCount_/5);         
        }
      }else{
        $total_slides_ = 1;
      }   
echo $total_slides_;

      if($coursesCount > 5){
         
          $total_slides = round($coursesCount/5);         
        }else{
          $total_slides = 1;
        }        

        // echo round( 1.3, 0, PHP_ROUND_HALF_UP);
    @endphp
  


    @for ($i = 0; $i < $total_slides ; $i++)   
   
    <?php
    $starting = $i*5;
    

        $courses = DB::table('all_courses')->whereNull('deleted_at')->WHERE('status' , 'Active')->skip($starting)->take(5)->get();

        if($courses){         
            ?>
            <div class="item @if ($i == 0) active @endif">
            

              <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-4 ">
                  <article class="popular-post">
                    <div class="aligncenter">
                      <a href="/single_course/54">
                        <?php 
                             $CourseImageGet = DB::table('uploads')->WHERE('id', $courses[0]->image)->first();
                             if ($CourseImageGet) {
                                 $CourseImage_0 = "/files/$CourseImageGet->hash/$CourseImageGet->name";
                             }
                             else {
                                $CourseIntroGet = DB::table('uploads')->WHERE('id', $courses[0]->intro)->first();
                                if ($CourseIntroGet) {
                                    $extensions = ['avi', 'flv', 'wmv', 'mov', 'mp4', '3gp', 'webm'];
                                    if (in_array($CourseIntroGet->extension, $extensions)) {
                                         $CourseImage_0 = "/frontend/images/Image_not.jpg";
                                    }else {
                                       $CourseImage_0 = "/files/$CourseIntroGet->hash/$CourseIntroGet->name";
                                    }
                                }else {
                                   $CourseImage_0 = "/frontend/images/Image_not.jpg";
                                }
                             }
                         ?>  
                        <img src="{{ $CourseImage_0 }}" alt="image description"></a>
                    </div>
                    <div class="pp-post-bottim">
                      <h3 class="post-heading"><a href="/single_course/<?= $courses[0]->id; ?>">{{ $courses[0]->name }}</a></h3>
                        <footer class="post-foot gutter-reset">
                          <?php
                             $total_stars = $courses[0]->add_stars;
                             $unfillStarts = 5-$courses[0]->add_stars;
                             if($total_stars>0){
                                 for($j = 0; $j < $total_stars; $j++){
                                     if($j < 5){
                                    ?>
                                      <span class="fa fa-star checked"></span>
                                     <?php
                                     }
                                     
                                 }
                             }
                             
                             if($unfillStarts > 0){
                                 for($k = 0; $k < $unfillStarts; $k++){
                                     ?>
                                         <span class="far fa-star" style="color: #ffa300;"><span class="sr-only" >star</span></span>
                                     <?php
                                 }
                             }
                          ?>
                        </footer>
                    </div>
                  </article>            
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                  <article class="popular-post">
                    <div class="aligncenter">
                      <a href="/single_course/<?= $courses[1]->id; ?>">

                        <?php 
                             $CourseImageGet = DB::table('uploads')->WHERE('id', $courses[1]->image)->first();
                             if ($CourseImageGet) {
                                 $CourseImage_1 = "/files/$CourseImageGet->hash/$CourseImageGet->name";
                             }
                             else {
                                $CourseIntroGet = DB::table('uploads')->WHERE('id', $courses[1]->intro)->first();
                                if ($CourseIntroGet) {
                                    $extensions = ['avi', 'flv', 'wmv', 'mov', 'mp4', '3gp', 'webm'];
                                    if (in_array($CourseIntroGet->extension, $extensions)) {
                                         $CourseImage_1 = "/frontend/images/Image_not.jpg";
                                    }else {
                                       $CourseImage_1 = "/files/$CourseIntroGet->hash/$CourseIntroGet->name";
                                    }
                                }else {
                                   $CourseImage_1 = "/frontend/images/Image_not.jpg";
                                }
                             }
                         ?>  
                        <img src="{{ $CourseImage_1 }}" alt="image description"></a>
                    </div>
                    <div class="pp-post-bottim">
                      <h3 class="post-heading"><a href="/single_course/54">{{ $courses[1]->name }}</a></h3>
                        <footer class="post-foot gutter-reset">
                         
                         <?php
                            $total_stars = $courses[1]->add_stars;
                            $unfillStarts = 5-$courses[1]->add_stars;
                            if($total_stars>0){
                                for($j = 0; $j < $total_stars; $j++){
                                    if($j < 5){
                                   ?>
                                     <span class="fa fa-star checked"></span>
                                    <?php
                                    }
                                    
                                }
                            }
                            
                            if($unfillStarts > 0){
                                for($k = 0; $k < $unfillStarts; $k++){
                                    ?>
                                        <span class="far fa-star" style="color: #ffa300;"><span class="sr-only" >star</span></span>
                                    <?php
                                }
                            }
                         ?>
                        </footer>
                    </div>
                  </article>            
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                  <article class="popular-post">
                    <div class="aligncenter">
                      <a href="/single_course/<?= $courses[2]->id; ?>">

                        <?php 
                             $CourseImageGet = DB::table('uploads')->WHERE('id', $courses[2]->image)->first();
                             if ($CourseImageGet) {
                                 $CourseImage_2 = "/files/$CourseImageGet->hash/$CourseImageGet->name";
                             }
                             else {
                                $CourseIntroGet = DB::table('uploads')->WHERE('id', $courses[2]->intro)->first();
                                if ($CourseIntroGet) {
                                    $extensions = ['avi', 'flv', 'wmv', 'mov', 'mp4', '3gp', 'webm'];
                                    if (in_array($CourseIntroGet->extension, $extensions)) {
                                         $CourseImage_2 = "/frontend/images/Image_not.jpg";
                                    }else {
                                       $CourseImage_2 = "/files/$CourseIntroGet->hash/$CourseIntroGet->name";
                                    }
                                }else {
                                   $CourseImage_2 = "/frontend/images/Image_not.jpg";
                                }
                             }
                         ?>  
                        <img src="{{ $CourseImage_2 }}" alt="image description"></a>
                    </div>
                    <div class="pp-post-bottim">
                      <h3 class="post-heading"><a href="/single_course/54">{{ $courses[2]->name }}</a></h3>
                        <footer class="post-foot gutter-reset">
                          <?php
                             $total_stars = $courses[2]->add_stars;
                             $unfillStarts = 5-$courses[2]->add_stars;
                             if($total_stars>0){
                                 for($j = 0; $j < $total_stars; $j++){
                                     if($j < 5){
                                    ?>
                                      <span class="fa fa-star checked"></span>
                                     <?php
                                     }
                                     
                                 }
                             }
                             
                             if($unfillStarts > 0){
                                 for($k = 0; $k < $unfillStarts; $k++){
                                     ?>
                                         <span class="far fa-star" style="color: #ffa300;"><span class="sr-only" >star</span></span>
                                     <?php
                                 }
                             }
                          ?>
                        </footer>
                    </div>
                  </article>          
                </div>
              </div>
              <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                  <article class="popular-post">
                    <div class="aligncenter">
                      <a href="/single_course/<?= $courses[3]->id; ?>">

                        <?php 
                             $CourseImageGet = DB::table('uploads')->WHERE('id', $courses[3]->image)->first();
                             if ($CourseImageGet) {
                                 $CourseImage_3 = "/files/$CourseImageGet->hash/$CourseImageGet->name";
                             }
                             else {
                                $CourseIntroGet = DB::table('uploads')->WHERE('id', $courses[3]->intro)->first();
                                if ($CourseIntroGet) {
                                    $extensions = ['avi', 'flv', 'wmv', 'mov', 'mp4', '3gp', 'webm'];
                                    if (in_array($CourseIntroGet->extension, $extensions)) {
                                         $CourseImage_3 = "/frontend/images/Image_not.jpg";
                                    }else {
                                       $CourseImage_3 = "/files/$CourseIntroGet->hash/$CourseIntroGet->name";
                                    }
                                }else {
                                   $CourseImage_3 = "/frontend/images/Image_not.jpg";
                                }
                             }
                         ?>  
                        <img src="{{ $CourseImage_3 }}" alt="image description"></a>
      
                        
                    </div>
                    <div class="pp-post-bottim">
                      <h3 class="post-heading"><a href="/single_course/54">{{ $courses[3]->name }}</a></h3>
                        <footer class="post-foot gutter-reset">
                          <?php
                             $total_stars = $courses[3]->add_stars;
                             $unfillStarts = 5-$courses[3]->add_stars;
                             if($total_stars>0){
                                 for($j = 0; $j < $total_stars; $j++){
                                     if($j < 5){
                                    ?>
                                      <span class="fa fa-star checked"></span>
                                     <?php
                                     }
                                     
                                 }
                             }
                             
                             if($unfillStarts > 0){
                                 for($k = 0; $k < $unfillStarts; $k++){
                                     ?>
                                         <span class="far fa-star" style="color: #ffa300;"><span class="sr-only" >star</span></span>
                                     <?php
                                 }
                             }
                          ?>
                        </footer>
                    </div>
                  </article>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                  <article class="popular-post">
                    <div class="aligncenter">
                      <a href="/single_course/<?= $courses[4]->id; ?>">

                        <?php 
                             $CourseImageGet = DB::table('uploads')->WHERE('id', $courses[4]->image)->first();
                             if ($CourseImageGet) {
                                 $CourseImage_4 = "/files/$CourseImageGet->hash/$CourseImageGet->name";
                             }
                             else {
                                $CourseIntroGet = DB::table('uploads')->WHERE('id', $courses[4]->intro)->first();
                                if ($CourseIntroGet) {
                                    $extensions = ['avi', 'flv', 'wmv', 'mov', 'mp4', '3gp', 'webm'];
                                    if (in_array($CourseIntroGet->extension, $extensions)) {
                                         $CourseImage_4 = "/frontend/images/Image_not.jpg";
                                    }else {
                                       $CourseImage_4 = "/files/$CourseIntroGet->hash/$CourseIntroGet->name";
                                    }
                                }else {
                                   $CourseImage_4 = "/frontend/images/Image_not.jpg";
                                }
                             }
                         ?>  
                        <img src="{{ $CourseImage_4 }}" alt="image description">
                      </a>

                    </div>
                    <div class="pp-post-bottim">
                      <h3 class="post-heading"><a href="/single_course/54">{{ $courses[4]->name }}</a></h3>
                        <footer class="post-foot gutter-reset">
                         <?php
                            $total_stars = $courses[4]->add_stars;
                            $unfillStarts = 5-$courses[4]->add_stars;
                            if($total_stars>0){
                                for($j = 0; $j < $total_stars; $j++){
                                    if($j < 5){
                                   ?>
                                     <span class="fa fa-star checked"></span>
                                    <?php
                                    }
                                    
                                }
                            }
                            
                            if($unfillStarts > 0){
                                for($k = 0; $k < $unfillStarts; $k++){
                                    ?>
                                        <span class="far fa-star" style="color: #ffa300;"><span class="sr-only" >star</span></span>
                                    <?php
                                }
                            }
                         ?>
                        </footer>
                    </div>
                  </article>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                </div>
              </div>

            </div>
            <?php
          
        }  
        
         
    ?>


   

    @endfor
        

     {{--  <div class="item">
        <div class="row">
          <div class="col-lg-4 col-md-4 col-sm-4 col-4">
            <article class="popular-post">
              <div class="aligncenter">
                <a href="/single_course/54"><img src="/frontend/images/watch_video.jpg" alt="image description"></a>
              </div>
              <div class="pp-post-bottim">
                <h3 class="post-heading"><a href="/single_course/54">Android App Development In Tamil</a></h3>
                  <footer class="post-foot gutter-reset">
                    <ul class="star-rating list-unstyled">
                      <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                      <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                      <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                      <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                      <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                    </ul>
                  </footer>
              </div>
            </article>
            
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-4">
            <article class="popular-post">
              <div class="aligncenter">
                <a href="/single_course/54"><img src="/frontend/images/product2.png" alt="image description"></a>
              </div>
              <div class="pp-post-bottim">
                <h3 class="post-heading"><a href="/single_course/54">Android App Development In Tamil</a></h3>
                  <footer class="post-foot gutter-reset">
                    <ul class="star-rating list-unstyled">
                      <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                      <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                      <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                      <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                      <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                    </ul>
                  </footer>
              </div>
            </article>
            
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-4">
            <article class="popular-post">
              <div class="aligncenter">
                <a href="/single_course/54"><img src="/frontend/images/watch_video.jpg" alt="image description"></a>
              </div>
              <div class="pp-post-bottim">
                <h3 class="post-heading"><a href="/single_course/54">Android App Development In Tamil</a></h3>
                  <footer class="post-foot gutter-reset">
                    <ul class="star-rating list-unstyled">
                      <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                      <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                      <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                      <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                      <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                    </ul>
                  </footer>
              </div>
            </article>
            
          </div>
        </div>
        <div class="row">
          <div class="col-lg-2 col-md-2 col-sm-2 col-2">
            
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-4">
            <article class="popular-post">
              <div class="aligncenter">
                <a href="/single_course/54"><img src="/frontend/images/watch_video.jpg" alt="image description"></a>
              </div>
              <div class="pp-post-bottim">
                <h3 class="post-heading"><a href="/single_course/54">Android App Development In Tamil</a></h3>
                  <footer class="post-foot gutter-reset">
                    <ul class="star-rating list-unstyled">
                      <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                      <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                      <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                      <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                      <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                    </ul>
                  </footer>
              </div>
            </article>
            
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-4">
            <article class="popular-post">
              <div class="aligncenter">
                <a href="/single_course/54"><img src="/frontend/images/product2.png" alt="image description"></a>
              </div>
              <div class="pp-post-bottim">
                <h3 class="post-heading"><a href="/single_course/54">Android App Development In Tamil</a></h3>
                  <footer class="post-foot gutter-reset">
                    <ul class="star-rating list-unstyled">
                      <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                      <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                      <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                      <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                      <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                    </ul>
                  </footer>
              </div>
            </article>
            
          </div>
          <div class="col-lg-2 col-md-2 col-sm-2 col-2">
            
          </div>
        </div>
      </div> --}}
      

      {{-- <div class="item">
        <div class="row">
          <div class="col-lg-4 col-md-4 col-sm-4 col-4">
            <article class="popular-post">
              <div class="aligncenter">
                <a href="/single_course/54"><img src="/frontend/images/watch_video.jpg" alt="image description"></a>
              </div>
              <div class="pp-post-bottim">
                <h3 class="post-heading"><a href="/single_course/54">Android App Development In Tamil</a></h3>
                  <footer class="post-foot gutter-reset">
                    <ul class="star-rating list-unstyled">
                      <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                      <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                      <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                      <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                      <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                    </ul>
                  </footer>
              </div>
            </article>
            
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-4">
            <article class="popular-post">
              <div class="aligncenter">
                <a href="/single_course/54"><img src="/frontend/images/product2.png" alt="image description"></a>
              </div>
              <div class="pp-post-bottim">
                <h3 class="post-heading"><a href="/single_course/54">Android App Development In Tamil</a></h3>
                  <footer class="post-foot gutter-reset">
                    <ul class="star-rating list-unstyled">
                      <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                      <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                      <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                      <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                      <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                    </ul>
                  </footer>
              </div>
            </article>
            
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-4">
            <article class="popular-post">
              <div class="aligncenter">
                <a href="/single_course/54"><img src="/frontend/images/watch_video.jpg" alt="image description"></a>
              </div>
              <div class="pp-post-bottim">
                <h3 class="post-heading"><a href="/single_course/54">Android App Development In Tamil</a></h3>
                  <footer class="post-foot gutter-reset">
                    <ul class="star-rating list-unstyled">
                      <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                      <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                      <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                      <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                      <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                    </ul>
                  </footer>
              </div>
            </article>
            
          </div>
        </div>
        <div class="row">
          <div class="col-lg-2 col-md-2 col-sm-2 col-2">
            
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-4">
            <article class="popular-post">
              <div class="aligncenter">
                <a href="/single_course/54"><img src="/frontend/images/watch_video.jpg" alt="image description"></a>
              </div>
              <div class="pp-post-bottim">
                <h3 class="post-heading"><a href="/single_course/54">Android App Development In Tamil</a></h3>
                  <footer class="post-foot gutter-reset">
                    <ul class="star-rating list-unstyled">
                      <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                      <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                      <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                      <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                      <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                    </ul>
                  </footer>
              </div>
            </article>
            
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-4">
            <article class="popular-post">
              <div class="aligncenter">
                <a href="/single_course/54"><img src="/frontend/images/product2.png" alt="image description"></a>
              </div>
              <div class="pp-post-bottim">
                <h3 class="post-heading"><a href="/single_course/54">Android App Development In Tamil</a></h3>
                  <footer class="post-foot gutter-reset">
                    <ul class="star-rating list-unstyled">
                      <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                      <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                      <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                      <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                      <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                    </ul>
                  </footer>
              </div>
            </article>
            
          </div>
          <div class="col-lg-2 col-md-2 col-sm-2 col-2">
            
          </div>
        </div>
      </div> --}}

     
    </div>

    <!-- Left and right controls -->
    <div class="carousel-btn-setting">
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-menu-left"></span>
      <!-- <span class="sr-only">Previous</span> -->
    </a>
    <ol class="carousel-indicators">
      @for ($i = 0; $i < $total_slides ; $i++)
        <li data-target="#myCarousel" data-slide-to="0" class="@if ($i == 0) active @endif"></li>
         @endfor
      {{-- <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li> --}}
    </ol>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-menu-right"></span>
      <!-- <span class="sr-only">Next</span> -->
    </a>
    </div>
  </div>
</div>

      </article>

   </div>
   <footer>
     <div class="footer-text">
       <p>Frankeey | © 2019 , All Rights Reserved</p>
     </div>
   </footer>
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
    .fancybox-slide>video {
         width:50% !important;
     }
     
</style>
@stop
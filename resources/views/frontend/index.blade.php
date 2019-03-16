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
      if($coursesCount > 5){
          $total_slides = round($coursesCount/5);         
        }
    @endphp

    @for ($i = 0; $i < $total_slides ; $i++)
     
    

    <div class="item @if ($i == 0) active @endif">

      <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-4 ">
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

    </div>
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
@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')


<?php use App\Http\Controllers\Frontend\IndexController; ?>
<?php use Illuminate\Support\Collection; ?>

<main id="main" class="questions-main-bg">
   <div class="top_header">
     <div class="container">
       <div class="row">
         <div class="col-md-4 course-intro">
            <div class="Video-image-description">
               <?php 
                  $CourseIntroGet = DB::table('videos')->WHERE('id', $singleCourse->intro)->first();
                  $CourseVimeoLink = $CourseIntroGet->vimeo_link;
                  $CourseUploadVideo = $CourseIntroGet->file;

                  if(empty($CourseVimeoLink)){
                     $VideosTrimed = trim($CourseUploadVideo, '[]');
                     if ($VideosTrimed != '') {
                       if (strlen($VideosTrimed) < 7) {
                         $exploded_Videos = explode('""', $VideosTrimed);
                       } else {
                         $exploded_Videos = explode(',', $VideosTrimed);
                       }
                       $index = 0;

                       foreach ($exploded_Videos as $exploded_Video) {
                         $get_Video = DB::table('uploads')->WHERE('id', trim($exploded_Video, '""'))->first(); 
                         $CourseVideo = '/files/'.$get_Video->hash.'/'.$get_Video->name.'';
                       }
                     }
                   } else{
                      $CourseVideo = "https://vimeo.com/".$CourseVimeoLink;
                   } 
                   $CourseImageGet = DB::table('uploads')->WHERE('id', $singleCourse->image)->first();
                    if ($CourseImageGet) {
                       $CourseImage = "/files/$CourseImageGet->hash/$CourseImageGet->name";
                    } else {
                       $CourseImage = "/frontend/images/Image_not.jpg";
                    }
                ?>

              <a href="{{ $CourseVideo }}" class="btn-play far fa-play-circle lightbox fancybox.iframe"></a>
               <img src="{{ $CourseImage }}" alt="image description" class="CourseImage">     
               @section('image') <?= $CourseImage; ?>@stop
               
            </div>
         </div><!-- /.course-intro -->
         <div class="col-md-8 course-description">
          <a href="/single_course/<?= $singleCourse->id ?>"><h2>{{ $singleCourse->name }}</h2></a>
          <a href="/course_videos/<?= $singleCourse->id; ?>"><button class="btn btn-danger">Continue to Lecture</button></a>
          <div class="rating-holder">
              <ul class="star-rating list-unstyled">
                 <?php
                    $total_stars = $singleCourse->add_stars;
                    $unfillStarts = 5-$singleCourse->add_stars;
                    if($total_stars>0){
                      for($i = 0; $i < $total_stars; $i++){
                          if($i < 5){ ?>
                              <li><span class="fas fa-star"><span class="sr-only">star</span></span></li>
                          <?php }
                      }
                    }
                    if($unfillStarts > 0){
                        for($i = 0; $i < $unfillStarts; $i++) { ?>
                          <li><span class="far fa-star"><span class="sr-only">star</span></span></li>
                        <?php }
                    }
                  ?>
                <?php $CommentCount = DB::table('comments')->WHERE('course_id', $singleCourse->id)->whereNull('deleted_at')->count(); ?>
                <li><strong class="element-block text-left subtitle fw-normal">(<span class="countComment">{{ $CommentCount }}</span> Reviews)</strong></li>
              </ul>
           </div>
         </div><!-- /.course-description -->
       </div>
     </div><!-- /.container -->
   </div><!-- /.top_header -->
<!-- main-questions -->
<div class="main-questions">
  <div class="container">
    <div class="row">
      <div class="com-md-12">
        <div><h1 class="main_heading">F.A.Q</h1></div>
        <div class="question-overview--wrapper--2yUqR">
         <div class="question-overview--search-bar--3yFsJ">
            <div class="row question-overview--search--3TyVh form-group">
              <div class="col-md-9">
                <input placeholder="Search for a question" type="text" class="form-control search_questions" value="">
              </div>
              <div class="col-md-3">
                <span class="question-overview--or--WmGRo">or</span>
                <button type="button" class="btn btn-danger ask_a_question">Ask a new question</button>
              </div>
            </div>
         </div>
         <!-- <div class="question-overview--sort-and-filter--DAEYZ">
            <div class="question-overview--sort--3l41D form-group">
               <div class="form-control-single-select-container">
                  <select class="form-control sorting">
                     <option value="popularity">Sort by popular</option>
                     <option value="recency">Sort by recency</option>
                  </select>
               </div>
            </div>
            <div class="question-overview--filters--1pAEF"><label class="checkbox-inline" title=""><input data-purpose="toggle-following" type="checkbox"><span class="checkbox-label">See questions I'm following</span></label><label class="checkbox-inline" title=""><input data-purpose="toggle-unanswered" type="checkbox"><span class="checkbox-label">See questions without responses</span></label></div>
         </div> -->
       <div>
      <div class="question-list--questions--LUSO1 question-overview--question-list--KlsVt">
        <?php if (!empty($allQuestions)): ?>
          <?php foreach ($allQuestions as $key => $allQuestion): ?>
                <?php $User = DB::table('employees')->WHERE('id', $allQuestion->user_id)->first(); ?>
                <?php 
                  if ($User->image != 0) {
                      $Image = DB::table('uploads')->WHERE('id', $User->image)->first();
                        if ($Image) {
                          $UserImage = "/files/$Image->hash/$Image->name";
                        } else {
                         $UserImage = "/frontend/images/defaultImage.jpg";
                        }
                  } else {
                     $UserImage = "/frontend/images/defaultImage.jpg";
                  }
                ?>
                 <div class="question-list-question--wrapper--1zMqr question-overview--question--244jE">
                    <div class="question-list-question--question-link--iEDXQ">
                       <div>
                          <div>
                            <img alt="{{ $User->name }}" src="{{ $UserImage }}" class="user-avatar user-avatar--image img-circle">
                          </div>
                       </div>
                       <div class="question-list-question--content--SEjFC question-overview--question-content--2M-k-">
                          <div class="question-list-question--title--4K-V_"> {{ $User->name }} </div>
                          <div class="question-list-question--body--2v0oT"><a href="/answer/<?= $singleCourse->id ?>/<?= $allQuestion->id ?>">{{ $allQuestion->title }}</a></div>
                       </div>
                       <div>
                          <div class="question-list-question--num-answers--2vE_g">{{ $allQuestion->answer_count }}</div>
                          <div class="responses">Responses</div>
                       </div>
                    </div>
                 </div>
          <?php endforeach ?>
        <?php endif ?>
         
      </div>
        <?php if (empty($allQuestions)): ?>
          <div class="no_question_found">
            <h5>No questions found</h5>
            <p>Be the first to ask your question! You'll be able to add details in the next step</p>
            <img src="/frontend/images/no_question.png" alt="No Questions Found!" />
          </div>
        <?php else: ?>
          <div class="question-list--load-more--3K2un"><button type="button" class="btn btn-secondary load_more">Load more</button></div>
        <?php endif ?>
        <div class="no_question_found_append">&nbsp;</div>

   </div>
</div>
        <?php 
          $LoginUser = DB::table('employees')->WHERE('id', Auth::user()->id)->first();
          $LoginUserImage = DB::table('uploads')->WHERE('id', $LoginUser->image)->first();
          if ($LoginUserImage) {
            $LoginImage = "/files/$LoginUserImage->hash/$LoginUserImage->name";
          }else {
            $LoginImage = "/frontend/images/defaultImage.jpg";
          }
         ?>
        <div class="write_question">
          {{ Form::open(['url' => '/ask_question', 'method' => 'post', 'class' => 'post_a_question']) }}
            <h5>Have a technical issue? Our <a href="#">Support Team</a> can help.</h5>
            <input type="hidden" name="course_id" value="{{ $singleCourse->id }}">
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <input type="hidden" name="user_name" value="{{ $LoginUser->name }}">  
            <input type="hidden" name="user_image" value="{{ $LoginImage }}">  
            <input type="text" name="question_title" class="question_title form-control" required/>
            <textarea name="question_ask" id="question_ask" cols="30" rows="10" class="question_ask form-control"></textarea>
            <div><button type="submit" class="btn btn-danger btn-post-question">Post Question</button><button type="button" class="btn btn-cancel-question">Cancel</button></div>
          {{ Form::close() }}
        </div><!-- /.write_question -->
      </div><!-- /.com-md-12 -->
    </div><!-- /.row -->
  </div><!-- /.container -->
</div><!-- /.main-questions -->
</main> 
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>

   <script>
      $(document).ready(function() {

         $('#question_ask').summernote({
            placeholder: 'Type Your Question Here',
            tabsize: 2,
            height: 100
         });

         $('.ask_a_question').on('click', function(e) {
            $('.question-overview--wrapper--2yUqR').hide();
            $('.write_question').show();
         });
         
         $('.btn-cancel-question').on('click', function(e) {
            $('.question-overview--wrapper--2yUqR').show();
            $('.write_question').hide();
         });

         $('.search_questions').keyup(function(){
          var val = $(this).val().toLowerCase();
          $(".question-overview--question--244jE").hide();
          $(".question-overview--question--244jE").each(function(){
            var text = $(this).text().toLowerCase();
            if(text.indexOf(val) != -1){
              $(this).show();
              $(document).find('.no_question_found').hide();
              $('.question-list--load-more--3K2un').show();
            } else {
              console.log('testing');
            }
          });
         });

         $('.post_a_question').on('submit', function(e) {
            var $this = $(this);
            var action = $this.attr('action');
            var commentData = $this.serializeArray();
            var question_title = $('.question_title').val();
            var question_ask = $('.question_ask').val();
            if (question_title != '') {
              e.preventDefault();

              $.ajax({
                 type : 'POST',
                 url : action,
                 data: commentData,
              })
              .done(function(response){
                $('.question_title').val('');
                $('.question_ask').val('');
                $(response).prependTo('.question-overview--question-list--KlsVt');
                $('.question-overview--wrapper--2yUqR').show();
                $('.write_question').hide();
                $(document).find('.no_question_found').hide();
              });

            }
         });

         $('.load_more').on('click', function(e) {
          var offset = $('.question-list-question--wrapper--1zMqr').length;
          var data = {
            "_token": "<?= csrf_token() ?>",
            "offset": offset,
            "course_id": "<?= $singleCourse->id ?>"
          };
            $.ajax({
                 type : 'POST',
                 url : '/load_questions',
                 data: data
            })
            .done(function(response){
              $(response).appendTo('.question-overview--question-list--KlsVt');
            });

         });
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
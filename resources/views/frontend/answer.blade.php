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
<div class="main-answers">
  <div class="container">
    <div class="row">
      <div class="com-md-12">
        <div class="back_to_questions"><a href="/questions/<?= $singleCourse->id; ?>">Back to All Questions</a></div>
        <div class="question-overview--wrapper--2yUqR">
       <div>
        <?php $User = DB::table('employees')->WHERE('id', $Question->user_id)->first(); ?>
        <?php 
          if ($User->image != 0) {
              $Image = DB::table('uploads')->WHERE('id', $User->image)->first();
                if ($CourseImageGet) {
                  $UserImage = "/files/$Image->hash/$Image->name";
                } else {
                 $UserImage = "/frontend/images/defaultImage.jpg";
                }
          } else {
             $UserImage = "/frontend/images/defaultImage.jpg";
          }
          ?>
      <div class="question-list--questions--LUSO1 question-overview--question-list--KlsVt">
         <div class="question-list-question--wrapper--1zMqr question-overview--question--244jE">
            <div class="question-list-question--question-link--iEDXQ">
               <div>
                  <div>
                    <img alt="{{ $User->name }}" src="{{ $UserImage }}" class="user-avatar user-avatar--image img-circle">
                  </div>
               </div>
               <div class="question-list-question--content--SEjFC question-overview--question-content--2M-k-">
                  <div class="question-list-question--title--4K-V_"> {{ $Question->title }}</div>
                  <div class="question_user"> {{ $User->name }} <span>- {{ \Carbon\Carbon::parse($Question->created_at)->diffForHumans() }}</span></div>
               </div>
            </div>
            <div class="question_detail">{!! $Question->question !!}</div>
            <div class="all_responses">
            <!-- <div class="follow_btn"><button class="btn">Follow Responses</button></div> -->
              <div class="responses">
                <div class="question-list-question--wrapper--1zMqr question-overview--question--244jE">
                  <?php if (!empty($AllAnswers)): ?>
                    <?php foreach ($AllAnswers as $key => $AllAnswer): ?>
                      <?php $AnswersUser = DB::table('employees')->WHERE('id', $AllAnswer->user_id)->first(); ?>
                        <?php 
                          if ($AnswersUser->image != 0) {
                              $Imageusr = DB::table('uploads')->WHERE('id', $AnswersUser->image)->first();
                                if ($CourseImageGet) {
                                  $AnsUserImage = "/files/$Imageusr->hash/$Imageusr->name";
                                } else {
                                 $AnsUserImage = "/frontend/images/defaultImage.jpg";
                                }
                          } else {
                             $AnsUserImage = "/frontend/images/defaultImage.jpg";
                          }
                        ?>
                    <div class="question-list-question--question-link--iEDXQ">
                       <div>
                          <div>
                            <img alt="{{ $AnswersUser->name }}" src="{{ $AnsUserImage }}" class="user-avatar user-avatar--image img-circle">
                          </div>
                       </div>
                       <div class="question-list-question--content--SEjFC question-overview--question-content--2M-k-">
                          <div class="question_user"> {{ $User->name }} <span>- {{ \Carbon\Carbon::parse($AllAnswer->created_at)->diffForHumans() }}</span>
                          </div>
                          <div class="question-list-question--body--2v0oT">{!! $AllAnswer->answer !!}</div>
                       </div>
                    </div>
                    <?php endforeach ?>
                  <?php endif ?>

                    <div class="write_answer">
                      <div>
                          <div>
                            <img alt="{{ $User->name }}" src="{{ $UserImage }}" class="user-avatar user-avatar--image img-circle">
                          </div>
                       </div>
                       <div class="type_answer">
                          <input type="text" class="form-control write_answer_input" value="" placeholder="Add an answer" />
                       </div>
                    </div>
                    <div class="write_answer_editor">
                      {{ Form::open(['url' => '/write_answer', 'method' => 'post', 'class' => 'post_a_answer']) }}
                        <input type="hidden" name="course_id" value="{{ $singleCourse->id }}">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="question_id" value="{{ $Question->id }}">
                        <textarea name="answer_text" id="type_answer"></textarea>
                        <button type="submit" class="btn btn-danger post_answer">Add an answer</button>
                      {{ Form::close() }}
                    </div>
                 </div>
              </div><!-- /.responses -->
            </div>
         </div>
         
      </div>
   </div>
</div>
      </div><!-- /.com-md-12 -->
    </div><!-- /.row -->
  </div><!-- /.container -->
</div><!-- /.main-questions -->
</main> 
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>

   <script>
      
      $(document).ready(function() {
         $('#type_answer').summernote({
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

         $('.post_a_answer').on('submit', function(e) {
            e.preventDefault();
            var $this = $(this);
            var action = $this.attr('action');
            var commentData = $this.serializeArray();
            var answer = $('#type_answer').val();
            if (answer != '') {

              $.ajax({
                 type : 'POST',
                 url : action,
                 data: commentData,
              })
              .done(function(response){
                window.location.reload();
              });
            } else {
              alert('Write you answer!');
            }
         });

         $('.write_answer_input').on('focus', function(e) {
          $(this).parent().parent().hide();
          $('.write_answer_editor').show();
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
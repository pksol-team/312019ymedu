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
                  $extensions = ['avi', 'flv', 'wmv', 'mov', 'mp4', '3gp', 'webm'];
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
            <div class="follow_btn"><button class="btn">Follow Responses</button></div>
              <div class="responses">
                <div class="question-list-question--wrapper--1zMqr question-overview--question--244jE">

                    <div class="question-list-question--question-link--iEDXQ">
                       <div>
                          <div>
                            <img alt="{{ $User->name }}" src="{{ $UserImage }}" class="user-avatar user-avatar--image img-circle">
                          </div>
                       </div>
                       <div class="question-list-question--content--SEjFC question-overview--question-content--2M-k-">
                          <div class="question_user"> {{ $User->name }} <span>- {{ \Carbon\Carbon::parse($Question->created_at)->diffForHumans() }}</span>
                          </div>
                          <div class="question-list-question--body--2v0oT">Question->title</div>
                       </div>
                    </div>
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
                        <textarea name="answer_text" id="type_answer"></textarea>
                        <button type="button" class="btn btn-danger post_answer">Add an answer</button>
                    </div>
                 </div>
              </div><!-- /.responses -->
            </div>
         </div>
         
      </div>
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
            })
            .done(function(response){
            $(response).appendTo('.currentComment');

               var comments = parseInt($('.countComment').html());
               
               $('.countComment').html(comments+1);

               $('.cancel_btn').trigger('click');
            });
         });

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
                $(response).prependTo('.question-overview--question-list--KlsVt');
                $('.question-overview--wrapper--2yUqR').show();
                $('.write_question').hide();
                $(document).find('.no_question_found').hide();
              });

            }
         });

         $('.write_answer_input').on('focus', function(e) {
          $(this).parent().parent().hide();
          $('.write_answer_editor').show();
         });

         $('.post_answer').on('click', function(e) {
          $(this).parent().hide();
          $('.write_answer').show();
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
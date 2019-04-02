@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/all_courses') }}">All Course</a> :
@endsection
@section("contentheader_description", $all_course->$view_col)
@section("section", "All Courses")
@section("section_url", url(config('laraadmin.adminRoute') . '/all_courses'))
@section("sub_section", "Edit")

@section("htmlheader_title", "All Courses Edit : ".$all_course->$view_col)

@section("main-content")

<style>
	.cke_1 .cke_top, .cke_2 .cke_top, .cke_3 .cke_top {
	     background-color: #fff;
	    border-bottom-color: #000;
	}
	#cke_1_bottom, #cke_2_bottom, #cke_3_bottom{
		display: none;
	}
	.cke_1.cke_chrome, .cke_2.cke_chrome {
	    border-color : #000;
	}
</style>

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="box">
	<div class="box-header">
		
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				{!! Form::model($all_course, ['route' => [config('laraadmin.adminRoute') . '.all_courses.update', $all_course->id ], 'method'=>'PUT', 'id' => 'all_course-edit-form']) !!}
					{{--
					@la_form($module)
					--}}
					
					
					@la_input($module, 'name')
					<div class="error" style="color: red; display: none;">Scripting not Allowed</div>
					@la_input($module, 'category')
					{{-- @la_input($module, 'user_id') --}}
					@la_input($module, 'image')
					@la_input($module, 'videos')
					<!-- @la_input($module, 'favourite') -->
					@la_input($module, 'status')
					@la_input($module, 'intro')
					@la_input($module, 'price')
					@la_input($module, 'description', '', '', 'form-control summernote_description')
					@la_input($module, 'no_of_section')
					@la_input($module, 'content', '', '', 'form-control summernote_content')
					@la_input($module, 'what_learn', '', '', 'form-control summernote_what_learn')
					@la_input($module, 'purchased_by')
					@la_input($module, 'select_curriculum')
					@la_input($module, 'sidebar')
					@la_input($module, 'demo_video')
					@la_input($module, 'tag', '', '', 'tags form-control')
					@la_input($module, 'course_duration')
					@la_input($module, 'students')
					@la_input($module, 'add_stars')
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success submitBtn']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/all_courses') }}">Cancel</a></button>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>

@endsection

@push('scripts')


<script>
$(function () {
    
    
    $("input[name='name']").keypress(function(){
		var name = $("input[name='name']").val();
		
		if(name.search("<script") < 0){
			$(".error").hide();
			$(".submitBtn").show();
		}else{
			$(".submitBtn").hide();
			$(".error").show();
		}


	 });

	 
	 
// 	$("#all_course-edit-form").validate({
		
// 	});

    $('.summernote_description, .summernote_content, .summernote_what_learn').summernote();
});

	 $("input.tags").attr("data-role", "tagsinput");
</script>
<script src="{{ asset('la-assets/js/tagsinput.js') }}"></script>
@endpush

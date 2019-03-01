<?php use App\Http\Controllers\LA\All_CoursesController; ?>
@extends("la.layouts.app")
@section("contentheader_title", "All Courses")
@section("contentheader_description", "All Courses listing")
@section("section", "All Courses")
@section("sub_section", "Listing")
@section("htmlheader_title", "All Courses Listing")

@section("headerElems")
@la_access("All_Courses", "create")
	<!--<button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#AddModal">Add All Course</button>-->
	<button class="btn btn-success btn-sm pull-right courseBtn">Add All Course</button>
@endla_access
@endsection

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

<div class="box box-success">
	<!--<div class="box-header"></div>-->
	<div class="box-body">
		<table id="example1" class="table table-bordered">
		<thead>
		<tr class="success">
			@foreach( $listing_cols as $col )
			<th>{{ $module->fields[$col]['label'] or ucfirst($col) }}</th>
			@endforeach
			@if($show_actions)
			<th>Actions</th>
			@endif
		</tr>
		</thead>
		<tbody>
			
		</tbody>
		</table>
	</div>
</div>

@la_access("All_Courses", "create")
<div class="addCourse" style="display:none;">
<!--<div class="modal fade" id="AddModal" role="dialog" aria-labelledby="myModalLabel">-->
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Add All Course</h4>
			</div>
			{!! Form::open(['action' => 'LA\All_CoursesController@store', 'id' => 'all_course-add-form']) !!}
			<div class="modal-body">
				<div class="box-body">
					{{--
	                    @la_form($module)
					--}}
					@la_input($module, 'name')
					<div class="error" style="color: red; display: none;">Scripting not Allowed</div>
					@la_input($module, 'category')
					
					{{-- @la_input($module, 'user_id') --}}

					<input type="hidden" class="userID" name="user_id" value="{{ Auth::user()->id }}">

					@la_input($module, 'image')
					@la_input($module, 'videos')
					
					@la_input($module, 'favourite')
					
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
					<div class="form-group">
						<label for="tag">Tags :</label>
						<input data-role="tagsinput" class="form-control" placeholder="Enter Tags" data-rule-minlength="1" data-rule-maxlength="256" name="tag" type="text" value="">
					</div>
					@la_input($module, 'course_duration')
					@la_input($module, 'students')
					@la_input($module, 'add_stars')
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default close" data-dismiss="modal">Close</button>
				{!! Form::submit( 'Submit', ['class'=>'btn btn-success submitBtn']) !!}
			</div>
			{!! Form::close() !!}
		</div>
	</div>
	</div>
<!--</div>-->
@endla_access

@endsection

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('la-assets/plugins/datatables/datatables.min.css') }}"/>
@endpush

@push('scripts')
<script src="{{ asset('la-assets/plugins/datatables/datatables.min.js') }}"></script>


<script src="{{ asset('la-assets/js/tagsinput.js') }}"></script>    


<script>
$(function () {
    $('.courseBtn').click(function(){
        $(".box").hide();
        $(".addCourse").show();
    });
    $('.close').click(function(){
        $(".box").show();
        $(".addCourse").hide();
    });
    
	$("#example1").DataTable({
		processing: true,
        serverSide: true,
        ajax: "{{ url(config('laraadmin.adminRoute') . '/all_course_dt_ajax') }}",
		language: {
			lengthMenu: "_MENU_",
			search: "_INPUT_",
			searchPlaceholder: "Search"
		},
		@if($show_actions)
		columnDefs: [ { orderable: false, targets: [-1] }],
		@endif
	});
	$("#all_course-add-form").validate({
		
	});
    $('.summernote_description, .summernote_content, .summernote_what_learn').summernote();
	// CKEDITOR.replace( 'description' );
	// CKEDITOR.replace( 'content' );
	// CKEDITOR.replace( 'what_learn' );

	
	
	
	
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
});
</script>
@endpush

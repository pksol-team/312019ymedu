@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/videos') }}">Video</a> :
@endsection
@section("contentheader_description", $video->$view_col)
@section("section", "Videos")
@section("section_url", url(config('laraadmin.adminRoute') . '/videos'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Videos Edit : ".$video->$view_col)

@section("main-content")

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
				{!! Form::model($video, ['route' => [config('laraadmin.adminRoute') . '.videos.update', $video->id ], 'method'=>'PUT', 'id' => 'video-edit-form']) !!}
					{{-- @la_form($module) --}}
					
					
					@la_input($module, 'title')
					@la_input($module, 'description', '', '', 'form-control summernote_description')
					@la_input($module, 'video_option')

					<div class="vimeo" style="display: none;">
						
						@la_input($module, 'vimeo_link')						
					
					</div>
					
					<div class="file" style="display: none;">
					
						@la_input($module, 'file')
					
					</div>

					
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/videos') }}">Cancel</a></button>
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
	$("#video-edit-form").validate({
		
	});
	$('.summernote_description').summernote();	
});

$(document).ready(function() {
	var vimeoValue = $("input[name='vimeo_link']").val();	
	var uploadValue = $("a.uploaded_file").attr('href');
	if(vimeoValue == 0){
		$('div.file').show();	
		$('div.vimeo').hide();	
	}else{
		$('div.vimeo').show();
		$('div.file').hide();
	}	
	
	$('select.select2-hidden-accessible').change(function(e) {
		var selectedValue = $(this).val();
		if(selectedValue == 'vimeo'){
			$('div.vimeo').show();
			$('div.file').hide();	
		}
		else if(selectedValue == 'file'){
			$('div.file').show();	
			$('div.vimeo').hide();
		}
	});

	$('input.btnSubmit').on('click',function(e){

		var selected = $('select.select2-hidden-accessible').val();
		console.log(selected);
		if(selected == 'vimeo'){
			$('input[name="file"]').attr('value','0');
		}else
			$('input[name="vimeo_link"]').attr('value','0');
		

	});

	});



</script>
@endpush

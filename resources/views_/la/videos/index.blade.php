@extends("la.layouts.app")

@section("contentheader_title", "Videos")
@section("contentheader_description", "Videos listing")
@section("section", "Videos")
@section("sub_section", "Listing")
@section("htmlheader_title", "Videos Listing")

@section("headerElems")
@la_access("Videos", "create")
	<button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#AddModal">Add Video</button>
@endla_access
@endsection

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

@la_access("Videos", "create")
<div class="modal fade" id="AddModal" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Add Video</h4>
			</div>
			{!! Form::open(['action' => 'LA\VideosController@store', 'id' => 'video-add-form']) !!}
			<div class="modal-body">
				<div class="box-body">
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
						
					<input class="form-control" name="instructor" type="hidden" value="{{ Auth::user()->id }}">
					
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				{!! Form::submit( 'Submit', ['class'=>'btn btn-success']) !!}
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endla_access

@endsection

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('la-assets/plugins/datatables/datatables.min.css') }}"/>
@endpush

@push('scripts')
<script src="{{ asset('la-assets/plugins/datatables/datatables.min.js') }}"></script>
<script>
$(function () {
	$("#example1").DataTable({
		processing: true,
        serverSide: true,
        ajax: "{{ url(config('laraadmin.adminRoute') . '/video_dt_ajax') }}",
		language: {
			lengthMenu: "_MENU_",
			search: "_INPUT_",
			searchPlaceholder: "Search"
		},
		@if($show_actions)
		columnDefs: [ { orderable: false, targets: [-1] }],
		@endif
	});
	$("#video-add-form").validate({
		
	});
});


$('.summernote_description').summernote();	
$(document).ready(function() {
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

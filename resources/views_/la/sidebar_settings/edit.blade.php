@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/sidebar_settings') }}">Sidebar Setting</a> 
@endsection


<!--@section("htmlheader_title", "Sidebar Settings Edit : ".$sidebar_setting->$view_col)-->

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
				{!! Form::model($sidebar_setting, ['route' => [config('laraadmin.adminRoute') . '.sidebar_settings.update', $sidebar_setting->id ], 'method'=>'PUT', 'id' => 'sidebar_setting-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'course_intro')
					@la_input($module, 'popular_courses')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/sidebar_settings') }}">Cancel</a></button>
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
	$("#sidebar_setting-edit-form").validate({
		
	});
});
</script>
@endpush

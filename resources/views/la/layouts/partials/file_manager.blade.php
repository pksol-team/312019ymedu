<script src="{{ asset('la-assets/plugins/dropzone/dropzone.js') }}"></script>

<style>
	.btn-media {
	    margin: 6px 0 0px 10px;
	}
</style>
<div class="modal fade" id="fm" role="dialog" aria-labelledby="fileManagerLabel">
	<input type="hidden" id="image_selecter_origin" value="">
	<input type="hidden" id="image_selecter_origin_type" value="">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="fileManagerLabel">Select File</h4>
			</div>
			<div class="modal-body p0">
				<div class="row">
					<div class="col-xs-1 col-sm-1 col-md-1">
						<div class="fm_folder_selector ss" style="display: none;">
							<form action="{{ url(config('laraadmin.adminRoute') . '/upload_files')}}" id="fm_dropzone" enctype="multipart/form-data" method="POST">
								{{ csrf_field() }}
								<div class="dz-message"><i class="fa fa-cloud-upload"></i><br>Drop files here to upload</div>
								
								@if(!config('laraadmin.uploads.private_uploads'))
								@endif
							</form>
						</div>
					</div>
					<div class="col-xs-11 col-sm-11 col-md-11 pl0">
						<div class="nav">
							<div class="row">
								<div class="col-xs-2 col-sm-7 col-md-7">
									<a class="btn btn-default btn-xs btn-media" target="_blank" href="/admin/uploads">Go To Media Library</a>
								</div>
								<div class="col-xs-10 col-sm-5 col-md-5">
									<input type="search" class="form-control pull-right" placeholder="Search file name">
								</div>
							</div>
						</div>
						<div class="fm_file_selector">
							<ul>
								
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@extends("la.layouts.app")

@section("contentheader_title", "Uploads")
@section("contentheader_description", "Uploaded images & files")
@section("section", "Uploads")
@section("sub_section", "Listing")
@section("htmlheader_title", "Uploaded images & files")

@section("headerElems")
@la_access("Uploads", "create")
	<button id="AddNewUploads" class="btn btn-success btn-sm pull-right">Add New</button>
@endla_access
@endsection

@section("main-content")

<style type="text/css" media="screen">
    [name="public"] {
        visibility: hidden;
    }
    .cke_1 .cke_top {
        background-color: #fff;
    }
    .cke_1 .cke_bottom {
        display: none;
    }
    #EditFileModal .file-info-form {
        height: auto;
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

<form action="{{ url(config('laraadmin.adminRoute') . '/upload_files') }}" id="fm_dropzone_main" enctype="multipart/form-data" method="POST">
    {{ csrf_field() }}
    <a id="closeDZ1"><i class="fa fa-times"></i></a>
    <div class="dz-message"><i class="fa fa-cloud-upload"></i><br>Drop files here to upload</div>
</form>

<div class="box box-success">
	<!--<div class="box-header"></div>-->
	<div class="box-body">
		<ul class="files_container">

        </ul>
	</div>
</div>


<div class="modal fade" id="EditFileModal" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document" style="width:90%;">
		<div class="modal-content">
			<div class="modal-header">
				
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
                <!--<button type="button" class="next"><i class="fa fa-chevron-right"></i></button>
                <button type="button" class="prev"><i class="fa fa-chevron-left"></i></button>-->
				<h4 class="modal-title" id="myModalLabel">File: </h4>
			</div>
			<div class="modal-body p0">
                    <div class="row m0">
                        <div class="col-xs-8 col-sm-8 col-md-8">
                            <div class="fileObject">
                                
                            </div>
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4">
                            {!! Form::open(['class' => 'file-info-form']) !!}
                                <input type="hidden" name="file_id" value="0">
                                <div class="form-group">
                                    <label for="filename">File Name</label>
                                    <input class="form-control" placeholder="File Name" name="filename" type="text" @if(!config('laraadmin.uploads.allow_filename_change') || !Module::hasFieldAccess("Uploads", "name", "write")) readonly @endif value="">
                                </div>
                                <div class="form-group">
                                    <label for="url">URL</label>
                                    <input class="form-control" placeholder="URL" name="url" type="text" readonly value="">
                                </div>
                                @if(!config('laraadmin.uploads.private_uploads'))
                                    {{ Form::checkbox("public", "public", true, []) }}
                                        <div>
                                            <a class="btn btn-success" id="downFileBtn" href="">Download</a>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Save and Close</button>
                                        </div>
                                    </div>
                                @endif
                            {!! Form::close() !!}
                        </div>
                    </div><!--.row-->
			</div>
			{{-- <div class="modal-footer">
				<a class="btn btn-success" id="downFileBtn" href="">Download</a>
				@la_access("Uploads", "delete")
                <button type="button" class="btn btn-danger" id="delFileBtn">Delete</button>
				@endla_access
                <button type="button" class="btn btn-default" data-dismiss="modal">Save and Close</button>
			</div> --}}
		</div>
	</div>
</div>

@endsection

@push('styles')

@endpush

@push('scripts')
<script>
var bsurl = $('body').attr("bsurl");
var fm_dropzone_main = null;
var cntFiles = null;
$(function () {
	@la_access("Uploads", "create")
	fm_dropzone_main = new Dropzone("#fm_dropzone_main", {
        maxFilesize: 500,
        acceptedFiles: "image/*,application/pdf, .mp4, video/* ",
        maxFiles:1,
        init: function() {
            this.on("complete", function(file) {
                this.removeFile(file);
            });
            this.on("success", function(file) {
                console.log("addedfile");
                console.log(file);
                loadUploadedFiles('open');
            });
        }
    });

    $("#fm_dropzone_main").slideUp();
    $("#AddNewUploads").on("click", function() {
        $("#fm_dropzone_main").slideDown();
    });
    $("#closeDZ1").on("click", function() {
        $("#fm_dropzone_main").slideUp();
    });
	@endla_access
	
    $("body").on("click", "ul.files_container .fm_file_sel", function() {
        var upload = $(this).attr("upload");
        upload = JSON.parse(upload);

        $("#EditFileModal .modal-title").html("File: "+upload.name);
        $(".file-info-form input[name=file_id]").val(upload.id);
        $(".file-info-form input[name=filename]").val(upload.name);
        $(".file-info-form input[name=url]").val(bsurl+'/files/'+upload.hash+'/'+upload.name);
        

        var datadesc = upload.description,
            decodedesc;
        if (datadesc == '' || datadesc == null) {
            decodedesc = datadesc;
        } else {
            decodedesc = atob(datadesc);
        }

        $("#EditFileModal #downFileBtn").attr("href", bsurl+'/files/'+upload.hash+'/'+upload.name+"?download");
        

        @if(!config('laraadmin.uploads.private_uploads'))
        if(upload.public == "1") {
            $(".file-info-form input[name=public]").attr("checked", !0);
            $(".file-info-form input[name=public]").next().removeClass("On").addClass("Off");
        } else {
            $(".file-info-form input[name=public]").attr("checked", !1);
            $(".file-info-form input[name=public]").next().removeClass("Off").addClass("On");
        }
        @endif

        $("#EditFileModal .fileObject").empty();
        if($.inArray(upload.extension, ["jpg", "jpeg", "png", "gif", "bmp", "mp4", "3gp"]) > -1) {
            $("#EditFileModal .fileObject").append('<img src="'+bsurl+'/files/'+upload.hash+'/'+upload.name+'">');
            $("#EditFileModal .fileObject").css("padding", "15px 0px");
        } else {
            switch (upload.extension) {
                case "pdf":
                    // TODO: Object PDF
                    $("#EditFileModal .fileObject").append('<object width="100%" height="325" data="'+bsurl+'/files/'+upload.hash+'/'+upload.name+'"></object>');
                    $("#EditFileModal .fileObject").css("padding", "0px");
                    break;
                default:
                    $("#EditFileModal .fileObject").append('<i class="fa fa-file-text-o"></i>');
                    $("#EditFileModal .fileObject").css("padding", "15px 0px");
                    break;
            }
        }
        $("#EditFileModal").modal('show');
    });
    @if(!config('laraadmin.uploads.private_uploads') && Module::hasFieldAccess("Uploads", "public", "write"))
    $('#EditFileModal .Switch.Ajax').click(function() {
        $.ajax({
            url: "{{ url(config('laraadmin.adminRoute') . '/uploads_update_public') }}",
            method: 'POST',
            data: $("form.file-info-form").serialize(),
            success: function( data ) {
                console.log(data);
                loadUploadedFiles();
            }
        });
        
    });
    @endif

    @if(config('laraadmin.uploads.allow_filename_change') && Module::hasFieldAccess("Uploads", "name", "write"))
    $(".file-info-form input[name=filename]").on("blur", function() {
        // TODO: Change Filename
        $.ajax({
            url: "{{ url(config('laraadmin.adminRoute') . '/uploads_update_filename') }}",
            method: 'POST',
            data: $("form.file-info-form").serialize(),
            success: function( data ) {
                console.log(data);
                loadUploadedFiles();
            }
        });
    });
    @endif

	@la_access("Uploads", "delete")
    $("#EditFileModal #delFileBtn").on("click", function() {
        if(confirm("Delete image "+$(".file-info-form input[name=filename]").val()+" ?")) {
            $.ajax({
                url: "{{ url(config('laraadmin.adminRoute') . '/uploads_delete_file') }}",
                method: 'POST',
                data: $("form.file-info-form").serialize(),
                success: function( data ) {
                    console.log(data);
                    loadUploadedFiles();
                    $("#EditFileModal").modal('hide');
                }
            });
        }
    });
	@endla_access
	
    loadUploadedFiles();
});
function loadUploadedFiles(open = false) {
    // load folder files
    $.ajax({
        dataType: 'json',
        url: "{{ url(config('laraadmin.adminRoute') . '/uploaded_files') }}",
        success: function ( json ) {
            console.log(json);
            cntFiles = json.uploads;
            $("ul.files_container").empty();
            if(cntFiles.length) {
                for (var index = 0; index < cntFiles.length; index++) {
                    var element = cntFiles[index];
                    var li = formatFile(element);
                    $("ul.files_container").append(li);
                }
                if(open == 'open') {
                   $("ul.files_container").find('li').last().children('a').trigger('click');
                }
            } else {
                $("ul.files_container").html("<div class='text-center text-danger' style='margin-top:40px;'>No Files</div>");
            }
        }
    });
}
function formatFile(upload) {
    var image = '';
    if($.inArray(upload.extension, ["jpg", "jpeg", "png", "gif", "bmp", "mp4", "3gp"]) > -1) {
        image = '<img src="'+bsurl+'/files/'+upload.hash+'/'+upload.name+'?s=130">';
    } else {
        switch (upload.extension) {
            case "pdf":
                image = '<i class="fa fa-file-pdf-o"></i>';
                break;
            default:
                image = '<i class="fa fa-file-text-o"></i>';
                break;
        }
    }
    return '<li><a class="fm_file_sel" data-toggle="tooltip" data-placement="top" title="'+upload.name+'" upload=\''+JSON.stringify(upload)+'\'>'+image+'</a></li>';
}
</script>
@endpush
@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')

<?php use App\Http\Controllers\Frontend\IndexController; ?>
<?php use Illuminate\Support\Collection; ?>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>


<div id="html-content-holder">

	<div class="certificate-top">

		<img src="/frontend/certificate/top.jpg">
		
	</div>
	<?php
		$getCourse = DB::table('all_courses')->WHERE('id', $courseID )->first();
	?>
	<div class="certificate-section">

		<center>
			<h1>{{ Auth::user()->name }}</h1>
			<h3>{{ $getCourse->name }}</h3>
		</center>
		<img src="/frontend/certificate/stamp.jpg" >
			
	</div>


	<div class="certificate-bottom">
		<div class="date">
			<h2>{{ date('d/m/Y') }}</h2>
			<img src="{{ asset('frontend/certificate/uderline.jpg') }}">
		</div>
		
		<div class="signature">
			<img src="{{ asset('frontend/certificate/signature.jpg') }}" class="sign">
			<img src="{{ asset('frontend/certificate/uderline.jpg') }}">
		</div>
		
		<div class="bottom">
			<img src="/frontend/certificate/bottom.jpg">		
		</div>
		
	</div>

</div>

<a class="btn-Convert-Html2Image" href="#">Download</a>

<script>
	$(document).ready(function() {	
	
	var element = $("#html-content-holder"); // global variable
	var getCanvas; // global variable
	    	
	         html2canvas(element, {
	         onrendered: function (canvas) {
	                getCanvas = canvas;
			        var imgageData = getCanvas.toDataURL("image/png");
			        var newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");
			        $(".btn-Convert-Html2Image").attr("download", "Certificate.png").attr("href", newData);
	             }
	        });	
	});

</script>
@stop

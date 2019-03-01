@extends("la.layouts.app")

@section("contentheader_title", "Frontend Users")
@section("contentheader_description", "listing")
@section("section", "Frontend Users")
@section("sub_section", "Listing")
@section("htmlheader_title", "Listing")

@section("headerElems")

@endsection

@section("main-content")

<div class="box box-success">
	<!--<div class="box-header"></div>-->
	<div class="box-body">
		<table id="example1" class="table table-bordered">
		<thead>
		<tr class="success">
			<!-- <th>ID</th> -->
			<th>Name</th>
			<th>Email</th>
			<th>Status</th>
			<!-- <th>Email Verified</th> -->
		</tr>
		</thead>
		<tbody>
		<?php foreach ($AllUsers as $key => $AllUser): ?>
		<tr>
			<!-- <td><?= $AllUser->id ?></td> -->
			<td><?= $AllUser->name ?></td>
			<td><?= $AllUser->email ?></td>
			<td><?php echo ($AllUser->status == 'active') ? '<a href="/admin/user_listing/status/'.$AllUser->id.'" class="btn btn-info">Click to Deactive</a>' : '<a href="/admin/user_listing/status/'.$AllUser->id.'" class="btn btn-danger">Click to Active</a>' ; ?></td>
			<!-- <td style="text-align: center;"><?php //echo ($AllUser->hash_key == Null) ? '<i style="font-size:18px; color:green;" class="fa fa-check" aria-hidden="true"></i>' : '<i class="fa fa-times" aria-hidden="true" style="font-size:18px; color:#f55753;"></i>' ; ?></td> -->
		</tr>	
		<?php endforeach ?>
		</tbody>
		</table>
	</div>
</div>

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
		"ordering": false,
		language: {
			lengthMenu: "_MENU_",
			search: "_INPUT_",
			searchPlaceholder: "Search"
		}
	});
});
</script>
@endpush
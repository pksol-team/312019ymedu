@if(!isset($no_padding))
<footer class="main-footer">
    <div class="pull-right hidden-xs">
        Developed by <a href="http://www.pksol.com">PK SOL</a>
    </div>
    <strong>Copyright &copy; 2018
</footer>
@endif

<?php $UserId = Auth::user()->id;

	$RoleTable = DB::table('role_user')->WHERE('user_id', $UserId)->first();
	if ($RoleTable->role_id == 2) { ?>
		@push('scripts')
		<script>
			$('.sidebar-menu li:nth-child(10)').css('display', 'none');
			$('.sidebar-menu li:nth-child(2)').css('display', 'none');
			$('.sidebar-menu li:nth-child(3)').css('display', 'none');
		</script>
		@endpush
<?php } ?>
@push('scripts')
<script>
    $('.sidebar-menu li:nth-child(7) a').attr('href', "/admin/sidebar_settings/1/edit");
	$('.sidebar-menu li:nth-child(11) a span').text('Instructors');
</script>
@endpush
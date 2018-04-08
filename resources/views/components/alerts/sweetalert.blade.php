<script type="text/javascript">
	$(function(){
		swal(
		  '{{ $title }}',
		  '{{ session('Error') }}',
		  'error'
		)
	})
</script>
@if(session('status'))
<script type="text/javascript">
	$(function(){
		swal(
		  '{{ session('header') }}',
		  '{{ session('msg') }}',
		  '{{ session('status') }}'
		)
	})
</script>
@endif
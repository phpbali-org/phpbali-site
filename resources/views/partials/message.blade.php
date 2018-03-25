@if (session('status'))
    <script type="text/javascript">
    	$(function(){
    		swal(
			  '{{ session('header') }}',
			  '{{ session('status') }}',
			  'success'
			)
    	})
    </script>
@endif
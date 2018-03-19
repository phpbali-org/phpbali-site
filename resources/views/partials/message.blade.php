@if (session('status'))
    <script type="text/javascript">
    	$(function(){
    		swal(
			  'Good job!',
			  '{{ session('status') }}',
			  'success'
			)
    	})
    </script>
@endif
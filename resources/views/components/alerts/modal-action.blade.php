<div class="modal fade" id="modal-action" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      	<div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        	<h4 class="modal-title">Konfirmasi</h4>
      	</div>
	  	<div class="modal-body">
	  		{{ $slot }}
	  	</div>
	  	<div class="modal-footer">
	    	<button type="button" class="btn btn-danger" data-dismiss="modal">Tidak</button>
	    	<a role="button" class="btn btn-success btn-ok">Iya</a>
	  	</div>
    </div>
  </div>
</div>
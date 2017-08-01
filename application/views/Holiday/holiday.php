<div class="modal fade" id="addLiburModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title" id="myModalLabel">Add Holiday</h4>
          	</div>
        	<form class="form-horizontal" action="<?php echo site_url('Holiday_C/create_liburan/') ?>" method="POST" role="form">
          		<div class="modal-body ">
              		<div class="form-group">
                		<div class="col-sm-12">
                  			<input type="date" class="form-control" name="c_tanggal">
                		</div>
              		</div>
              		<div class="form-group">
                		<div class="col-sm-12">
                  			<input type="text" class="form-control" name="c_detail" placeholder="detail">
                		</div>
              		</div>
	          	</div>
	          	<div class="modal-footer">
	            	<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
	            	<button type="submit" class="btn btn-primary">Submit</button>
	          	</div>
        	</form>
        </div>
    </div>
</div>


<div class="modal fade" id="deleteLiburModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title" id="myModalLabel">Delete Holiday</h4>
          	</div>
          		<div class="modal-body ">
              		Are you sure?
	          	</div>
	          	<div class="modal-footer">
	            	<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
	            	<a class="btn btn-primary" id="btn-ok">OK</a>
	          	</div>
        </div>
    </div>
</div>

<script type="text/javascript">
$('#deleteLiburModal').on('show.bs.modal', function(e) {
    $(this).find('#btn-ok').attr('href', $(e.relatedTarget).data('href'));
});
</script>

<script type="text/javascript">
$(document).ready(function() {
    $('#examplh').DataTable({
    	
    	"columnDefs": [
	        { "width": "50px", "targets": 3 },
	        { "width": "5px", "targets": 0 }
	    ],
    });

} );
</script>

<div class="container">
	<ol class="breadcrumb">
	  <li class='active'>Holiday</li>
	</ol>
	<div class="row">
		<div class="col-xs-12 text-right">
			<button type="button" class="btn btn-success" data-toggle="modal" data-target="#addLiburModal">Add Libur</button>
		</div>
		<div class="col-xs-12">
		<br>
			<?=$this->session->flashdata("notifikasi_libur")?>	
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped" id="examplh">
					<thead>
						<tr>
							<th>id</th>
							<th>tanggal</th>
							<th>perihal</th>
							<th>action</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($liburan as $key) { ?>
						<tr>
							<td><?=$key->id_libur?></td>
							<td><?=$key->tanggal?></td>
							<td><?=$key->detail?></td>
							<td>
							<?php
								echo "<div class='text-center'><a data-href='".base_url()."Holiday_C/delete_liburan/".$key->id_libur."' data-toggle='modal' data-target='#deleteLiburModal' class='btn btn-xs btn-primary'><span class='glyphicon glyphicon-trash'></span></a>
                        		<a href='".base_url()."Holiday_C/update_liburan/".$key->id_libur."'  class='btn btn-xs btn-primary'><span class='glyphicon glyphicon-edit'></span></a></div>";
                        	?>
                        </td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

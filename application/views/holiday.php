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

<div class="container">
	<ol class="breadcrumb">
	  <li class='active'>Holiday</li>
	</ol>
	<div class="row">
		<div class="col-xs-12 text-right">
			<button type="button" class="btn btn-success" data-toggle="modal" data-target="#addLiburModal">Add Libur</button>
		</div>
		<div class="col-xs-12">
			<?=$this->session->flashdata("notifikasi_libur")?>	
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="table-responsive">
				<table class="table table-condensed">
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
								echo "<a href='".base_url()."Holiday_C/delete_liburan/".$key->id_libur."'><span class='glyphicon glyphicon-trash'></span></a>
                        		<a href='".base_url()."Holiday_C/update_liburan/".$key->id_libur."'><span class='glyphicon glyphicon-edit'></span></a>";
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
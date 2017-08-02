<div class="container" >
	<ol class="breadcrumb">
	  <li class='active'>Status</li>
	</ol>
	<div class="row">
		<!-- <div class="col-xs-12 text-right">
			<button type="button" class="btn btn-success" data-toggle="modal" data-target="#addStatusModal">Add status</button>
		</div> 
    <div class="modal fade" id="addStatusModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Status</h4>
              </div>
              <form class="form-horizontal" action="<?php echo base_url();?>Status_C/create_status" method="POST" enctype="multipart/form-data">
                <div class="modal-body ">
                    <div class="form-group">
                      <div class="col-sm-12">
                          <input type="text" class="form-control" placeholder="Nama Status" name="c_status" >
                      </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
      </div>
  </div>
    -->

		<div class="col-sm-12"><br>
  			<?=$this->session->flashdata("alert_update_info");?>
	        <?=$this->session->flashdata("alert_create_status");?>
	        <?=$this->session->flashdata("alert_delete_status");?>
	  	</div>
	</div>
</div>


<script type="text/javascript">
$(document).ready(function() {
    $('#exampls').DataTable({
      paging: false,
      "columnDefs": [
        { "width": "50px", "targets": 3 },
        { "width": "80px", "targets": 1 },
        { "width": "5px", "targets": 0 }
      ]
    });
} );
</script>
<br>

<div class="modal fade" id="deleteStatusModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Delete Jabatan</h4>
            </div>
              <div class="modal-body ">
                  Are you sure?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <a class="btn btn-primary" id="delete_status">OK</a>
              </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$('#deleteStatusModal').on('show.bs.modal', function(e) {
    $(this).find('#delete_status').attr('href', $(e.relatedTarget).data('href'));
});
</script>
<div class="container">
	<div class="table-responsive">
  		<table class="table  table-striped" id="exampls">
  			<thead>
        		<tr>
	            	<th>id</th>
                <th>Nama status</th>
	            	<th>Info status</th>
	            	<th class="text-center">Action</th>
            	</tr>
        	</thead>
	        <tbody>
	        	<?php foreach ($statuss->result() as $row) {
	        		echo "<tr>";
	        		echo "<td>".$row->id_s."</td>";
              echo "<td>".$row->keterangan_s."</td>";
	        		echo "<td>".$row->info_s."</td>";
	        		echo "<td> 
	        				<div class='btn-group'>
		        				
		                        <a title='edit' href='".base_url()."Status_C/update_status/".$row->id_s."' class='btn btn-xs btn-primary'><span class='glyphicon glyphicon-edit'></span></a>
		                        <a title='list absen per status' href='".base_url()."Overview_C/detail_per_status/".$row->id_s."' class='btn btn-xs btn-primary'><span class='glyphicon glyphicon-th'></span></a>
	                        </div>
	                         </td>";
	        		echo "</tr>";
	        	}
	        	?>
	        </tbody>
  		</table>
	</div>
</div>

<br>
<!-- <a title='delete' data-href='".base_url()."Status_C/delete_status/".$row->id_s."' data-toggle='modal' data-target='#deleteStatusModal' class='btn btn-xs btn-primary'><span class='glyphicon glyphicon-trash'></span></a> -->
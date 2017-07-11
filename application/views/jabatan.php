<div class="container" >
  <ol class="breadcrumb">
    <li class="active">jabatan</li>
  </ol>
	<div class="row">
		<div class="col-xs-12 text-right">
			<button type="button" class="btn btn-success" data-toggle="modal" data-target="#addJabatanModal">Add Jabatan</button>
		</div>
    <div class="col-sm-12">
    <br>
	  		<?=$this->session->flashdata("alert_create_jabatan")?>
        <?=$this->session->flashdata("alert_update_info");?>
        <?=$this->session->flashdata("alert_delete_jabatan");?>
          
	  	</div>
	</div>
</div>
<div class="modal fade" id="deleteJabatanModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                <a class="btn btn-primary" id="delete_jabatan">OK</a>
              </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$('#deleteJabatanModal').on('show.bs.modal', function(e) {
    $(this).find('#delete_jabatan').attr('href', $(e.relatedTarget).data('href'));
});
</script>


<div class="modal fade" id="addJabatanModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Add Jabatan</h4>
          </div>
          <form class="form-horizontal" action="<?php echo base_url();?>Jabatan_C/create_jabatan" method="POST" enctype="multipart/form-data">
            <div class="modal-body ">
                <div class="form-group">
                  <div class="col-sm-12">
                    <input type="text" class="form-control" placeholder="Jabatan" name="c_jabatan" value="<?php echo set_value('c_jabatan'); ?>">
                  </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
    </div>
</div>
<br>
<script type="text/javascript">
$(document).ready(function() {
    $('#examplj').DataTable({
      paging: false,
      "columnDefs": [
        { "width": "50px", "targets": 2 },
        { "width": "5px", "targets": 0 }
      ]
    });

} );
</script>

<div class="container">
  <div class="table-responsive">
  	<table class="table  table-striped" id="examplj">
  		<thead>
        	<tr>
            	<th>id</th>
            	<th>Nama</th>
            	<th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
        	<?php foreach ($jabatans as $row) {
        		echo "<tr>";
        		echo "<td>".$row->id_j."</td>";
        		echo "<td>".$row->jabatan."</td>";
        		echo "<td> <div class='btn-group'>
        				<a data-href='".base_url()."Jabatan_C/delete_jabatan/".$row->id_j."'  data-toggle='modal' data-target='#deleteJabatanModal' class='btn btn-xs btn-primary'><span class='glyphicon glyphicon-trash'></span></a>
                <a href='".base_url()."Jabatan_C/update_jabatan/".$row->id_j."' class='btn btn-xs btn-primary'><span class='glyphicon glyphicon-edit'></span></a></div> </td>";
        		echo "</tr>";
        	}
        	?>
        </tbody>
  	</table>
</div>
</div>
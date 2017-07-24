<script type="text/javascript">
$(document).ready(function() {
    $('#examplp').DataTable({
    	paging: false,
    	"columnDefs": [
	        { "width": "5px", "targets": 3 },
	        { "width": "5px", "targets": 0 }
	    ]
    });
} );
</script>


<div class="modal fade" id="deletePengaturanModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Delete Pengaturan</h4>
            </div>
              <div class="modal-body ">
                  Are you sure?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <a class="btn btn-primary" id="delete_pengaturan">OK</a>
              </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$('#deletePengaturanModal').on('show.bs.modal', function(e) {
    $(this).find('#delete_pengaturan').attr('href', $(e.relatedTarget).data('href'));
});
</script>


<div class="container">
	<ol class="breadcrumb">
	  <li class='active'>Pengaturan</li>
	</ol>

	<h3>Pengaturan</h3>
	<h6>ini adalah konstanta, hanya untuk di edit</h6>
<!-- 	<h6>id 1 = jam masuk; <br>
		id 2 = tahun sekarang;<br>
		id 4 = jam akhir kerja;<br>
		id 5 = denda per jam untuk ijin 1 hari;<br>
		id 6 = denda per jam untuk ijin per jam saat jam kerja;<br>
		id 7 = denda keterlambatan per 15 menit;<br>
		id 8 = denda alpha;<br>
	</h6> -->
<!-- 	<div class="text-right">
		<button type="button" class="btn btn-success" data-toggle="modal" data-target="#addPengaturanModal">Add pengaturan</button>
	</div> -->
	<br>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	  		<?=$this->session->flashdata("alert_create_pengaturan");?>
	  		<?=$this->session->flashdata("alert_delete_pengaturan");?>
	  		<?=$this->session->flashdata("alert_update_pengaturan");?>
		</div>
	</div>
	<div class="table-responsive">
  		<table class="table  table-striped" id="examplp">
  			<thead>
        		<tr>
	            	<th>id</th>
	            	<th>pengaturan</th>
	            	<th>konteks</th>
	            	<th class="text-center">action</th>
            	</tr>
        	</thead>
	        <tbody>
	        	<?php foreach ($pengaturans->result() as $row) {
	        		echo "<tr>";
	        		echo "<td>".$row->id_m."</td>";
	        		echo "<td>".$row->misc."</td>";
	        		echo "<td>".$row->detail."</td>";
	        		echo "<td>
	        				<div>
		                        <a href='".base_url('Status_C/update_misc').'/'.$row->id_m."' class='btn btn-sm btn-primary'><span class='glyphicon glyphicon-edit'></span></a>
	                        </div>
	                      </td>";
	        		echo "</tr>";
	        	}
	        	?>
	        </tbody>
  		</table>
	</div>
</div>
<!-- <a data-href='".base_url('Status_C/delete_misc').'/'.$row->id_m."' data-toggle='modal' data-target='#deletePengaturanModal' class='btn btn-xs btn-primary'><span class='glyphicon glyphicon-trash'></span></a> -->
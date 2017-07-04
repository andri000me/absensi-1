
<div class="modal fade" id="addPengaturanModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title" id="myModalLabel">Add Pengaturan</h4>
          	</div>
            <form class="form-horizontal" action="<?php echo base_url();?>status_c/create_misc" method="POST" enctype="multipart/form-data">
          		<div class="modal-body ">
              		<div class="form-group">
                		<div class="col-sm-12">
                  			<input type="text" class="form-control" placeholder="isi aturan" name="c_misc">
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
<div class="container">
	<ol class="breadcrumb">
	  <li class='active'>Pengaturan</li>
	</ol>

	<h3>Pengaturan</h3>
	<h6>id 1 = jam masuk; <br>
		id 2 = tahun sekarang;<br>
		id 4 = jam akhir kerja;<br>
		id 5 = denda per jam untuk ijin 1 hari;<br>
		id 6 = denda per jam untuk ijin per jam saat jam kerja;<br>
		id 7 = denda keterlambatan per 15 menit;<br>
		id 8 = denda alpha;<br>
	</h6>
	<div class="text-right">
		<button type="button" class="btn btn-success" data-toggle="modal" data-target="#addPengaturanModal">Add pengaturan</button>
	</div>
	<br>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	  		<?=$this->session->flashdata("alert_create_pengaturan");?>
	  		<?=$this->session->flashdata("alert_delete_pengaturan");?>
	  		<?=$this->session->flashdata("alert_update_pengaturan");?>
		</div>
	</div>
	<div class="table-responsive">
  		<table class="table  table-condensed">
  			<thead>
        		<tr>
	            	<th>id</th>
	            	<th>pengaturan</th>
            	</tr>
        	</thead>
	        <tbody>
	        	<?php foreach ($pengaturans->result() as $row) {
	        		echo "<tr>";
	        		echo "<td>".$row->id_m."</td>";
	        		echo "<td>".$row->misc."</td>";
	        		echo "<td> 
	        				<a href='".base_url('Status_C/delete_misc').'/'.$row->id_m."'><span class='glyphicon glyphicon-trash'></span></a>
	                        <a href='".base_url('Status_C/update_misc').'/'.$row->id_m."'><span class='glyphicon glyphicon-edit'></span></a>
	                      </td>";
	        		echo "</tr>";
	        	}
	        	?>
	        </tbody>
  		</table>
	</div>
</div>
<?php	foreach ($ijin_ku->result() as $key) {?>
<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h3 class="text-center">Edit Ijin</h3>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<?=$this->session->flashdata("notifikasi_perijinan")?>
		</div>
	</div><br>
	<div  style="margin-top: 20px;">
	  	<div>
		  	<div>
		  		<form action="<?php echo base_url();?>User_C/update_ijin_ku" method="POST" enctype="multipart/form-data" class="form-horizontal" >
		  			<div class="form-group">
					    <label class="col-sm-2 control-label">Id_i</label>
					    <div class="col-sm-10 input-group">
					    	<input type="text" class="form-control" value="<?php echo $key->id_i?>" name="u_id_i" readonly>
					    </div>
					</div>
		  			<div class="form-group">
					    <label class="col-sm-2 control-label">Id_k</label>
					    <div class="col-sm-10 input-group">
					    	<input type="text" class="form-control" value="<?php echo $key->id_k?>" name="u_id_k" readonly>
					    </div>
					</div>
					<div class="form-group">
					    <label class="col-sm-2 control-label">tanggal</label>
					    <div class="col-sm-10 input-group">
					    	<input type="date" class="form-control" value="<?php echo $key->tanggal?>" name="u_tanggal" readonly>
					    </div>
					</div>
					<div class="form-group">
					    <label class="col-sm-2 control-label">perihal</label>
					    <div class="col-sm-10 input-group">
							<textarea class="form-control" name="u_perihal" style="min-height: 100px;"><?php echo $key->perihal; ?></textarea>
					    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">start</label>
						<div class="input-group clockpicker" data-align="top" data-autoclose="true" data-placement='top'>
						    <input type="text" class="form-control" name="u_start" value="<?php echo $key->start; ?>" >
						    <span class="input-group-addon">
						        <span class="glyphicon glyphicon-time"></span>
						    </span>
						</div>
					</div>
					<div class="form-group ">
						<label class="col-sm-2 control-label">end</label>
						<div class="input-group clockpicker" data-align="top" data-autoclose="true" data-placement='top'>
						    <input type="text" class="form-control" name="u_end" value="<?php echo $key->end; ?>" <?php if ($key->end== "00:00:00")  {
						    	echo "readonly";
						    } 
						    ?> >
						    <span class="input-group-addon">
						        <span class="glyphicon glyphicon-time"></span>
						    </span>
						</div>
					</div>
					<div class="col-xs-12 text-right">
						<button type="submit" class="btn btn-default">Submit</button>
					</div>
				</form>
		  	</div>
		</div>
	</div>
</div>

<?php } ?>
<script type="text/javascript">
	$('.clockpicker').clockpicker({
		donetext: 'Done'
	});
</script>
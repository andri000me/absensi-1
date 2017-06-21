<?php	foreach ($absen->result() as $key) {?>
<div class="container">
	
	<ol class="breadcrumb">
	  <li><a href="<?php echo base_url('User_C')?>"  >User</a></li>
	  <li><a href="<?php echo base_url('User_C/detail_per_user/'.$key->id_k)?>" class='active'>overview</a></li>
	  <li  class='active'>edit absensi</li>
	</ol>

	<br>
	<form class="form-horizontal" action="<?php echo base_url('User_C/update_absensi_ku')?>" method="POST">
	  	<div class="form-group">
		    <label class="col-sm-2 control-label">Id Absen</label>
		    <div class="col-sm-10">
		    	<input type="text" class="form-control" value="<?php echo $key->id_a;?>" name="u_id_a" readonly>
		    </div>
		</div>

		<?php foreach ($who as $value) {?>
		<div class="form-group">
		    <label class="col-sm-2 control-label">Id_k</label>
		    <div class="col-sm-10">
		    	<input type="text" class="form-control" value="<?php echo $value->id_k?>" name="u_id_k" readonly>
		    </div>
		</div>
		<div class="form-group">
		    <label class="col-sm-2 control-label">Nama</label>
		    <div class="col-sm-10">
		    	<input type="text" class="form-control" value="<?php echo $value->nama_k?>" name="u_nama" readonly>
		    </div>
		</div>
		<?php } ?>
	  
		<div class="form-group">
			<label class="col-sm-2 control-label">Keterangan</label>
		    <div class="col-sm-10">
	        	<select class="form-control" name="u_keterangan">
		        	<?php
		        		$a = $key->id_s;
		        		foreach ($status->result() as $row) {
		        			echo '<option value="'.$row->id_s.'"';
		                    echo ($a == $row->id_s) ? 'selected' : '';
		                    echo '>'.$row->keterangan_s.'</option>';
		        		}
		        	?>
			    </select>
		    </div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Detil Keterangan</label>
		    <div class="col-sm-10">
				<textarea class="form-control" name="u_detil_keterangan"><?php echo $key->detail?></textarea>
			</div>
		</div>
		<div class="form-group">
		    <label class="col-sm-2 control-label">Jam</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" value="<?php echo $key->jam ?>" name="u_jam" readonly>
		    </div>
		</div>
		<div class="form-group">
		    <label class="col-sm-2 control-label">tanggal</label>
		    <div class="col-sm-10">
		      <input type="date" class="form-control" value="<?php echo $key->tanggal ?>" name="u_tanggal" readonly>
		    </div>
		</div>
		<div class="form-group">
		    <label class="col-sm-2 control-label">Acc</label>
		    <div class="col-sm-10">
		    	<!-- <input type="text" class="form-control" value="<?php echo $key->acc;?>" name="u_acc" readonly> -->
		    	<select class="form-control" value="<?php echo $key->acc;?>" name="u_acc">
		    		<?php
		    			for ($i=0; $i <=1 ; $i++) {
							echo "<option value='".$i."'";
							echo ($i == $key->acc) ? 'selected' : '';
							echo ">".$i."</option>";
		    			}
		    		?>
				</select>
		    </div>
		</div>
		<div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		      <button type="submit" class="btn btn-default btn-primary">Update</button>
		    </div>
		</div>
	</form>
	

	</div>
<?php	}	?>

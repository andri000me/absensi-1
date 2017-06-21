<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h3 class="text-center">Perijinan</h3>
			<h6 class="text-center">*jika ijin seharian, inputkan start dengan nilai jam masuk dan input end dengan nilai jam pulang</h6>
			<h6 class="text-center">*jangan lupa mengakhiri ijin dengan menekan tombol selesai</h6>
		</div>
	</div><br>
	<div class="row">
		<div class="col-xs-12">
			<?=$this->session->flashdata("notifikasi_ijin")?>
		</div>
	</div><br>
	<div class="panel panel-default" style="margin-top: 20px;">
	  	<div class="panel-body">
		  	<div class="row">
		  		<form action="<?php echo base_url();?>Home_C/create_ijin" method="POST" enctype="multipart/form-data">
					<div class="form-group col-xs-12" >
				        <select class="chosen-select" data-placeholder="Nama Karyawan" tabindex="2" style="width: 100%" name="c_id_k" required >
					    <?php 
		            		foreach($nama_karyawan as $row)
				            {
				              	echo '<option value="'.$row->id_k.'">'.$row->nama_k.'</option>';
				            }
					    ?>
				        </select>
					</div>
					<div class="form-group col-xs-12">
						<textarea class="form-control" name="c_perihal" value="<?php echo set_value('c_perihal'); ?>" style="min-height: 100px;" required></textarea>
					</div>

					<div class="col-xs-12">
						<button type="submit" class="btn btn-primary">Start ijin</button>
					</div>
				</form>
		  	</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="table-responsive">
  		<table class="table  table-condensed">
				<thead>
					<tr>
						<th>id</th>
						<th>nama</th>
						<th>tanggal</th>
						<th>urusan</th>
						<th>start</th>
						<th>finish</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php 
					foreach ($ijin as $key) {
						echo "<tr>";
						echo "<td>".$key->id_i."</td>";
						echo "<td>".$key->nama_k."</td>";
						echo "<td>".$key->tanggal."</td>";
						echo "<td>".$key->perihal."</td>";
						echo "<td>".$key->start."</td>";
						echo "<td>".$key->end."</td>";
						if (isset($this->session->userdata['logged_in'])){
							echo "<td class='text-center'><a class='btn btn-danger btn-sm' href='".base_url('Home_C/stop_ijin/'.$key->id_i)."/".$key->start."'>Stop</a> </td>";
						} else {
							echo "<td class='text-center'><a class='btn btn-danger btn-sm disabled' disabled href='".base_url('Home_C/stop_ijin/'.$key->id_i)."/".$key->start."'>Stop</a> </td>";
						}
						
						/*echo "<a class='btn btn-primary btn-sm' href='".base_url('Home_C/edit_ijin/'.$key->id_i)."/".$key->start."'>edit</a></td>";*/
						echo "</tr>";
					} 
					?>
				</tbody>
			</table>
		</div>
	</div>

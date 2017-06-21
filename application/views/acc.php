<div class="container">
<h3><?=date('Y-m-d')?></h3><br>
<h3>Absen</h3><br>
	<?=$this->session->flashdata("alert_update_absen_acc")?>
	<div class="table-responsive">
  		<table class="table  table-condensed">
  			<thead>
        		<tr>
	            	<th>id</th>
	            	<th>nama</th>
	            	<th>keterangan</th>
	            	<th>tanggal</th>
	            	<th>jam</th>
	            	<th>acc</th>
	            	<th>Action</th>
            	</tr>
        	</thead>
	        <tbody>
	        	<?php foreach ($absen->result() as $key) { ?>
	        		<tr>
	        		<td><?= $key->id_a ?></td>
	        		<td><?= $key->nama_k ?></td>
	        		<td><?= $key->keterangan_s ?></td>
	        		<td><?= $key->tanggal ?></td>
	        		<td><?= $key->jam ?></td>
        			<td><?= $key->acc ?></td>
        			<td>
        			<a href="<?php echo base_url('Acc_C/acceptAbsen/'.$key->id_a)?>" style='margin-right: 20px;'><span class='glyphicon glyphicon-ok'></span></a>
        			<a href="<?php echo base_url('Acc_C/deleteAbsen/'.$key->id_a)?>" style='margin-right: 20px;'><span class='glyphicon glyphicon-trash'></span></a>
        			<a href="<?php echo base_url('Acc_C/rejectAbsen/'.$key->id_a)?>"><span class='glyphicon glyphicon-remove'></span></a>
        			</td>
	        		</tr>
	        	<?php }
	        	?>
	        </tbody>
  		</table>
	</div>
</div>

<div class="container">
<h3>Ijin</h3><br>
	<?=$this->session->flashdata("alert_update_ijin_acc")?>
	<div class="table-responsive">
  		<table class="table  table-condensed">
  			<thead>
        		<tr>
	            	<th>id</th>
	            	<th>id_k</th>
	            	<th>id_s</th>
	            	<th>tanggal</th>
	            	<th>urusan</th>
	            	<th>start</th>
	            	<th>finish</th>
            	</tr>
        	</thead>
	        <tbody>
	        	<?php foreach ($ijin->result() as $key) { ?>
	        		<tr>
	        		<td><?= $key->id_i ?></td>
	        		<td><?= $key->nama_k ?></td>
	        		<td><?= $key->perihal?></td>
        			<td><?= $key->start?></td>
        			<td><?= $key->end?></td>

	        		<td><?= $key->tanggal ?></td>
        			
	        		</tr>
	        	<?php }
	        	?>
	        </tbody>
  		</table>
	</div>
</div>
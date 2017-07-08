<div class="container">
	<ol class="breadcrumb">
	  <li  class='active'>Acc</li>
	</ol>
	<br>
	<div class="dropdown">
		<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
		    Pilih bulan
		    <span class="caret"></span>
		</button>
		<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
			<li><a href="<?php echo base_url('Acc_C/lihat/1/'.date('Y'))?>">Januari</a></li>
			<li><a href="<?php echo base_url('Acc_C/lihat/2/'.date('Y'))?>">Februari</a></li>
			<li><a href="<?php echo base_url('Acc_C/lihat/3/'.date('Y'))?>">Maret</a></li>
			<li><a href="<?php echo base_url('Acc_C/lihat/4/'.date('Y'))?>">April</a></li>
			<li><a href="<?php echo base_url('Acc_C/lihat/5/'.date('Y'))?>">Mei</a></li>
			<li><a href="<?php echo base_url('Acc_C/lihat/6/'.date('Y'))?>">juni</a></li>
			<li><a href="<?php echo base_url('Acc_C/lihat/7/'.date('Y'))?>">juli</a></li>
			<li><a href="<?php echo base_url('Acc_C/lihat/8/'.date('Y'))?>">agustus</a></li>
			<li><a href="<?php echo base_url('Acc_C/lihat/9/'.date('Y'))?>">september</a></li>
			<li><a href="<?php echo base_url('Acc_C/lihat/10/'.date('Y'))?>">oktober</a></li>
			<li><a href="<?php echo base_url('Acc_C/lihat/11/'.date('Y'))?>">november</a></li>
			<li><a href="<?php echo base_url('Acc_C/lihat/12/'.date('Y'))?>">desember</a></li>
		</ul>
	</div>
<h3>
  <script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable({
        	paging:false,
        	aoColumnDefs: [
							{ "bSortable": false, "aTargets": [8] }
			]
        });
    });
  </script>
<?php $monthNum  = substr($bulan,0); $dateObj   = DateTime::createFromFormat('!m', $monthNum); echo $dateObj->format('F'); echo "-".$tahun?></h3>
<h3>Absen</h3><br>
	<?=$this->session->flashdata("alert_update_absen_acc")?>
	<?=$this->session->flashdata("alert_update_absensi_ku")?>
	<div class="table-responsive">
  		<table class="table  table-condensed" id="example" data-order='[[ 0, "desc" ]]' >
  			<thead>
        		<tr>
	            	<th>id</th>
	            	<th>nama</th>
	            	<th>keterangan</th>
	            	<th>detail</th>
	            	<th>tanggal</th>
	            	<th>jam</th>
	            	<th>acc</th>
	            	<th>denda</th>
	            	<th class="text-center">action</th>
            	</tr>
        	</thead>
	        <tbody>
	        	<?php foreach ($absen->result() as $key) { ?>
	        		<tr>
	        		<td><?= $key->id_a ?></td>
	        		<td><?= $key->nama_k ?></td>
	        		<td><?= $key->keterangan_s ?></td>
	        		<td><?= $key->detail ?></td>
	        		<td><?= $key->tanggal ?></td>
	        		<td><?= $key->jam ?></td>
        			<td><?= $key->acc ?></td>
        			
        			<td><?php echo "Rp " . number_format($key->denda,2,',','.'); ?></td>
        			
        			<td>
	        			<a href="<?php echo base_url('Acc_C/acceptAbsenx/'.$key->id_a.'/'.$bulan.'/'.$tahun)?>" class="margin-20"><span class='glyphicon glyphicon-ok'></span></a>
	        			<a href="<?php echo base_url('Acc_C/edit_absensi_ku_dari_accx/'.$key->id_a."/".$key->id_k)?>" class="margin-20"><span class='glyphicon glyphicon-edit'></span></a>
	        			<a href="<?php echo base_url('Acc_C/deleteAbsenx/'.$key->id_a.'/'.$bulan.'/'.$tahun)?>" class="margin-20"><span class='glyphicon glyphicon-trash'></span></a>
	        			<a href="<?php echo base_url('Acc_C/rejectAbsenx/'.$key->id_a.'/'.$bulan.'/'.$tahun)?>"><span class='glyphicon glyphicon-remove'></span></a>
        			</td>
	        		</tr>
	        	<?php }
	        	?>
	        </tbody>
  		</table>
	</div>
</div>
  <script type="text/javascript">
    $(document).ready(function() {
        $('#exampla').DataTable({
        	paging:false,
        	aoColumnDefs: [
							{ "bSortable": false, "aTargets": [7] }
			]
        	
        });
    });
  </script>
<br><hr>
<div class="container">
<h3>Ijin</h3><br>
	<?=$this->session->flashdata("alert_update_ijin_acc")?>
	<?=$this->session->flashdata("alert_delete_ijin_acc")?>
	<div class="table-responsive">
  		<table class="table  table-condensed" id="exampla" data-order='[[ 0, "desc" ]]'>
  			<thead>
        		<tr>
	            	<th>id</th>
	            	<th>nama</th>
	            	<th>detail</th>
	            	<th>start</th>
	            	<th>end</th>
	            	<th>tanggal</th>
	            	<th>denda</th>
	            	<th class="text-center">action</th>
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
        			<td><?php echo "Rp " . number_format($key->denda,2,',','.'); ?></td>
        			<td>
        				<div class="text-center">
		        			<a href="<?php echo base_url('Acc_C/edit_ijin_ku_dari_acc/'.$key->id_i.'/'.$key->id_k)?>" class="margin-20"><span class='glyphicon glyphicon-edit'></span></a>
		        			<a href="<?php echo base_url('Acc_C/delete_ijinku/'.$key->id_i."/".$key->id_k.'/'.$bulan.'/'.$tahun)?>" class="margin-20"><span class='glyphicon glyphicon-trash'></span></a>
        				</div>
        			</td>
	        		</tr>
	        	<?php }
	        	?>
	        </tbody>
  		</table>
	</div>
</div>
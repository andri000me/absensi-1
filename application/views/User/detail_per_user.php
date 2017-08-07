<div class="container absen_print">
 	<ol class="breadcrumb no-print">
	  <li><a href="<?php echo base_url('User_C')?>" class='active' >User</a></li>
	  <li class='active'>overview</li>
	</ol>
	<div class="row">
		<?php $date = date('m');
			$monthNum  = substr($bulan,0) ;
	        $dateObj   = DateTime::createFromFormat('!m', $monthNum);?><br>
		<?=$this->session->flashdata("alert_delete_absensi_ku");?>
		<?=$this->session->flashdata("alert_update_absensi_ku");?>
		<?=$this->session->flashdata("alert_update_ijin_ku");?>
		<?=$this->session->flashdata("alert_delete_ijin_ku");?>
		<div class="col-xs-12 col-sm-12" >
			<h3>ABSENSI BULAN <?=$dateObj->format('F')?>	</h3>
			<h3>User <?=$nama_k[0]->nama_k?> memiliki sisa cuti <?= ($cuti[0]->jatah_cuti)- ($cuti[0]->cuti_berapakali);?></h3>
			<h5> Telah cuti sebanyak <?= $cuti[0]->cuti_berapakali?>. Terakhir sinkron <?=$cuti[0]->last_sync ?></h5>
			<br>
		</div>
		<div class="col-xs-12 no-print">
			<ul class="list-inline">
				<li>
					<div class="dropdown">
						<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
						    PILIH BULAN
						    <span class="caret"></span>
						</button>
						<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
							<li><a href="<?php echo base_url('User_C/detail_per_user_per_bulan/'.$siapa.'/1/'.date('Y'))?>">Januari</a></li>
							<li><a href="<?php echo base_url('User_C/detail_per_user_per_bulan/'.$siapa.'/2/'.date('Y'))?>">Februari</a></li>
							<li><a href="<?php echo base_url('User_C/detail_per_user_per_bulan/'.$siapa.'/3/'.date('Y'))?>">Maret</a></li>
							<li><a href="<?php echo base_url('User_C/detail_per_user_per_bulan/'.$siapa.'/4/'.date('Y'))?>">April</a></li>
							<li><a href="<?php echo base_url('User_C/detail_per_user_per_bulan/'.$siapa.'/5/'.date('Y'))?>">Mei</a></li>
							<li><a href="<?php echo base_url('User_C/detail_per_user_per_bulan/'.$siapa.'/6/'.date('Y'))?>">juni</a></li>
							<li><a href="<?php echo base_url('User_C/detail_per_user_per_bulan/'.$siapa.'/7/'.date('Y'))?>">juli</a></li>
							<li><a href="<?php echo base_url('User_C/detail_per_user_per_bulan/'.$siapa.'/8/'.date('Y'))?>">agustus</a></li>
							<li><a href="<?php echo base_url('User_C/detail_per_user_per_bulan/'.$siapa.'/9/'.date('Y'))?>">september</a></li>
							<li><a href="<?php echo base_url('User_C/detail_per_user_per_bulan/'.$siapa.'/10/'.date('Y'))?>">oktober</a></li>
							<li><a href="<?php echo base_url('User_C/detail_per_user_per_bulan/'.$siapa.'/11/'.date('Y'))?>">november</a></li>
							<li><a href="<?php echo base_url('User_C/detail_per_user_per_bulan/'.$siapa.'/12/'.date('Y'))?>">desember</a></li>
						</ul>
					</div>
				</li>
				<li><button type="button" id="print_btn" class="btn btn-success"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> CETAK</button></li>
			</ul>
			
		</div>
	</div>
	<br>
<script type="text/javascript">
$(document).ready(function() {
    $('#exampld').DataTable();

} );
</script>
	<div class="table-responsive" >
  		<table class="table table-condensed" id="exampld">
  			<thead>
        		<tr>
	            	<th>id</th>
	            	<th>tanggal</th>
	            	<th>jam</th>
	            	<th>status</th>
	            	<th>keterangan</th>
	            	<th>acc</th>
	            	<th>late minute</th>
	            	<th>denda</th>
	            	<th class='no-print text-center'>action</th>
            	</tr>
        	</thead>
	        <tbody>
	        	<?php
	        		$ontime=0;
	        		$late=0;
	        		$sick=0;
	        		$other=0;
	        		$i =1;
					foreach ($absen as $key){
// if ($key->keterangan_s =='hadir' ) {
// 	if ($key->detail =='tepat waktu') {
// 		$ontime = $ontime + 1 ;
// 	}
// 	else($key->detail =='telat'){
// 		$late = $late + 1;
// 	}
// }
// elseif($key->keterangan_s =='sakit') {
// 	$sick = $sick + 1;
// }elseif ($key->keterangan_s =='ijin 1 hari' or $key->keterangan_s =='alpha') {
// 	$other = $other +1;
// }
		        		echo "<tr>";
		        		echo "<td>".$i."</td>";
		        		echo "<td>".$key->tanggal."</td>";
		        		echo "<td>".$key->jam."</td>";
		        		echo "<td>".$key->keterangan_s."</td>";
		        		echo "<td>".$key->detail."</td>";
		        		echo "<td>".$key->acc."</td>";
		        		echo "<td>".$key->late_minute."</td>";
		        		echo "<td> Rp ".number_format($key->denda,2,',','.')."</td>";
		        		echo "<td class='text-center'> <a title='delete' class='no-print margin-20' href='".base_url()."User_C/delete_absensi_ku/".$key->id_A."/".$key->id_k."' ><span class='glyphicon glyphicon-trash'></span></a>
		        					<a title='edit' class='no-print' href='".base_url()."User_C/edit_absensi_ku/".$key->id_A."/".$key->id_k."'><span class='glyphicon glyphicon-edit'></span></a>
		                  </td>";
		        		echo "</tr>";
		        		$i++;
	        		}
	        	?>
	        </tbody>
  		</table>
	</div>
	<div>
		<?php
		$denda_ku =0;
		foreach ($denda_absen as $kay) {
			$denda_ku = $denda_ku + $kay->denda;
		}
		?>
		<div class="panel panel-danger">
			<div class="panel-heading">Total denda Absen</div>
			<div class="panel-body">
		Total denda sejumlah Rp <?php echo number_format($denda_ku,2,',','.')?> di bulan ini
			</div>
		</div>
	</div>
	<br>
	<hr>
	<br>
	<h3>IJIN BULAN <?=$dateObj->format('F')?></h3>
<script type="text/javascript">
$(document).ready(function() {
    $('#examplij').DataTable();

} );
</script>
	<div class="table-responsive">
  		<table class="table table-condensed" id="examplij">
  			<thead>
        		<tr>
	            	<th>id i</th>
	            	<th>urusan</th>
	            	<th>start</th>
	            	<th>end</th>
	            	<th>denda</th>
	            	<th>tanggal</th>
	            	<th class='no-print text-center'>action</th>
            	</tr>
        	</thead>
	        <tbody>
	        	<?php
	        		// print_r($absen);
					foreach ($ijin as $kuy){
		        		echo "<tr>";
		        		echo "<td>".$kuy->id_i."</td>";
		        		echo "<td>".$kuy->perihal."</td>";
		        		echo "<td>".$kuy->start."</td>";
		        		echo "<td>".$kuy->end."</td>";
		        		echo "<td> Rp ".number_format($kuy->denda,2,',','.')."</td>";
		        		echo "<td>".$kuy->tanggal."</td>";
		        		echo "<td class='text-center'>
		        			<a  class=' no-print margin-20' href='".base_url()."User_C/delete_ijin_ku/".$kuy->id_i."/".$key->id_k."'><span class='glyphicon glyphicon-trash'></span></a>
		        			<a  class='no-print margin-20' href='".base_url()."User_C/edit_ijin_ku/".$kuy->id_i."/".$key->id_k."'><span class='glyphicon glyphicon-edit'></span></a>
		                  </td>";
		        		echo "</tr>";
	        		}
	        	?>
	        </tbody>
  		</table>
	</div>
	<div>
	</div><br>
	<div>
		<?php
		$denda_ku =0;
		foreach ($denda_ijin as $kay) {
			$denda_ku = $denda_ku + $kay->denda;
		}
		?>
		<div class="panel panel-danger">
			<div class="panel-heading">Total denda Ijin</div>
			<div class="panel-body">
		Total denda ijin jam kerja sejumlah Rp. <?php echo number_format($denda_ku,2,',','.')?> di bulan ini
			</div>
		</div>
	</div>
	<div class="text-center">
		<a class="btn btn-primary no-print" href="<?php echo base_url('User_C/lihat5bulan/'.$siapa."/".$bulan."/".$tahun)?>" role="button"><span class="glyphicon glyphicon-list"></span> LIHAT GRAFIK 5 BULAN</a>
	</div>
	<br><?php
	if ($data_chart != array()) {?>
		<div class="good" id="good"></div>
		<script type="text/javascript">
			$(function () { 
			    var myChart = Highcharts.chart('good', {
				    title: { text: 'Grafik Hadir' },	
				    exporting: { enabled: true },
				    yAxis: { reversed: true,title: { text: 'jam' }},
				    xAxis: {type: 'category',title: { text: 'tanggal'}},
				    plotOptions: {line: {dataLabels: {enabled: true},enableMouseTracking: true}},
				    series: [{name: 'Jam', data: <?=$data_chart?>}]
				});
			});
		</script>
		
	<?php }
	?>
	<div class="panel panel-danger">
		<div class="panel-heading">Rata-rata keterlambatan</div>
		<div class="panel-body">
			<?= number_format($late_avg,2)?> Menit
		</div>
	</div>
	
</div>
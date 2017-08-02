<div class="absen_print">
    <div class="container absen_print">
    	<div class="col-sm-12">
    		<div class="row">
		    	<div class="col-sm-4 col-xs-12">
				    <br/><p>Total Denda</p>
				    <h4>Rp. <?=number_format($denda_absen[0]->total_denda,2,',','.')?>(Absen) <br> + Rp. <?=number_format($denda_ijin[0]->total_denda,2,',','.') ?>(Ijin)</h4>
				</div>
				<div class="col-sm-2 col-xs-12">
				    <br/><p>Rata2 Keterlambatan Karyawan</p>
				    <h4><?=number_format($late_avg_karyawan,2)?> Menit</h4>	
				</div>
				<div class="col-sm-2 col-xs-12">
				    <br/><p>Rata2 Keterlambatan Magang</p>
				    <h4><?=number_format($late_avg_magang,2)?> Menit</h4>	
				</div>
				<!-- <div class="col-sm-2 col-sm-push-3 col-xs-12">
				    <br/><p>Rangking 1</p>
				    <h4>-</h4>	
				</div>
				<div class="col-sm-2 col-sm-push-3 col-xs-12">
				    <br/><p>Rangking Terakhir</p>
				    <h4>-</h4>	
				</div> -->
			</div>	
		</div>
		<hr class="horizontal-line col-sm-12 col-xs-12 pull right">	

<script type="text/javascript">
$(document).ready(function() {
    $('#exampli').DataTable();
} );
</script>

	<div class="container">
		<div class="col-xs-12 col-sm-12 " >
			<h3>Laporan Absen <?php /*echo $bulan_dicari.'-'.$tahun_dicari*/ ?></h3><br>
			<div class="table-responsive">
		  		<table class="table  table-condensed" id="exampli" width="100%" cellspacing="0">
		  			<thead>
		        		<tr>
		        			<th>id Absen</th>
			            	<th>nama Karyawan</th>
			            	<th>Status</th>
			            	<th>Detail</th>
			            	<th>Jam</th>
			            	<th>Tanggal</th>
			            	<th>acc</th>
			            	<th>denda</th>
		            	</tr>
		        	</thead>
			        <tbody>
			        	<?php
							foreach ($cari as $row) { 
			        		echo "<tr>";
			        		echo "<td>".$row->id_a."</td>";
			        		echo "<td>".$row->nama_k."</td>";
			        		echo "<td>".$row->keterangan_s."</td>";
			        		echo "<td>".$row->detail."</td>";
			        		echo "<td>".$row->jam."</td>";
			        		echo "<td>".$row->tanggal."</td>";
			        		echo "<td>".$row->acc."</td>";

			        		echo "<td> Rp. ".number_format($row->denda,2,',','.')."</td>";
			        		echo "</tr>";
			        	}
			        	?>
			        </tbody>
		  		</table>
			</div>
		</div>
	</div>
	<script type="text/javascript">
	$(document).ready(function() {
	    $('#examplo').DataTable();

	} );
	</script>
	<br><hr>
	<div class="container ">
		<div class="col-xs-12 col-sm-12 " >
			<h3>Laporan Ijin </h3><br>
			<div class="table-responsive">
		  		<table class="table  table-condensed" id="examplo">
		  			<thead>
		        		<tr>
		        			<th>id ijin</th>
			            	<th>nama Karyawan</th>
			            	<th>perihal</th>
			            	<th>start</th>
			            	<th>end</th>
			            	<th>tanggal</th>
			            	<th>denda</th>
		            	</tr>
		        	</thead>
			        <tbody>
			        	<?php
							foreach ($cari_ijin as $row) { 
			        		echo "<tr>";
			        		echo "<td>".$row->id_i."</td>";
			        		echo "<td>".$row->nama_k."</td>";
			        		echo "<td>".$row->perihal."</td>";
			        		echo "<td>".$row->start."</td>";
			        		echo "<td>".$row->end."</td>";
			        		echo "<td>".$row->tanggal."</td>";
			        		echo "<td> Rp. ".number_format($row->denda,2,',','.')."</td>";
			        		echo "</tr>";
			        	}
			        	?>
			        </tbody>
		  		</table>
			</div>
		</div>
	</div>
	<br><hr>
	<div class="container">
		<div class="row">
			<h3>Ranking Tepat Waktu Siswa Magang</h3>
		</div>
		<div class="row">
			<div class="table-responsive">
		  		<table class="table  table-condensed" id="examplo">
		  			<thead>
		        		<tr>
		        			<th>ranking</th>
			            	<th>nama siswa</th>
			            	<th>ontime</th>
			            	<th>late</th>
		            	</tr>
		        	</thead>
			        <tbody>
			        	<?php
			        		$a = 1;
							foreach ($magang as $row) { 
			        		echo "<tr>";
			        		echo "<td>".$a."</td>";
			        		echo "<td>".$row['nama_k']."</td>";
			        		echo "<td>".$row['ontime']."</td>";
			        		echo "<td>".$row['late']."</td>";
			        		echo "</tr>";
			        		$a++;
			        	}
			        	?>
			        </tbody>
		  		</table>
			</div>
		</div><hr>
		<div class="row">
			<h3>Ranking Tepat Waktu Karyawan</h3>
		</div>
		<div class="row">
			<div class="table-responsive">
		  		<table class="table  table-condensed" id="examplo">
		  			<thead>
		        		<tr>
		        			<th>ranking</th>
			            	<th>nama Karyawan</th>
			            	<th>ontime</th>
			            	<th>late</th>
		            	</tr>
		        	</thead>
			        <tbody>
			        	<?php
			        		$a = 1;
							foreach ($karyawan as $row) { 
			        		echo "<tr>";
			        		echo "<td>".$a."</td>";
			        		echo "<td>".$row['nama_k']."</td>";
			        		echo "<td>".$row['ontime']."</td>";
			        		echo "<td>".$row['late']."</td>";
			        		echo "</tr>";
			        		$a++;
			        	}
			        	?>
			        </tbody>
		  		</table>
			</div>
		</div>

	</div>
</div>
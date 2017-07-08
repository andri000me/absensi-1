<div class="container">
	<div class="col-xs-12 col-sm-2">
		<button type="button" id="print_btn" class="btn btn-success"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> </button>
		<!-- <a class="btn btn-default" onclick="print()" role="button">cetak pdf js</a> -->
	</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('#exampli').DataTable({paging: false});
} );
</script>
<div class="absen_print">
	<div class="container">
		<div class="col-xs-12 col-sm-12 " >
			<h3>laporan absen per bulan : <?php echo $yg_dicari ?></h3><br>
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
			<h3>total denda absen bulan ini Rp. <?=number_format($denda_absen[0]->total_denda,2,',','.')?></h3>
		</div>
	</div>
	<script type="text/javascript">
	$(document).ready(function() {
	    $('#examplo').DataTable({paging: false});

	} );
	</script>
	<br><hr>
	<div class="container ">
		<div class="col-xs-12 col-sm-12 " >
			<h3>laporan ijin </h3><br>
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
			<h3>total kompensasi ijin bulan ini Rp. <?=number_format($denda_ijin[0]->total_denda,2,',','.') ?></h3>
		</div>
	</div>
</div>

<script type="text/javascript">
    $(document).ready(function(e) {
       $('button#print_btn').on('click', function(e)  {
            $('#ijin_print,#absen_print').printThis({
                styles: [
                		'<?php echo base_url("assets/css/bootstrap.css")?>'
                		],
            	exclude : ['.noprint']
            });
       }); 
    });
</script>
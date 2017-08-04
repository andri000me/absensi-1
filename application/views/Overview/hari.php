<div class="absen_print">
    <div class="container absen_print">
    	<div class="col-sm-12">
    		<div class="row">
		    	<div class="col-sm-4 col-xs-12">
				    <br/><p>Total Denda Absen</p>
				    <h4>Rp. <?=number_format($denda_absen[0]->total_denda,2,',','.')?></h4>
				</div>
				<div class="col-sm-4 col-xs-12">
				    <br/><p>Total Denda Ijin</p>
				    <h4>Rp. <?=number_format($denda_ijin[0]->total_denda,2,',','.') ?></h4>
				</div>
				<!-- <div class="col-sm-4 col-xs-12">
				    <br/><p>Rata2 Keterlambatan</p>
				    <h4>25 Menit</h4>	
				</div> -->
			</div>	
		</div>
		<hr class="horizontal-line col-sm-12 col-xs-12 pull right">	
<script type="text/javascript">
	$(document).ready(function() {
	    $('#examplw').DataTable();
	} );
</script>
	<div class="container ">
		<div class="col-xs-12 col-sm-12">
		<?php
			$dt = strtotime($tanggal);
			$day = date("l", $dt);
		?>
			<h3>laporan per hari : <?php echo $day." "; echo $tanggal ?></h3><br>
			<div class="table-responsive">
		  		<table class="table  table-condensed" id="examplw">
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
			        		echo ($row->acc == 1) ? "<td>Confirmed</td>":"<td>Waiting confirmation</td>";
			        		echo "<td> Rp. ".number_format($row->denda,2,',','.')."</td>";
			        		echo "</tr>";
			        	} ?>
			        </tbody>
		  		</table>
			</div>
		</div>
		
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
		    $('#examplq').DataTable();
		} );
	</script>
	<br><hr>
	<div class="container" id="ijin_print">
		<div class="col-xs-12 col-sm-12 " >
			<h3>laporan ijin </h3><br>
			<div class="table-responsive">
		  		<table class="table  table-condensed" id="examplq">
		  			<thead>
		        		<tr>
		        			<th>id ijin</th>
			            	<th>nama Karyawan</th>
			            	<th>perihal</th>
			            	<th>start</th>
			            	<th>end</th>
			            	<th>Tanggal</th>
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
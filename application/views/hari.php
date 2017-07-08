<div class="container" >
	<div class="col-xs-12 col-sm-2">
		<button type="button" id="print_btn" class="btn btn-success"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> </button>
		<!-- <a class="btn btn-default" onclick="print()" role="button">cetak pdf js</a> -->
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
	    $('#examplw').DataTable({paging: false});
	} );
</script>
<div class="absen_print">
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
			        		
			        		echo "</tr>";
			        	} ?>
			        </tbody>
		  		</table>
			</div>
		</div>
		
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
		    $('#examplq').DataTable({paging: false});
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
<div class="container">
	<div class="col-xs-12 col-sm-12 " >
	<?php
		$dt = strtotime($tanggal);
		$day = date("l", $dt);
	?>
		<h3>laporan per hari : <?php echo $day." "; echo $tanggal ?></h3><br>
		<div class="table-responsive">
	  		<table class="table  table-condensed">
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
<div class="container">
	<div class="col-xs-12 col-sm-12 " >
		<h3>laporan ijin </h3><br>
		<div class="table-responsive">
	  		<table class="table  table-condensed">
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
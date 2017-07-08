	<div class="container">
		<ol class="breadcrumb">
	        <li><a href="<?php echo base_url('Status_C/view')?>" class='active' >Status</a></li>
	        <li >Detail</li>
	        <li class='active'><?=$keterangan_s[0]->keterangan_s?></li>
	    </ol>
		<div class="table-responsive">
	  		<table class="table  table-condensed">
	  			<thead>
	        		<tr>
		            	<th>nama</th>
		            	<th>tanggal</th>
		            	<th>jam</th>
		            	<th>keterangan</th>
		            	<th>detail</th>
		            	<th>denda</th>
	            	</tr>
	        	</thead>
		        <tbody>
		        	<?php
		        		// print_r($absen);
						foreach ($status as $key){
			        		echo "<tr>";
			        		echo "<td>".$key->nama_k."</td>";
			        		echo "<td>".$key->tanggal."</td>";
			        		echo "<td>".$key->jam."</td>";
			        		echo "<td>".$key->keterangan_s."</td>";
			        		echo "<td>".$key->detail."</td>";
			        		echo "<td> Rp ".number_format($key->denda,2,',','.')."</td>";
			        		echo "</tr>";
		        		}
		        	?>
		        </tbody>
	  		</table>
		</div>	
	</div>
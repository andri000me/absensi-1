	<div class="container">
		<div class="table-responsive">
	  		<table class="table table-condensed" id="exampli">
	  			<thead>
	        		<tr>
		            	<th>nama</th>
		            	<th>tanggal</th>
		            	<th>jam</th>
		            	<th>keterangan</th>
		            	<th>detail</th>
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
			        		echo "</tr>";
		        		}
		        	?>
		        </tbody>
	  		</table>
		</div>	
	</div>

<script type="text/javascript">
$(document).ready(function() {
    $('#exampli').DataTable();
} );
</script>
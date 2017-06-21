<div class="container">
	
	<ol class="breadcrumb">
	  <li><a href="<?php echo base_url('User_C')?>">User</a></li>
	  <li><a href="<?php echo base_url('User_C/detail_per_user_per_bulan/'.$id_k.'/'.$bulan.'/'.$tahun)?>">Overview</a></li>
	  <li class="active">Data</li>
	</ol>
	<?php
	if ($persen != array()) {?>
		<div class="5bulan" id="5bulan" style="min-width: 310px;max-width: 100%;height: 400px;margin: 0 auto;"></div>
		<script type="text/javascript">
			$(function () { 
			    var myChart = Highcharts.chart('5bulan', {

				    title: {
				        text: 'Grafik Hadir 5 bulan'
				    },
				    
				    xAxis: {
				    	type: 'category'
				    },

				    series: [{
				    	data: <?=$persen?>
				    }]

				});
			});
		</script>
		
	<?php }
	?>
</div>
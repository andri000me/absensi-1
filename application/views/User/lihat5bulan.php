<div class="container">
	
	<ol class="breadcrumb">
	  <li><a href="<?php echo base_url('User_C')?>">User</a></li>
	  <li><a href="<?php echo base_url('User_C/detail_per_user_per_bulan/'.$id_k.'/'.$bulan.'/'.$tahun)?>">Overview</a></li>
	  <li class="active">Data</li>
	</ol>
	<h3 class="text-center">User <?=$nama_k[0]->nama_k?></h3>
	<?php
	//if ($persen != array()) {?>
		<div class="5bulan" id="5bulan" style="min-width: 100%;height: 400px;margin: 0 auto;"></div>
		<script type="text/javascript">
			$(function () { 
				var workdays = <?=$workday;?>;
				var kehadiran = <?=$kehadiran;?>;
				var ontime = <?=$ontime;?>;
				var late = <?=$late;?>;
				var ijin1h = <?=$ijin1h;?>;
				var cuti = <?=$cuti;?>;
				var other = <?=$other;?>;
				var alpha = <?=$alpha?>;
				var sakit = <?=$sakit?>;
			    var myChart = Highcharts.chart('5bulan', {
			    	title: { text: 'Grafik Hadir 5 bulan' },
				    exporting: { enabled: true },
				    yAxis: { title: { text: 'persen(%)' }},
				    xAxis: {type: 'category',title: { text: 'tanggal'}},
				    tooltip: {
				        formatter: function () {
				            var content = 'Wordays :<b>' + workdays[this.key]+' Hari</b><br> Kehadiran :<b>'+kehadiran[this.key] +' Kali</b><br> Ontime :<b>'+ontime[this.key] +' Kali</b><br> Terlambat :<b>'+late[this.key] +' Kali</b><br> Other :<b>'+other[this.key] +' Kali</b><br> Ijin 1 hari :<b>'+ijin1h[this.key] +' Kali</b><br> Cuti :<b>'+cuti[this.key] +' Kali</b><br> Alpha :<b>'+alpha[this.key] +' Kali</b><br> Sakit :<b>'+sakit[this.key] +' Kali</b>';
				            return content;
				            // return 'The value for <b>' + this.x +
				                // '</b> is <b>' + this.y + '</b>';
				        }
				    },
				    plotOptions: {line: {dataLabels: {enabled: true},enableMouseTracking: true}},
				    series: [
	
					    { 
				    		name: "Persentase Ontime",
				    		data: <?=$persenon?>
					    },
					    { 
				    		name: "Persentase Terlambat",
				    		data: <?=$persenla?>
					    },
					    { 
				    		name: "Persentase Other",
				    		data: <?=$perseno?>
					    },
					    { 
				    		name: "Persentase cuti",
				    		data: <?=$persencu?>
					    },
					    { 
				    		name: "Persentase sakit",
				    		data: <?=$persensa?>
					    },
					    { 
				    		name: "Persentase alpha",
				    		data: <?=$persena?>
					    }

				    ]
				});
			});
		</script>
		
	<?php //}
	?>
</div>
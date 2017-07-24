<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h3>Absen hari ini</h3>
			<div class="table-responsive">
				<table class="table table-condensed" id="tabel_absen">
					<thead>
				    	<tr>
				        	<th>id_a</th>
				        	<th>Nama</th>
				            <th>Absensi</th>
				            <th>Keterangan</th>
				            <th>Tanggal</th>
				            <th>Jam</th>
				            <th>Denda</th>
				        </tr>
				    </thead>
				    <tbody>
				    	  
				    </tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<h3>Ijin hari ini</h3>
			<div class="table-responsive">
				<table class="table table-condensed" id="tabel_ijin">
					<thead>
				    	<tr>
				        	<th>Nama</th>
				            <th>Tanggal</th>
				            <th>Keterangan</th>
				            <th>Start</th>
				            <th>End</th>
		                    <th>Kompensasi</th>
				        </tr>
				    </thead>
				    <tbody>
				    	   
				    </tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$.get('<?php echo base_url('Home_C/show_absen/')?>', function(html){
    	var data = JSON.parse(html);
    	console.log(data);
    	$('#tabel_absen').DataTable().destroy();

	$('#tabel_absen').DataTable({
		data : (data.absen),
		columns: [
			{ "data": "id_a" },
			{ "data": "nama_k" },
			{ "data": "keterangan_s" },
			{ "data": "detail" },
			{ "data": "tanggal" },
			{ "data": "jam" },
			{ "data": "denda" , render: $.fn.dataTable.render.number( ',', '.', 2, 'Rp.' )}
        ],
		paging : false,
		aoColumnDefs: [{ "bSortable": true, "aTargets": [] }]
  		});
	});

	$.get('<?php echo base_url('Home_C/show_ijin/')?>', function(html){
		var data = JSON.parse(html);
    	$('#tabel_ijin').DataTable().destroy();
		$('#tabel_ijin').DataTable({
			"data" :(data.list_ijin),
			"columns": [
				{ "data": "nama_k" },
				{ "data": "tanggal" },
				{ "data": "perihal" },
				{ "data": "start" },
				{ "data": "end" },
				{ 	"data": "denda",
					"render": $.fn.dataTable.render.number( ',', '.', 2, 'Rp.' )}
			],
			"paging" : false
		});
	});
</script>
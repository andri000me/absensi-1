<div class="container">
	<div class="col-md-12">
		<div class="row">
			<br/>
			<div class="col-md-6">
				<h1>Selamat Datang, <?=$this->session->userdata('logged_in')['username']?></h1>
				<h3><?=date("l,d F Y")?></h3>
			</div>
			<div class="col-md-6">
				<div class="dist">
					<a href="<?=base_url("Home_C/view_absen")?>" class="btn btn-primary btn-lg"> TAMBAH ABSENSI</a>
					<a href="<?=base_url("Home_C/view_ijin")?>" class="btn btn-primary btn-lg">TAMBAH IZIN</a>
				</div>
			</div>
		</div>
	</div>
	<br/>
	<br/>
	<br/>
	<div class="col-md-12">
	<h3>Absen hari ini</h3>
	<div class="table-responsive">
		<table class="table table-condensed" id="tabel_absen">
			<thead>
		    	<tr>
		        	<th>Nama</th>
		            <th>Absensi</th>
		            <th>Keterangan</th>
		            <th>Tanggal</th>
		            <th>Jam</th>
		            <th>Denda</th>
		            <th>Pilih Aksi</th>
		        </tr>
		    </thead>
		    <tbody>
		    	  
		    </tbody>
		</table>
	</div>
	</div>
	<div class="col-md-12">
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


<script type="text/javascript">
window.onload=show();
function show(){
    $.get('<?php echo base_url('Home_C/show_absen/')?>', function(html){
    	var data = JSON.parse(html);
    	console.log(data);
    	$('#tabel_absen').DataTable().destroy();

	$('#tabel_absen').DataTable({
		data : (data.absen),
		columns: [
			{ "data": "nama_k" },
			{ "data": "keterangan_s" },
			{ "data": "detail" },
			{ "data": "tanggal" },
			{ "data": "jam" },
			{ "data": "denda" , render: $.fn.dataTable.render.number( ',', '.', 2, 'Rp.' )},
			{ "data": "id_a" }],
		paging : false,
		aoColumnDefs: [{ "bSortable": true, "aTargets": [] }]
  		});
	});
	$.get('<?php echo base_url('Home_C/show_ijin/')?>', function(html){
	    	var data = JSON.parse(html);
	    	console.log(data);
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
}
	
</script>


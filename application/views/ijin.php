<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h3 class="text-center">Perijinan</h3>
			<h6 class="text-center">*jika ijin seharian, inputkan start dengan nilai jam masuk dan input end dengan nilai jam pulang</h6>
			<h6 class="text-center">*jangan lupa mengakhiri ijin dengan menekan tombol selesai</h6>
		</div>
	</div><br>
	<div class="row">
		<div class="col-xs-12" id="alert">

		</div>
	</div><br>
	<div class="panel panel-default" style="margin-top: 20px;">
	  	<div class="panel-body">
		  	<div class="row">
		  		<form  method="POST" id="form-ijin"><!-- action="<?php echo base_url();?>Home_C/create_ijinx" -->
					<div class="form-group col-xs-12" >
				        <select class="chosen-select" data-placeholder="Nama Karyawan" tabindex="2" style="width: 100%" name="c_id_k" required >
					    <?php 
		            		foreach($nama_karyawan as $row)
				            {
				              	echo '<option value="'.$row->id_k.'">'.$row->nama_k.'</option>';
				            }
					    ?>
				        </select>
					</div>
					<div class="form-group col-xs-12">
						<textarea class="form-control" name="c_perihal" value="<?php echo set_value('c_perihal'); ?>" style="min-height: 100px;" required></textarea>
					</div>
					<div class="col-xs-12">
						<a class="btn btn-primary" onclick="submit()" id="start-ijin">Start ijin</a>
					</div>
				</form>
		  	</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="table-responsive">
  		<table class="table  table-condensed" id="tabel">
				<thead>
					<tr>
						<th>id</th>
						<th>nama</th>
						<th>tanggal</th>
						<th>urusan</th>
						<th>start</th>
						<th>finish</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					
				</tbody>
			</table>
		</div>
		<hr>
		<br>
		<h3 class="text-center">List ijin hari ini</h3>
		<div class="table-responsive">
  			<table class="table  table-condensed" id="tabel-ijin">
				<thead>
					<tr>
						<th>id</th>
						<th>nama</th>
						<th>tanggal</th>
						<th>urusan</th>
						<th>start</th>
						<th>end</th>
						<th>kompensasi</th>
					</tr>
				</thead>
				<tbody>
					
				</tbody>
			</table>
		</div>
	</div>

<script type="text/javascript">
	window.onload = show();
	function show() {
		$.get('<?php echo base_url('Home_C/show_ijin/')?>', function(html){
	    	var data = JSON.parse(html);
	    	console.log('00'+myData);
	    	$('#tabel').DataTable().destroy();
	    	$('#tabel-ijin').DataTable().destroy();
			$('#tabel').DataTable(
				{"data" :(data.ijin),
				"columns": [
					{ "data": "id_i" },
					{ "data": "nama_k" },
					{ "data": "tanggal" },
					{ "data": "perihal" },
					{ "data": "start" },
					{ "data": "end" },
					{ "data": "id_i",
						"render": function ( data, type, full, meta ) {
							if (myData != '') {
								return '<a  class="btn btn-xs btn-danger" data-idi="'+data+'" onclick="stop(this)">Stop</a>';
							}else{
								return '<a  class="btn btn-xs btn-danger" disabled>Stop</a>';
							}
						}
					}
				],
				"paging" : false,
				"columnDefs": [
                    { "width": "10px", "targets": 6 }
                ],
                "aoColumnDefs": [
					{ "bSortable": false, "aTargets": [6] }
				]
			});
			$('#tabel-ijin').DataTable({
				"data" :(data.list_ijin),
				"columns": [
					{ "data": "id_i" },
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


<script type="text/javascript">
	function submit() {
		// console.log('aaaa');
		var url = "<?=base_url('Home_C/create_ijin')?>";
		$('#start-ijin').text('starting...'); //change button text
	    $('#start-ijin').attr('disabled',true); //set button disable 

	    var formData = new FormData($('#form-ijin')[0]);
	    $.ajax({
	        url : url,
	        type: "POST",
	        data: formData,
	        contentType: false,
	        processData: false,
	        success: function(data)
	        {
	        	var object = JSON.parse(data);
	            $("#alert").html(object);
	            // console.log(data);
	            $('#start-ijin').text('Starts'); //change button text
	            $('#start-ijin').attr('disabled',false); //set button enable 
	            show();

	        },
	        error: function (jqXHR, textStatus, errorThrown)
	        {
	            console.log(jqXHR, textStatus, errorThrown);
	            $('#start-ijin').text('eror'); //change button text
	            $('#start-ijin').attr('disabled',false); //set button enable 
	        }
	    });
	    show();
	}
	function stop(elem){
		var uidi = $(elem).data('idi');
		var url = "<?=base_url('Home_C/stop_ijin/')?>";
		var alert = document.getElementById('alert');
	    $.get(url + uidi, function(html){
	        var object = JSON.parse(html);
	        alert.innerHTML = object;
	    });
	    show();
	}
</script>
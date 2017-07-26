<script type="text/javascript">
	$( document ).ready(function() {
		$("#freeform").on('submit', function(e){e.preventDefault();});
	});
</script>
<div class="modal fade" id="ijinFreeformModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title" id="myModalLabel">ijin free form <?=date('d-F-Y')?></h4>
          	</div>
        	<form class="form-horizontal" method="POST" id="freeform">
          		<div class="modal-body">
          			<div id="alert-free"></div>	
          			<div class="form-group">
	              		<div class=" col-xs-12">
        					<h5 class="text-center"> *Atur value jam ijin secara manual. Pastikan jam awal dan jam akhir valid.</h5><br>
	                  		<select class="chosen-select" data-placeholder="Nama Karyawan" name="c_id_k" required style="width: 100%">
						    <?php 
			            		foreach($nama_karyawan as $row)
					            {
					              	echo '<option value="'.$row->id_k.'">'.$row->nama_k.'</option>';
					            }
						    ?>
					        </select>
	              		</div>
          			</div>
              		<div class="form-group">
              			<div class="col-xs-12">
	              			<label class='control-label'>keterangan</label>
	                  		<textarea class="form-control" name="c_perihal"  style="min-height: 100px;" required></textarea>
              			</div>
              		</div>
              		<div class='form-group'><div class='col-xs-12'>
                        <label class='control-label'>Jam Start</label>
                        <div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true" >
						    <input type="text" class="form-control" name="c_jam_start" id="clockstart">
						    <span class="input-group-addon">
						        <span class="glyphicon glyphicon-time"></span>
						    </span>
						</div>
						</div>
                    </div>
                    <div class='form-group'><div class='col-xs-12'>
                        <label class='control-label'>Jam End</label>
                        <div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true" >
						    <input type="text" class="form-control" name="c_jam_end" onchange="calc()" id="clockend">
						    <span class="input-group-addon">
						        <span class="glyphicon glyphicon-time"></span>
						    </span>
						</div>
						</div>
                    </div>
					<div class="form-group"><div class="col-xs-12">
						<label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
						<div class="input-group">
							<div class="input-group-addon">Rp</div>
							<input type="text" class="form-control" id="biaya"  placeholder="Amount">
							<div class="input-group-addon">.00</div>
						</div>
						</div>
					</div>
	          	</div>
	          	<div class="modal-footer">
	            	<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
	            	<button type="submit" class="btn btn-primary" onclick="free()" id="btn_free">Submit</button>
	          	</div>
        	</form>
        </div>
    </div>
</div>
<script type="text/javascript">
	function diff_minutes(dt2, dt1){
		var diffm =(dt2.getTime() - dt1.getTime()) / 1000;
		var diffh =(dt2.getHours() - dt1.getHours());
		diffm /= 60;
		var result = [ Math.abs(diffh),Math.abs(Math.round(diffm))];
		return (result);
	}


	function calc() {
		var date = <?=date('Y-m-d') ?>;
		var start = document.getElementById('clockstart').value;
		var end =  document.getElementById('clockend').value;
		if (end < start) {
			document.getElementById('clockend').value = '';
			document.getElementById('alert-free').innerHTML='<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <strong>Jam tidak valid.</strong></div>';
			document.getElementById('biaya').value = '';
		}
		else{
			dt1 = new Date(date+' '+start);
			dt2 = new Date(date+' '+end);

			var result = diff_minutes(dt1, dt2);
			if (result[0] == 0 && result[1] < 30) {
				console.log(result[0]);
			}
			else if(result[0] == 0 && result[1] >= 30){
				document.getElementById('biaya').value = '<?=$denda_ijin?>';
			}
			else if((result[0] > 0 && result[0] <= 1) || result[0] > 1){
				
				document.getElementById('biaya').value = result[0] * '<?=$denda_ijin?>';
			}
		}
	}
</script>


<script type="text/javascript">
	$('#ijinFreeformModal').on('shown.bs.modal', function () {
		$('.chosen-select').chosen("destroy");
		$('.chosen-select').chosen();
    	$('#clockstart').clockpicker({placement: 'top',donetext: 'Done'});
    	$('#clockend').clockpicker({placement: 'top',donetext: 'Done'});
	});
</script>

<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h3 class="text-center">Perijinan</h3>
			<h6 class="text-center">*jika ijin seharian, inputkan start dengan nilai jam masuk dan input end dengan nilai jam pulang</h6>
			<h6 class="text-center">*jangan lupa mengakhiri ijin dengan menekan tombol selesai</h6>
		</div>
		<div class="col-xs-12">
			<button type="button" class="btn btn-primary col-xs-12" data-toggle="modal" data-target="#ijinFreeformModal">Ijin Free form</button>
		</div>
	</div><br>
	<div class="row">
		<div class="col-xs-12" id="alert">
		</div>
	</div><br>
	<div class="panel panel-default" style="margin-top: 20px;">
	  	<div class="panel-body">
		  	<div class="row">
		  		<form  method="POST" id="form-ijin">
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
							return '<a  class="btn btn-xs btn-danger" data-idi="'+data+'" onclick="stop(this)">Stop</a>';
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
	function free(){
		var url  = "<?=base_url('Home_C/create_ijin_free/')?>";
		$('#btn_free').text('creating...'); //change button text
	    $('#btn_free').attr('disabled',true); //set button disable
	    var formData = new FormData($('#freeform')[0]);
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
	            $('#btn_free').text('Submit'); //change button text
	            $('#btn_free').attr('disabled',false); //set button enable 
	            $('#ijinFreeformModal').modal('hide');
	            show();
	        },
	        error: function (jqXHR, textStatus, errorThrown)
	        {
	            console.log(jqXHR, textStatus, errorThrown);
	            $('btn_free').text('eror'); //change button text
	            $('btn_free').attr('disabled',false); //set button enable 
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
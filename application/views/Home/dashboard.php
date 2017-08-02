
<div class="container">
	<div class="col-md-12">
        <div id="alert">
            <?=$this->session->flashdata("alert_login");?>
        </div>
		<div class="row">
			<br/>
			<div class="col-md-6">
				<!-- <h1>Selamat Datang, <?=$this->session->userdata('logged_in')['nama_k']?></h1> -->
				<h3><?=date("l,d F Y")?></h3>
			</div>
			<div class="col-md-6">
				<div class="dist">
				   <a href="<?=base_url("Home_C/view_absen")?>" class="btn btn-primary "> TAMBAH ABSENSI</a> 
				   <a href="<?=base_url("Home_C/view_ijin")?>" class="btn btn-primary ">TAMBAH IZIN</a>
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
		        	<th>id_a</th>
		        	<th>Nama</th>
		            <th>Absensi</th>
		            <th>Keterangan</th>
		            <th>Tanggal</th>
		            <th>Jam</th>
                    <th>Denda</th>
		            <th class="text-center">Status</th>
		            <th class="text-center">Pilih Aksi</th>
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
		            <th>Stop</th>
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
        	// console.log(data);
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
    			{ "data": "denda" , render: $.fn.dataTable.render.number( ',', '.', 2, 'Rp.' )},
                {"data":"acc",
                    render: function ( data, type, full, meta ) {
                        if (full.acc =='1') {
                            return '<div class="text-center">Confirmed</div>';
                        } else {
                            return '<div class="text-center">Waiting confirmation<div>';
                        }
                    }},
    			{ "data": "id_a" ,
                    render: function ( data, type, full, meta ) {
                        if (full.acc =='0') {
                            return '<div class="text-center">'+
                                        '<a data-toggle="modal" data-target="#acceptAbsenModal" title="ok" data-idaccept="'+data+'" style="margin: 0 20px 0 20px;">SETUJUI</a>'+
                                        '<a data-toggle="modal" onclick="edit(this)" data-toggle="modal" title="edit" data-target="#updateAbsenModal" data-idupdate="'+data+'" style="margin: 0 20px 0 20px;">EDIT</a>'+
                                        '<a data-toggle="modal" data-target="#rejectAbsenModal" title="tolak" data-idreject="'+data+'">HAPUS</a>'+
                                    '</div>';
                        } else {
                            return '<div class="text-center">'+
                                '<a data-toggle="modal" onclick="edit(this)" data-toggle="modal" title="edit" data-target="#updateAbsenModal" data-idupdate="'+data+'" style="margin: 0 20px 0 20px;">EDIT</a>'+
                                '<a data-toggle="modal" data-target="#rejectAbsenModal" title="tolak" data-idreject="'+data+'">HAPUS</a>'+
                                '<div>';
                        }
                    }
                }
            ],
    		paging : false,
    		aoColumnDefs: [{ "bSortable": true, "aTargets": [] }]
      		});
    	});
    	$.get('<?=base_url('Home_C/show_ijin/')?>', function(html){
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
                        ,{ "data": "id_i",
                            "render": function ( data, type, full, meta ) {
                                // console.log("data"+data);
                                // console.log("type"+type);
                                // console.log(full);
                                if (full.end == "00:00:00") {
                                    return '<a  class="btn btn-xs btn-danger" data-idi="'+data+'" onclick="stop(this)">Stop</a>';
                                }else{
                                    return '<a  class="btn btn-xs btn-success" data-idi="'+data+'" disabled>Finish</a>';
                                }
                            }
                        }
    				],
    				"paging" : false
    			});
    	    });
    }
</script>

<!-- modal reject absen -->
<div class="modal fade" id="rejectAbsenModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <form id="formreject">      
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Reject Absen</h4>
                </div>
                    <input type="hidden" name="id_del" id="idReject">
                    <div class="modal-body ">
                        Hapus absen ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">CANCEL</button>
                        <a class="btn btn-primary" id="btn-reject" >SUBMIT</a>
                    </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
$('#rejectAbsenModal').on('show.bs.modal', function(e) {
    $("#idReject").attr('value', $(e.relatedTarget).data('idreject'));
});
</script>
<!-- /modal reject absen -->

<!-- modal accept absen -->
<div class="modal fade" id="acceptAbsenModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <form id="formaccept">      
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Accept Absen</h4>
                </div>
                    <input type="hidden" name="id_acc" id="idAccept">
                    <div class="modal-body ">
                        Akan mengupdate acc menjadi telah disetujui
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">CANCEL</button>
                        <a class="btn btn-primary" id="btn-acc" >ACCEPT</a>
                    </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
$('#acceptAbsenModal').on('show.bs.modal', function(e) {
    $("#idAccept").attr('value', $(e.relatedTarget).data('idaccept'));
});
</script>
<!-- /modal accept absen -->

<!-- modal edit absen -->
<div class="modal fade" id="updateAbsenModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <form id="formupdateAbsen" method="POST">      
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Update
                </div>
                <div class="modal-body ">
                    <input type='hidden' name='u_id_a' id='idU'>
                    <input type='hidden' name='u_id_k' id='idkU'>
                    <div class='form-group'>
                        <label class='control-label'>Jam</label>
                        <div class='input-group clockpicker' data-align='top' data-autoclose='true' data-placement='bottom' id="clockabsen">
                            <input type='text' class='form-control' name='u_jam' id='jamUp'>
                            <span class='input-group-addon'>
                                <span class='glyphicon glyphicon-time'></span>
                            </span>
                        </div>
                    </div>
                    <div class='form-group'>
                        <label>tanggal</label>
                        <input type='date' class='form-control' name='u_tanggal' id='tglUp'>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Keterangan</label>
                        <select class="form-control" name="u_keterangan" id="ketUp">
                            <?php
                                // if ($status->num_rows() > 0) {
                                    foreach ($status as $row_s) {
                                        echo "<option value='".$row_s->id_s."'>".$row_s->keterangan_s."</option>";
                                    }
                                // }
                            ?>
                        </select>
                    </div>                    
                    <div class='form-group'>
                        <label>detail keterangan</label>
                        <input type='text' class='form-control' name='u_detail' id='detUp'>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Acc</label>
                        <div >
                            <select class="form-control" name="u_acc" id='accUp'>
                                <?php
                                    for ($i=0; $i <=1 ; $i++) {
                                        echo ($i == 1)?"<option value='".$i."'>sudah di acc </option>": "<option value='".$i."'>belum di acc </option>" ;
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">CANCEL</button>
                    <button type="button" class="btn btn-primary" id="btn-update">UPDATE</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
$('#btn-update').click(function() {
    $('#btn-update').text('UPDATING...');
    $('#btn-update').attr('disabled',true);
    var url;

    url = "<?php echo base_url('Acc_C/update_absensi_ku/')?>";
    var formData = new FormData($('#formupdateAbsen')[0]);
    $.ajax({
        url : url,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(data)
        {
            $("#alert").html(data);
            $('#btn-update').text('UPDATE');
            $('#btn-update').attr('disabled',false);
            $('#updateAbsenModal').modal('hide');
            show();
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            console.log(jqXHR, textStatus, errorThrown);
            $('#btn-update').text('eror');
            $('#btn-update').attr('disabled',false);
        }
    });
});
function edit(elem)
{
    $('#clockabsen').clockpicker();
    // console.log("success");
    var uida = $(elem).data('idupdate');
    //var uidk = $(elem).data('idkaryawan');
    $.get('<?php echo base_url(); ?>Acc_C/edit_absensi_ku_dariacc/' + uida, function(html){
        var object = JSON.parse(html);
        // console.log(object);
        $("#idU").val(object[0].id_a);
        $("#idkU").val(object[0].id_k);
        $("#jamUp").val(object[0].jam);
        $("#tglUp").val(object[0].tanggal);
        $("#detUp").val(object[0].detail);
        $("#accUp").val(object[0].acc);
        $("#ketUp").val(object[0].id_s);
    });
}
</script>

<!-- /modal edit absen -->


<script type="text/javascript">
	$("#btn-reject" ).click(function() {
  //alert( "woy" );
    $('#btn-reject').text('SUBMITING...'); //change button text
    $('#btn-reject').attr('disabled',true); //set button disable 
    var url;

    url = "<?php echo base_url('Acc_C/deleteAbsen/')?>";
    var formData = new FormData($('#formreject')[0]);
    // console.log(formData);
    $.ajax({
        url : url,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(data)
        {
            $("#alert").html(data);
            $('#btn-reject').text('SUBMIT'); //change button text
            $('#btn-reject').attr('disabled',false); //set button enable 
            $('#rejectAbsenModal').modal('hide');
            show();
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            console.log(jqXHR, textStatus, errorThrown);
            $('#btn-reject').text('eror'); //change button text
            $('#btn-reject').attr('disabled',false); //set button enable 

        }
    });
});

$("#btn-acc" ).click(function() {
  //alert( "woy" );
    $('#btn-acc').text('ACCEPTING...'); //change button text
    $('#btn-acc').attr('disabled',true); //set button disable 
    var url;

    url = "<?php echo base_url('Acc_C/acceptAbsen/')?>";
    var formData = new FormData($('#formaccept')[0]);
    $.ajax({
        url : url,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(data)
        {
            $("#notif").html(data);
            $('#btn-acc').text('ACCEPT'); //change button text
            $('#btn-acc').attr('disabled',false); //set button enable 
            $('#acceptAbsenModal').modal('hide');
            show();
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            console.log(jqXHR, textStatus, errorThrown);
            $('#btn-acc').text('eror'); //change button text
            $('#btn-acc').attr('disabled',false); //set button enable 
        }
    });
});
function stop(elem){
        var uidi = $(elem).data('idi');
        var url = "<?=base_url('Home_C/stop_ijin/')?>";
        var alert = document.getElementById('alert');
        $.get(url + uidi, function(html){
            uidi.innerHTML = "FINISH";
            var object = JSON.parse(html);
            alert.innerHTML = object;
        });
        show();
    }
</script>
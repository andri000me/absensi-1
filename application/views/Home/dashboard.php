<div class="container">
	<div class="col-md-12">
        <div id="alert">
            <?=$this->session->flashdata("alert_login");?>
        </div>
		<div class="row">
			<br/>
			<div class="col-md-6">
				<h1>Selamat Datang, <?=$this->session->userdata('logged_in')['nama_k']?></h1>
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
			{ "data": "denda" , render: $.fn.dataTable.render.number( ',', '.', 2, 'Rp.' )},
            {"data":"acc",
                        render: function ( data, type, full, meta ) {
                            if (full.acc =='1') {
                                return '<div class="text-center">Confirmed</div>';
                            } else {
                                return '<div class="text-center">waiting Confirmation<div>';
                            }
                        }},
			{ "data": "id_a" ,
                        render: function ( data, type, full, meta ) {
                            if (full.acc =='0') {
                                return '<div class="text-center">'+
                                            '<a data-toggle="modal" data-target="#acceptAbsenModal" title="ok" data-idaccept="'+data+'" style="margin: 0 20px 0 20px;">Setujui</a>'+
                                            '<a data-toggle="modal" data-target="#rejectAbsenModal" title="tolak" data-idreject="'+data+'">Tolak</a>'+
                                        '</div>';
                            } else {
                                return '<div class="text-center"><a data-toggle="modal" data-target="#rejectAbsenModal" title="tolak" data-idreject="'+data+'">Tolak</a><div>';
                            }
                        }
            }
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
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <a class="btn btn-primary" id="btn-reject" >Submit</a>
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
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <a class="btn btn-primary" id="btn-acc" >Acc</a>
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


<script type="text/javascript">
	$("#btn-reject" ).click(function() {
  //alert( "woy" );
    $('#btn-reject').text('rejecting...'); //change button text
    $('#btn-reject').attr('disabled',true); //set button disable 
    var url;

    url = "<?php echo base_url('Acc_C/deleteAbsen/')?>";
    var formData = new FormData($('#formreject')[0]);
    console.log(formData);
    $.ajax({
        url : url,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(data)
        {
            $("#alert").html(data);
            $('#btn-reject').text('reject'); //change button text
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
    $('#btn-acc').text('accepting...'); //change button text
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
            $('#btn-acc').text('Accept'); //change button text
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
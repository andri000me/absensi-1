
<script type="text/javascript">
window.onload = update;
function update()
{
    console.log('show_pertanggal');
    $('#lihat').text('loading...'); //change button text
    $('#lihat').attr('disabled',true); //set button disable 
    var url;
    url = "<?php echo base_url('Acc_C/show_pertanggal/')?>";
    var formData = new FormData($('#form')[0]);
    //console.log(formData);
    $.ajax({
        url : url,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(data){
            var response = JSON.parse(data);
            $('#absenpertanggal').DataTable().destroy();
            $('#ijinpertanggal').DataTable().destroy();
            $('#absenpertanggal').DataTable(
                {"data" :(response.absen),
                "columns": [
                    { "data": "id_a" },
                    { "data": "nama_k" },
                    { "data": "keterangan_s" },
                    { "data": "detail" },
                    { "data": "tanggal" },
                    { "data": "jam" },
                    { "data": "acc",
                    "render": function ( data, type, full, meta ) {
                          return data === '0' ?'<a class="btn btn-xs btn-danger">belum di acc</a>' : '<a class="btn btn-xs btn-success">sudah di acc</a>';
                    } },
                    { "data": "denda",
                        "render": $.fn.dataTable.render.number( ',', '.', 2, 'Rp.' ) },
                    { "data": "late_minute"},
                    { "data": "id_a",
                        "render": function ( data, type, full, meta ) {
                            return '<div class="btn-group">'+
                            '<a class="btn btn-xs btn-primary" data-toggle="modal" data-target="#acceptAbsenModal" title="ok" data-idaccept="'+data+'"><span class="glyphicon glyphicon-ok"></span></a>'+
                            '<a class="btn btn-xs btn-primary" onclick="edit(this)" data-toggle="modal" title="edit" data-target="#updateAbsenModal" data-idupdate="'+data+'"><span class="glyphicon glyphicon-edit"></span></a>'+
                            '<a class="btn btn-xs btn-primary" data-toggle="modal" data-target="#deleteAbsenModal" title="hapus" data-idhapus="'+data+'"><span class="glyphicon glyphicon-trash"></span></a>'+
                            '<a class="btn btn-xs btn-primary" data-toggle="modal" data-target="#rejectAbsenModal" title="tolak" data-idreject="'+data+'"><span class="glyphicon glyphicon-remove"></span></a>'+
                            '</div>';
                        }
                    }
                ],
                "columnDefs": [
                    { "width": "74px", "targets": 8 }
                ]/*,
                aoColumnDefs: [{ "bSortable": false, "aTargets": [0,2,3,4,5,6,7,8,9] }]*/
            });
            $('#ijinpertanggal').DataTable(
                {"data" :(response.ijin),
                "columns": [
                    { "data": "id_i" },
                    { "data": "nama_k" },
                    { "data": "perihal" },
                    { "data": "start" },
                    { "data": "end" },
                    { "data": "tanggal" },
                    { "data": "denda",
                        "render": $.fn.dataTable.render.number( ',', '.', 2, 'Rp.' ) },
                    { "data": "id_i",
                        "render": function ( data, type, full, meta ) {
                            return'<div class="btn-group"><a class="btn btn-xs btn-primary" data-idi="'+data+'" onclick="editIjin(this)" data-toggle="modal" data-target="#updateIjinModal"><span class="glyphicon glyphicon-edit"></span></a><a class="btn btn-xs btn-primary" data-idi="'+data+'" data-toggle="modal" data-target="#deleteIjinModal"><span class="glyphicon glyphicon-trash"></span></a></div>';
                        }
                    }
                ],
                "columnDefs": [
                    { "width": "10px", "targets": 7 }
                ]
            });

            // console.log(response.ijin);
            $('#lihat').text('Submits');
            $('#lihat').attr('disabled',false);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            console.log(jqXHR, textStatus, errorThrown);
            $('#lihat').text('eror');
            $('#lihat').attr('disabled',false);

        }
    });
}

$('#btn-update').click(function() {
    $('#btn-update').text('updating...');
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
            $("#notif").html(data);
            $('#btn-update').text('updated');
            $('#btn-update').attr('disabled',false);
            $('#updateAbsenModal').modal('hide');
            update();
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            console.log(jqXHR, textStatus, errorThrown);
            $('#btn-update').text('eror');
            $('#btn-update').attr('disabled',false);

        }
    });
});

$("#btn-delete-absen" ).click(function() {
  //alert( "woy" );
    $('#btn-delete-absen').text('deleting...');
    $('#btn-delete-absen').attr('disabled',true);
    var url;

    url = "<?php echo base_url('Acc_C/deleteAbsen/')?>";
    var formData = new FormData($('#formdeleteAbsen')[0]);
    $.ajax({
        url : url,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(data)
        {
            // var response = JSON.parse(data);
            // $.each(response , function(index,item){
            //  console.log(item.tanggal);
            // });
            $("#notif").html(data);
            // console.log(response);
            $('#btn-delete-absen').text('delets'); //change button text
            $('#btn-delete-absen').attr('disabled',false); //set button enable 
            $('#deleteAbsenModal').modal('hide');
            // $('#main').load('seminar-overview.php #main > *');
            update();
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            console.log(jqXHR, textStatus, errorThrown);
            $('#btn-delete-absen').text('eror'); //change button text
            $('#btn-delete-absen').attr('disabled',false); //set button enable 

        }
    });
});

$("#btn-reject" ).click(function() {
  //alert( "woy" );
    $('#btn-reject').text('rejecting...'); //change button text
    $('#btn-reject').attr('disabled',true); //set button disable 
    var url;

    url = "<?php echo base_url('Acc_C/rejectAbsen/')?>";
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
            // var response = JSON.parse(data);
            // $.each(response , function(index,item){
            //  console.log(item.tanggal);
            // });
            $("#notif").html(data);
            // console.log(response);
            $('#btn-reject').text('reject'); //change button text
            $('#btn-reject').attr('disabled',false); //set button enable 
            $('#rejectAbsenModal').modal('hide');
            // $('#main').load('seminar-overview.php #main > *');
            update();
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
            // var response = JSON.parse(data);
            // $.each(response , function(index,item){
            //  console.log(item.tanggal);
            // });
            $("#notif").html(data);
            // console.log(response);
            $('#btn-acc').text('Accept'); //change button text
            $('#btn-acc').attr('disabled',false); //set button enable 
            $('#acceptAbsenModal').modal('hide');
            // $('#main').load('seminar-overview.php #main > *');
            update();
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            console.log(jqXHR, textStatus, errorThrown);
            $('#btn-acc').text('eror'); //change button text
            $('#btn-acc').attr('disabled',false); //set button enable 

        }
    });
});

function edit(elem)
{
    var uida = $(elem).data('idupdate');
    //var uidk = $(elem).data('idkaryawan');
    $.get('<?php echo base_url(); ?>Acc_C/edit_absensi_ku_dariacc/' + uida, function(html){
        var object = JSON.parse(html);
        console.log(object);
        $("#idU").val(object[0].id_a);
        $("#idkU").val(object[0].id_k);
        $("#jamUp").val(object[0].jam);
        $("#tglUp").val(object[0].tanggal);
        $("#detUp").val(object[0].detail);
        $("#accUp").val(object[0].acc);
        $("#ketUp").val(object[0].id_s);
    });
}

function editIjin(elem)
{
    var uidi = $(elem).data('idi');
    $.get('<?php echo base_url(); ?>Acc_C/edit_ijin_ku_dari_acc/' + uidi, function(html){
        var object = JSON.parse(html);
        console.log(object);
        $("#idiUpdate").val(object[0].id_i);
        $("#idkUpdate").val(object[0].id_k);
        $("#namaiUpdate").val(object[0].nama_k);
        $("#tanggaliUpdate").val(object[0].tanggal);
        $("#perihaliUpdate").val(object[0].perihal);
        $("#startiUpdate").val(object[0].start);
        $("#endiUpdate").val(object[0].end);
    });
}

$("#btn-delete-ijin" ).click(function() {
    // alert( "woy" );
    $('#btn-delete-ijin').text('deleting...'); //change button text
    $('#btn-delete-ijin').attr('disabled',true); //set button disable 
    var url;

    url = "<?php echo base_url('Acc_C/delete_ijinku/')?>";
    var formData = new FormData($('#formdeleteIjin')[0]);
    $.ajax({
        url : url,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(data)
        {
            var response = JSON.parse(data);
            $("#notif").html(response);
            console.log(data);
            $('#btn-delete-ijin').text('delets'); //change button text
            $('#btn-delete-ijin').attr('disabled',false); //set button enable 
            $('#deleteIjinModal').modal('hide');
            // $('#main').load('seminar-overview.php #main > *');
            update();
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            console.log(jqXHR, textStatus, errorThrown);
            $('#btn-delete-ijin').text('eror'); //change button text
            $('#btn-delete-ijin').attr('disabled',false); //set button enable 

        }
    });
});

$('#btn-update-ijin').click(function() {
    $('#btn-update-ijin').text('updating...');
    $('#btn-update-ijin').attr('disabled',true);
    var url;

    url = "<?php echo base_url('Acc_C/update_ijin_ku/')?>";
    var formData = new FormData($('#formupdateIjin')[0]);
    $.ajax({
        url : url,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(data)
        {
            var response = JSON.parse(data);
            $("#notif").html(response);
            $('#btn-update-ijin').text('updated');
            $('#btn-update-ijin').attr('disabled',false);
            $('#updateIjinModal').modal('hide');
            update();
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            console.log(jqXHR, textStatus, errorThrown);
            $('#btn-update-ijin').text('eror');
            $('#btn-update-ijin').attr('disabled',false);

        }
    });
});

</script>

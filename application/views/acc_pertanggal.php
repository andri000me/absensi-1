

<div class="container">
    <ol class="breadcrumb">
      <li  class='active'>Acc</li>
    </ol>
    <br>
    <div id="notif"></div>
    <br>
    <form class="form-inline" method="POST" id="form">
      <div class="form-group">
        <label>Tanggal :</label>
        <input type="date" class="form-control" value="<?= date('Y-m-d'); ?>" name="vtanggal" >
      </div>
      <button type="submit" class="btn btn-primary" id="lihat" onclick="update()">Submit</button>
    </form>
    <br>
</div>  

<div class="container">
    <div id="tabel">

    </div>
</div>

<script type="text/javascript">
window.onload = update;

function update()
{
    $('#lihat').text('loading...'); //change button text
    $('#lihat').attr('disabled',true); //set button disable 
    var url;

    url = "<?php echo base_url('Acc_C/lihat_pertanggal/')?>";
    var formData = new FormData($('#form')[0]);
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
            $("#tabel").html(data);
            // console.log(response);
            $('#lihat').text('Submits'); //change button text
            $('#lihat').attr('disabled',false); //set button enable 

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            console.log(jqXHR, textStatus, errorThrown);
            $('#lihat').text('eror'); //change button text
            $('#lihat').attr('disabled',false); //set button enable 

        }
    });
}

$("#btn-delete" ).click(function() {
  //alert( "woy" );
    $('#btn-delete').text('deleting...'); //change button text
    $('#btn-delete').attr('disabled',true); //set button disable 
    var url;

    url = "<?php echo base_url('Acc_C/deleteAbsen/')?>";
    var formData = new FormData($('#formdelete')[0]);
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
            $('#btn-delete').text('delets'); //change button text
            $('#btn-delete').attr('disabled',false); //set button enable 
            $('#deleteAbsenModal').modal('hide');
            // $('#main').load('seminar-overview.php #main > *');
            update();
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            console.log(jqXHR, textStatus, errorThrown);
            $('#btn-delete').text('eror'); //change button text
            $('#btn-delete').attr('disabled',false); //set button enable 

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
    var uidk = $(elem).data('idkaryawan');
    $.get('<?php echo base_url(); ?>Acc_C/edit_absensi_ku_dariacc/' + uida+'/'+uidk, function(html){
        var object = JSON.parse(html);
        console.log(object[0]);
        $("#ketUp").val(object[0].id_s);
        $("#idkU").val(object[0].id_k);
        $("#idU").val(object[0].id_a);

        $("#jamUp").val(object[0].jam);
        $("#detUp").val(object[0].detail);
        $("#accU").val(object[0].acc);
    });
}

</script>
<div class="container" >
	<div class="row">
		<div class="distance">
			<div class="col-xs-12 text-center">
				<h2> Absensi Illiyin Studio</h2>
				<h4 id="demo3"></h4>
				<h4> <?= date('Y-m-d');?></h4>
			</div>
		</div>
	</div>
</div>
<br>
<div class="container">
	<div class="row">
		<div class="col-xs-12" id="alert">
		<?=$this->session->flashdata("alert_login");?>
		</div>
	</div>
	<div class="row">
		<div class="distance2">
		<div class="col-md-6">
	  	<div class="panel panel-default">
		  	<div class="panel-body">
		  		<form id="form-absen" method="POST">
					<div class="form-group col-xs-12">
				        <select class="chosen-select" data-placeholder="Nama Karyawan" tabindex="2" style="width: 100%" name="c_id_k">
				        <option></option>
					        <?php 
			            		foreach($nama_karyawan as $row)						            {
					              	echo '<option value="'.$row->id_k.'">'.$row->nama_k.'</option>';
					            }
					        ?>
				        </select>
					</div>
					<div class="form-group col-xs-12">
				        <select data-placeholder="Keterangan" class="chosen-select" tabindex="2" style="width: 100%;" name="c_status" onchange="myFunction()" id="keterangan">
				            <option value=""></option>
					            <?php
					            	if(isset($this->session->userdata['logged_in'])) {
							            foreach($status as $row){
								            echo '<option value="'.$row->id_s.'">'.$row->keterangan_s.'</option>';
								        }
								    }
								    else{
								    	foreach($status as $row){
								    		if ($row->keterangan_s == 'libur') {
								    			echo "";
								    		}else {
								            	echo '<option value="'.$row->id_s.'">'.$row->keterangan_s.'</option>';
								    		}
								        }
								    }
					            ?>
				        </select>
					</div>
					<div class="form-group col-xs-12" id="myDIV">
						<textarea class="form-control" placeholder="ketikkan alasan disini." name="c_detail" style="min-height: 100px;"></textarea>
					</div>
					<div class="col-xs-12">
						<a class="btn btn-primary" id="submit-absen" onclick="kirim()">Submit</a>
					</div>
				</form>
		  	</div>
		</div>
		</div>
		</div>
	</div>
</div>
<br>
<br>
<div class="container">
	<div class="table-responsive"><!--  -->
  		<table class="table  table-condensed" id="show-absenx"><!-- id="examplb" -->
  			<thead>
        		<tr>
	            	<th>id_A</th>
	            	<th>Nama karyawan</th>
	            	<th>Keterangan</th>
	            	<th>Detail</th>
	            	<th>Tanggal</th>
	            	<th>Jam</th>
	            	<th>Acc</th>
	            	<th>denda</th>
            	</tr>
        	</thead>
	        <tbody>
	        	
	        </tbody>
  		</table>
	</div>
</div>



<?php
    $date = new DateTime();
    $current_timestamp = $date->getTimestamp()+1;
?>

<script type="text/javascript">
    var x = document.getElementById('myDIV');
    x.style.display = 'none';
function myFunction() {
    if (document.getElementById("keterangan").value == '1') {
        x.style.display = 'none';
    }
     else {
        x.style.display = 'block';
    }
}
</script>

<script>
    flag = true;
    timer = '';
    setInterval(function(){phpJavascriptClock();},1000);

    function phpJavascriptClock()
    {
        if ( flag ) {
            timer = <?php echo $current_timestamp+1;?>*1000;
        }
        var d = new Date(timer);
        months = new Array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec');

        month_array = new Array('January', 'Febuary', 'March', 'April', 'May', 'June', 'July', 'Augest', 'September', 'October', 'November', 'December');

        currentYear = d.getFullYear();
        month = d.getMonth();
        var currentMonth = months[month];
        var currentMonth1 = month_array[month];
        var currentDate = d.getDate();

        var hours = d.getHours();
        var minutes = d.getMinutes();
        var seconds = d.getSeconds();

        minutes = minutes < 10 ? '0'+minutes : minutes;
        seconds = seconds < 10 ? '0'+seconds : seconds;
        var strTime = hours + ':' + minutes+ ':' + seconds;

        document.getElementById("demo3").innerHTML= strTime ;

        flag = false;
        timer = timer + 1000;
    }

</script>
<script type="text/javascript">
	window.onload=show();
	function show(){
	    $.get('<?php echo base_url('Home_C/show_absen/')?>', function(html){
	    	var data = JSON.parse(html);
	    	console.log(data[1]);
	    	$('#show-absenx').DataTable().destroy();

	    	$('#show-absenx').DataTable({
	    		data : (data),
	    		columns: [
	    		{ "data": "id_a" },
	    		{ "data": "nama_k" },
	    		{ "data": "keterangan_s" },
	    		{ "data": "detail" },
	    		{ "data": "tanggal" },
	    		{ "data": "jam" },
	    		{ "data": "acc" ,
	    			"render": function ( data, type, full, meta ) {
					      return data === '0' ?'<a class="btn btn-xs btn-danger">belum di acc</a>' : '<a class="btn btn-xs btn-success">sudah di acc</a>';
					}
				},
	    		{ "data": "denda" , render: $.fn.dataTable.render.number( ',', '.', 2, 'Rp.' )}],
			 	paging : false
			 	// render: $.fn.dataTable.render.number( ',', '.', 2, 'Rp.' )}],
	    	});
	    });
	}
	
</script>
<script type="text/javascript">
	function kirim(){
		$('#submit-absen').text('submiting...'); //change button text
	    $('#submit-absen').attr('disabled',true); //set button disable 
	    var url;

	   	url = "<?php echo base_url('Home_C/create_absen/')?>";
	    var formData = new FormData($('#form-absen')[0]);
	    $.ajax({
	        url : url,
	        type: "POST",
	        data: formData,
	        contentType: false,
	        processData: false,
	        success: function(data)
	        {

	            $("#alert").html(data);
	            // console.log(data);
	            $('#submit-absen').text('Submits'); //change button text
	            $('#submit-absen').attr('disabled',false); //set button enable 
	            show();

	        },
	        error: function (jqXHR, textStatus, errorThrown)
	        {
	            console.log(jqXHR, textStatus, errorThrown);
	            $('#submit-absen').text('eror'); //change button text
	            $('#submit-absen').attr('disabled',false); //set button enable 

	        }
	    });
	    show();
	}
</script>
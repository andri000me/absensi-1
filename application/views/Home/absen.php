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
		<div class="col-xs-10 col-xs-push-1 col-sm-4 col-sm-push-4 center-block" id="alert">
		<?=$this->session->flashdata("alert_login");?>
		</div>
	</div>

	<div class="row">
		<div class="center-block">
			<div class="col-xs-10 col-xs-push-1 col-sm-4 col-sm-push-4">
			  	<div class="panel panel-default">
				  	<div class="panel-body">
				  		<form id="form-absen" method="POST">
							<div class="form-group col-xs-12">
						        <select class="chosen-select" data-placeholder="Nama Karyawan" tabindex="2" style="width: 100%;" name="c_id_k" required="required">
						        <option></option>
							        <?php
					            		foreach($nama_karyawan as $row)						            {
							              	echo '<option value="'.$row->id_k.'">'.$row->nama_k.'</option>';
							            }
							        ?>
						        </select>
							</div>
							<div class="form-group col-xs-12">
								<input type="password" name="c_password" class="form-control" required="required" placeholder="password">
							</div>
							<div class="form-group col-xs-12">
						        <select data-placeholder="Keterangan" class="chosen-select" tabindex="2" style="width: 100%;" name="c_status" onchange="myFunction()" id="keterangan" required="required">
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
								<a class="btn btn-primary col-xs-12" id="submit-absen" onclick="kirim()">Submit</a>
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
	            console.log(data);
	            $('#submit-absen').text('Submits'); //change button text
	            $('#submit-absen').attr('disabled',false); //set button enable 
	        },
	        error: function (jqXHR, textStatus, errorThrown)
	        {
	            console.log(jqXHR, textStatus, errorThrown);
	            $('#submit-absen').text('eror'); //change button text
	            $('#submit-absen').attr('disabled',false); //set button enable 

	        }
	    });
	    // show();
	}
</script>
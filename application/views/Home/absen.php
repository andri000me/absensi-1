<script type="text/javascript">
$(document).ready(function()
{
	
	// console.log(arrst[1][1]);
	$('#sign').tooltip();
	$('#freeform').submit(function(event) {
		event.preventDefault();
		var url  = "<?=base_url('Home_C/create_absen_free/')?>";
		// $('#btn_free').text('creating...'); //change button text
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
	        	// var object = JSON.parse(data);
	        	// $("#alert-free").html("<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>"+object+"</strong></div>");
	            // console.log(data);
	            $("#alert-free").html(data);
	            // $('#btn_free').text('Submit'); //change button text
	            $('#btn_free').attr('disabled',false); //set button enable 
	        },
	        error: function (jqXHR, textStatus, errorThrown)
	        {
	            console.log(jqXHR, textStatus, errorThrown);
	            $('btn_free').text('eror'); //change button text
	            $('btn_free').attr('disabled',false); //set button enable 
	        }
	    });
	});

	$('#form-absen').submit(function(event) {
		event.preventDefault();
		// $('#submit-absen').text('submiting...'); //change button text
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
	            // $('#submit-absen').text('Submit'); //change button text
	            $('#submit-absen').attr('disabled',false); //set button enable 
	        },
	        error: function (jqXHR, textStatus, errorThrown)
	        {
	            console.log(jqXHR, textStatus, errorThrown);
	            $('#submit-absen').text('eror'); //change button text
	            $('#submit-absen').attr('disabled',false); //set button enable 

	        }
	    });
	});
});
</script>
<?php
// echo "<pre>";
// var_dump($array_status1);
// echo "</pre>";
?>
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
					            		foreach($nama_karyawan as $row){
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
									    	if ($this->session->userdata('logged_in') == null) {
									    		foreach($status as $row){
									    			if ($row->id_s != 2) {
									            		echo '<option value="'.$row->id_s.'">'.$row->keterangan_s.'</option>';
									    			}
									        	}
									    	}else{
									    		foreach($status as $row){
									            	echo '<option value="'.$row->id_s.'">'.$row->keterangan_s.'</option>';
									        	}
									    	}
							            ?>
						        </select>

							</div>
							<div class="form-group col-xs-12" >
								<textarea class="form-control" placeholder="ketikkan alasan disini." name="c_detail" style="min-height: 100px;" id="myDIV"></textarea>
							</div>
							<div class="col-xs-12">
								<button class="btn btn-primary col-xs-12" id="submit-absen" type="submit"> <span class="glyphicon glyphicon-send" aria-hidden="true"></span> Submit</button>
							</div>
						</form>
				  	</div>
				</div>
				<?php if (isset($this->session->userdata('logged_in')['hak_akses'])){
					?>
					<div class="modal fade" id="absenFreeformModal">
					    <div class="modal-dialog" role="document">
					        <div class="modal-content">
					        	<div class="modal-header">
					            	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					            	<h4 class="modal-title" id="myModalLabel">Absen free form</h4>
					          	</div>
					        	<form class="form-horizontal" method="POST" id="freeform">
					          		<div class="modal-body">
					          			<div class="form-group">
						              		<div class=" col-xs-12">
					        					<h5 class="text-center"> *Atur value absen secara manual.</h5><br>
					          					<div id="alert-free"></div>	
						                  		<select class="chosen-select" data-placeholder="Nama Karyawan" name="c_id_k" required="required" style="width: 100%">
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
					          					<div class="input-group">
											        <select placeholder="Keterangan" class="form-control" name="c_status" onchange="generate_detail()"  required="required" id="keteranganfree">
											        	<option></option>
											            <?php
													    	foreach($status as $row){
													            echo '<option value="'.$row->id_s.'">'.$row->keterangan_s.'</option>';
													        }
											            ?>
								            		</select>
								            		<!-- <div class="input-group-addon" id="sign" data-toggle="tooltip" data-placement="left" title=""> -->
													<div class="input-group-addon" id="sign" data-toggle="tooltip" data-placement="left" >
														<span class="glyphicon glyphicon-question-sign" ></span> <!-- $('#id').attr('title','') -->
													</div>
					          					</div>
						            		</div>
										</div>
					              		<div class='form-group'><div class='col-xs-12'>
					                        <label class='control-label'>Jam</label>
					                        <div class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true" >
											    <input type="text" class="form-control" name="c_jam" id="clock" onchange="generate_detail()" required="required">
											    <span class="input-group-addon" >
											        <span class="glyphicon glyphicon-time"></span>
											    </span>
											</div>
											</div>
					                    </div>
					                    <div class='form-group'><div class='col-xs-12'>
					                        <label class='control-label'>Tanggal</label>
											<input type="date" class="form-control" name="c_tanggal" id="tanggal" onchange="generate_detail()" required="required">
											</div>
					                    </div>
					              		<div class="form-group"  >
					              			<div class="col-xs-12">
						              			<label class='control-label'>detail</label>
						                  		<textarea class="form-control" name="c_detail"  style="min-height: 50px;" required="required" id="myDIVfree"></textarea>
					              			</div>
					              		</div>
										
										<script type="text/javascript">
											var xf = document.getElementById('myDIVfree');
					    					xf.style.display = 'none';
										</script>
					              		
						          	</div>
						          	<div class="modal-footer">
						            	<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
						            	<button type="submit" class="btn btn-primary"  id="btn_free"> <span class="glyphicon glyphicon-send" aria-hidden="true"></span> Submit</button> <!-- onclick="free()" -->
						          	</div>
					        	</form>
					        </div>
						</div>
					</div>
					<button type="button" class="btn btn-primary col-xs-12" data-toggle="modal" data-target="#absenFreeformModal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Absen Free form</button>
					<?php
				}
				?>
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
	var arrst  = JSON.parse('<?=$arrst?>');
    var x = document.getElementById('myDIV');
    x.style.display = 'none';
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

	$('#sign').attr('data-original-title',"Isikan keterangan terlebih dahulu. Lalu lihat infonya disini").tooltip('fixTitle');
    function generate_detail() 
    {
	    var z = document.getElementById('clock');
	    
    	if (document.getElementById("keteranganfree").value == 1) {
    		if (z.value != '') {
		    	xf.style.display = 'block';
		    	var jam_masuk = "<?=$jam_masuk?>";
		    	var jam_pulang = "<?=$jam_pulang?>";
		    	if (z.value > jam_masuk && z.value<jam_pulang) {
		    		$('#myDIVfree').attr("readonly","readonly");
		    		xf.value = 'telat';
		    	} else if(z.value < jam_masuk) {
		    		$('#myDIVfree').attr("readonly","readonly");
		    		xf.value = 'tepat waktu';
		    	}else if(z.value > jam_pulang){
		    		z.value='';
		    		document.getElementById('alert-free').innerHTML='<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <strong>Jam tidak valid.</strong></div>';
	    			xf.value = '';
		    	}
		    	x.style.display = 'none';
    		}
			$('#sign').attr('data-original-title', arrst[1][1]).tooltip('fixTitle');
			console.log($('#sign').attr('title'));

	    }
	    else if (document.getElementById("keteranganfree").value == 2) {
    		if (z.value != '') {
		    	xf.style.display = 'block';
	    		$('#myDIVfree').attr("readonly","readonly");
	    		xf.value = 'other';
		    	x.style.display = 'none';
    		}
    		$('#sign').attr('data-original-title',arrst[2][1]).tooltip('fixTitle');
	    }
		else if(document.getElementById("keteranganfree").value == 3){
			$('#myDIVfree').attr("readonly",false);
			xf.value = '';
			x.style.display = 'none';
			xf.style.display = 'block';
			xf.disabled = '';
			$('#sign').attr('data-original-title',arrst[3][1]).tooltip('fixTitle');
		}
		else if(document.getElementById("keteranganfree").value == 4){
			$('#myDIVfree').attr("readonly",false);
			xf.value = '';
			x.style.display = 'none';
			xf.style.display = 'block';
			xf.disabled = '';
			$('#sign').attr('data-original-title',arrst[4][1]).tooltip('fixTitle');
		}
		else if(document.getElementById("keteranganfree").value == 5){
			$('#myDIVfree').attr("readonly",false);
			xf.value = '';
			x.style.display = 'none';
			xf.style.display = 'block';
			xf.disabled = '';
			$('#sign').attr('data-original-title',arrst[5][1]).tooltip('fixTitle');
		}
	    else if(document.getElementById("keteranganfree").value == ''){
	        xf.style.display = 'none';
	    }
	    if (z.value != '') {
		    if (document.getElementById("tanggal").value == '0000-00-00' || document.getElementById("tanggal").value == '0001-01-01') {
		    	document.getElementById('alert-free').innerHTML='<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <strong>Tanggal tidak valid.</strong></div>';
		    	return false;
		    }
	    }
    }
    function myFunction() 
    {
	    if (document.getElementById("keterangan").value == '1') {
	        x.style.display = 'none';
	    }
	    else if(document.getElementById("keterangan").value == 2){
	    	x.style.display = "block";
	    	$('#myDIV').attr("readonly","readonly");
		    x.value = 'other';
	    }
	     else {
	        x.style.display = 'block'
	        $('#myDIV').attr("readonly",false);
	        // $('#myDIVfree').attr("required",true);
	    }
	}
	$('#absenFreeformModal').on('shown.bs.modal', function () {
		$('.chosen-select').chosen("destroy");
		$('.chosen-select').chosen();
    	$('.clockpicker').clockpicker({placement: 'bottom'});
	});
</script>
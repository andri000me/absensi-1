<div class="container" >
	<div class="row">
		<div class="col-xs-12 text-center"><h4 id="demo3"></h4> </div>
		<div class="col-xs-12 text-center"><h4> <?=date('Y-m-d');?></h4> </div>
	</div>
</div>
<br>
<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<?=$this->session->flashdata("notifikasi")?>
			<?=$this->session->flashdata("alert_login_validate")?>
			<?=$this->session->flashdata("alert_login")?>
		</div>
	</div>
	<div class="panel panel-default" style="margin-top: 20px;">
	  	<div class="panel-body">
		  	<div class="row">
		  		<form action="<?php echo base_url();?>Home_C/create_absen" method="POST" enctype="multipart/form-data">
					<div class="form-group col-xs-12" >
				        <select class="chosen-select" data-placeholder="Nama Karyawan" tabindex="2" style="width: 100%" name="c_id_k">
				        <option></option>
					        <?php 
					            if(isset($this->session->userdata['logged_in'])) {
					            	if ($this->session->userdata('logged_in')['hak_akses'] == 3) {
						            	$aku = $this->session->userdata('logged_in')['id_k'];
							            foreach($nama_karyawan as $row)							            {
							            	if ($row->id_K == $aku) {
							              		echo '<option value="'.$row->id_k.'">'.$row->nama_k.'</option>';
							            	}
							            }
					            	}else{
					            		foreach($nama_karyawan as $row)							            {
							              	echo '<option value="'.$row->id_k.'">'.$row->nama_k.'</option>';
							            }
					            	}
						        }
						        else{
				            		foreach($nama_karyawan as $row)						            {
						              	echo '<option value="'.$row->id_k.'">'.$row->nama_k.'</option>';
						            }
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
						<textarea class="form-control" placeholder="ketikkan alasan disini." name="c_detail" value="<?php echo set_value('c_detail'); ?>" style="min-height: 100px;"></textarea>
					</div>
					<div class="col-xs-12">
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
				</form>
		  	</div>
		</div>
	</div>
</div>


<div class="container">
	<div class="table-responsive">
  		<table class="table  table-condensed">
  			<thead>
        		<tr>
	            	<th>id_A</th>
	            	<th>Nama karyawan</th>
	            	<th>Keterangan</th>
	            	<th>Detail</th>
	            	<th>Tanggal</th>
	            	<th>Jam</th>
	            	<th>Acc</th>
            	</tr>
        	</thead>
	        <tbody>
	        	<?php 
	        	foreach ($absen as $row) {
	        		echo "<tr>";
	        		echo "<td>".$row->id_a."</td>";
	        		echo "<td>".$row->nama_k."</td>";
	        		echo "<td>".$row->keterangan_s."</td>";
	        		echo "<td>".$row->detail."</td>";
	        		echo "<td>".$row->tanggal."</td>";
	        		echo "<td>".$row->jam."</td>";
	        		echo "<td>".$row->acc."</td>";
	        		echo "</tr>";
	        	}
	        	?>
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
<div class="container" >
	<div class="row">
		<div class="col-xs-12 text-center"><h4 id="demo3"></h4> </div>
		<div class="col-xs-12 text-center"><h4> <?=date('Y-m-d');?></h4> </div>
	</div>
</div>
<br>
<div class="container">
	<div class="row">
		<div class="col-xs-12" id="alert">

		</div>
	</div>
	<div class="panel panel-default" style="margin-top: 20px;">
	  	<div class="panel-body">
		  	<div class="row">
		  		<form  id="form-absen" method="POST">
					<div class="form-group col-xs-12" >
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
<!--   <script type="text/javascript">
    $(document).ready(function() {
        $('#examplb').DataTable({
        	paging:false
        });
    });
  </script> -->
<br>
<br>
<div class="container">
	<div class="table-responsive">
  		<table class="table  table-condensed" ><!-- id="examplb" -->
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
	        <tbody id="show-absen">
	        	
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
<?php
  //   		echo "<tr>";
  //   		echo "<td>".$row->id_a."</td>";
  //   		echo "<td>".$row->nama_k."</td>";
  //   		echo "<td>".$row->keterangan_s."</td>";
  //   		echo "<td>".$row->detail."</td>";
  //   		echo "<td>".$row->tanggal."</td>";
  //   		echo "<td>".$row->jam."</td>";
  //   		echo ($row->acc ==1)?"<td class='btn btn-sm btn-success'>Sudah di acc</td>":"<td class='btn btn-xs btn-danger'>belum di acc</td>";
  //   		// echo "<td>".$row->denda."</td>";
  //   		echo "<td> Rp " . number_format($row->denda,2,',','.')."</td>";
  //   		echo "</tr>";
?>
<script type="text/javascript">
	window.onload=show();
	function show(){
	    $.get('<?php echo base_url('Home_C/show_absen/')?>', function(html){
	    	// console.log(html);
	    	var data = JSON.parse(html);
	    	// console.log(data);
	    	var output = document.getElementById('show-absen');
	    	var element = '';
	    	for(var x in data){
	    		if (+data[x].acc == 1) {
	    			element += "<tr><td>"+data[x].id_a+"</td><td>"+data[x].nama_k+"</td><td>"+data[x].keterangan_s+"</td><td>"+data[x].detail+"</td><td>"+data[x].tanggal+"</td><td>"+data[x].jam+"</td><td class='btn btn-xs btn-success'>Sudah di acc</td><td>Rp."+data[x].denda+"</td></tr>";
	    		} else {
	    			element += "<tr><td>"+data[x].id_a+"</td><td>"+data[x].nama_k+"</td><td>"+data[x].keterangan_s+"</td><td>"+data[x].detail+"</td><td>"+data[x].tanggal+"</td><td>"+data[x].jam+"</td><td class='btn btn-xs btn-danger'>Belum</td><td> Rp."+data[x].denda+"</td></tr>";
	    		}
	    		
	    	}
	    	console.log(element);
	    	output.innerHTML = element;
	    	// $('#show-absen').html(html);
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
	            // var response = JSON.parse(data);
	            // $.each(response , function(index,item){
	            //  console.log(item.tanggal);
	            // });
	            $("#alert").html(data);
	            console.log(data);
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
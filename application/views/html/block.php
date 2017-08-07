<div class="container">
	<?=$this->session->flashdata("alert_login");?>
    <?=$this->session->flashdata("alert_login_validate");?>
	<div class="col-xs-12">
		<h3 id="demo3" class="text-center"></h3>
		<h3 id="demo2" class="text-center"></h3>
		<h1 class="text-center">Hari ini tanggal merah</h1>
		<h4 class="text-center"><a class="btn btn-primary" data-toggle="modal" data-target="#loginModal" >Login</a> </h4>
	</div>
</div>

<?php
    $date = new DateTime();
    $current_timestamp = $date->getTimestamp()+1;
?>
<script type="text/javascript">
	flag = true;
    timer = '';
    setInterval(function(){phpJavascriptClock();},1000);
    function phpJavascriptClock()
    {
	    if ( flag ) {
	        timer = <?php echo $current_timestamp+1;?>*1000;
	    }
		var d = new Date(timer);
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
	if ( flag ) {
	    timer = <?php echo $current_timestamp+1;?>*1000;
	}
	var d = new Date(timer);

	// months = new Array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec');
	month_array = new Array('Januari', 'Februari', 'Maret', 'April', 'May', 'June', 'July', 'Agustus', 'September', 'Oktober', 'November', 'December');
	currentYear = d.getFullYear();
	month = d.getMonth();
	// var currentMonth = months[month];
	var currentMonth1 = month_array[month];
	var currentDate = d.getDate();
	strDate = currentDate+'-'+currentMonth1+'-'+currentYear;
	document.getElementById("demo2").innerHTML= strDate ;
</script>
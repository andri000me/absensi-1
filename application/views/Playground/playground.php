<div class="container">
<?php
$date = new DateTime();
$current_timestamp = $date->getTimestamp();
echo $current_timestamp."<br>";
$time1 = strtotime(date("H:i:s")) +1;
echo $time1;
?>
<h4 id="demo3"></h4>
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
</div>

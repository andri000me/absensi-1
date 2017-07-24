<div class="container">
	<script type="text/javascript">
		function diff_minutes(dt2, dt1){
			var diffm =(dt2.getTime() - dt1.getTime()) / 1000;
			var diffh =(dt2.getHours() - dt1.getHours());
			diffm /= 60;
			var result = [ Math.abs(diffh),Math.abs(Math.round(diffm))];
			return (result);
		}
		var date = <?=date('Y-m-d') ?>;
		var end = "11:00";
		var start = "11:30";
		
		dt1 = new Date(date+' '+start);
		dt2 = new Date(date+' '+end);

		var result = diff_minutes(dt1, dt2);
		if (result[0] == 0 && result[1] < 30) {
			console.log(result[0]);
		}
		else if(result[0] == 0 && result[1] >= 30){
			console.log(3000);
		}
		else if((result[0] > 0 && result[0] <= 1) || result[0] > 1){
			console.log(result[0]);
			console.log((result[0] * 3000));
		}
	</script>
</div>

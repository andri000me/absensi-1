<div class="container">
	<div class="col-xs-12" >
		<h2>Laporan Absensi Harian</h2><br>

		<form action="<?php echo base_url('Overview_C/lihat/hari')?>" method="POST" class="form-inline" role="form" >
			<div class="form-group">
				<label class="col-sm-3 control-label">Tanggal</label>
			    <div class="col-sm-5">
					<input type="date" name="l_hari" class="form-control ">
			    </div>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary">SUBMIT</button>
				<button class="btn btn-primary" id="print_btn" ><span class="glyphicon glyphicon-print" aria-hidden="true"></span> CETAK</button>
			</div>
		</form>
	</div>
</div>	

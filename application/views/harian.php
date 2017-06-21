	<div class="col-xs-12 col-sm-8 col-sm-push-1" >
	
	<h4>Laporan Absensi Harian</h4><br>

		<form action="<?php echo base_url('Overview_C/lihat/hari')?>" method="POST" class="form-horizontal" role="form" >
			<div class="form-group">
				<label class="col-sm-3 control-label">Tanggal</label>
			    <div class="col-sm-5">
					<input type="date" name="l_hari" class="form-control " required="required">
			    </div>
			</div>
			<div class="form-group">
				<div class="col-sm-10 col-sm-offset-1">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</div>
		</form>
	</div>
</div>	

	<div class="col-xs-12 col-sm-8 col-sm-push-1" >
	
	<h4>Laporan Absensi Bulanan</h4><br>
		<form action="<?php echo base_url('overview_c/lihat/bulan')?>" method="POST" class="form-horizontal" role="form" >
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-3 control-label">Tahun</label>
			    <div class="col-sm-5">
                	<select class="form-control" data-placeholder="Nama Karyawan"  name="l_tahun">
                		<?php $date = date('Y'); 
                			for($x = $date; $x>=2017; $x--) { ?>
			        	<option value="<?php echo $x;?>"><?php echo $x; ?></option>
			        	<?php } ?>
				    </select>
			    </div>
			</div>
			<div class="form-group">
				<label  class="col-sm-3 control-label">Bulan</label>
			    <div class="col-sm-5">
                	<select class="form-control" data-placeholder="Nama Karyawan"  name="l_bulan">
			        	<option value="01">Januari </option>
			        	<option value="02">Februari </option>
			        	<option value="03">Maret </option>
			        	<option value="04">April </option>
			        	<option value="05">Mei </option>
			        	<option value="06">Juni </option>
			        	<option value="07">Juli </option>
			        	<option value="08">Agustus </option>
			        	<option value="09">September </option>
			        	<option value="10">Oktober </option>
			        	<option value="11">November </option>
			        	<option value="12">Desember </option>
				    </select>
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

<div class="container">
	<div class="row">
	    <div class="col-sm-3 col-xs-12">
	    	<br/><h2>Stasistik Bulanan</h2>
	    	<h4>Juli 2015</h4>	
	    </div>
	<div style="margin-top: 50px">
		
	    <div class="col-sm-2" style="padding-bottom: 20px">
	    	<select class="form-control" data-placeholder="Nama Karyawan"  name="l_tahun">
            	<?php $date = date('Y'); 
            		for($x = $date; $x>=2017; $x--) { ?>
                <option value="00">Pilih Tahun</option>
			    <option value="<?php echo $x;?>"><?php echo $x; ?></option>
			    <?php } ?>
			</select>
	    </div>
	    <div class="col-sm-2" style="padding-bottom: 20px">
	    	<select class="form-control" data-placeholder="Nama Karyawan"  name="l_bulan" >
                <option value="00">Pilih Bulan </option>
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
	    <div class="col-sm-2 col-xs-6" style="padding-bottom: 20px">
	    	<button type="submit" class="btn btn-primary col-sm-12 col-xs-12">TAMPILKAN</button>
	    <!-- <hr class="vertical-line hidden-xs"> -->
	    </div>
	    <div class="col-sm-2 col-xs-6" style="padding-bottom: 20px">
	    	<button class="btn btn-primary col-sm-12 col-xs-12" id="print_btn" >CETAK</button>
	    </div>
	</div>
	</div>
</div>
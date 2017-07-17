	<!-- <div class="col-xs-12 col-sm-8 col-sm-push-1" >

		
	
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
	</div> -->

	<!-- start content -->
	<div class="col-sm-12">
		<div class="container">
		    <div class="col-sm-3">
		    	<br/><h2>Stasistik Bulanan</h2>
		    	<h4>Juli 2015</h4>	
		    </div>

		    <div class="col-sm-3"></div>
			<form action="<?php echo base_url('Overview_C/lihat/bulan')?>" method="POST" class="form-horizontal" role="form" >
			    <div class="col-sm-2 distance">
		            <select class="form-control" data-placeholder="Nama Karyawan"  name="l_tahun">
		            	<?php $date = date('Y'); 
		            		for($x = $date; $x>=2017; $x--) { ?>
		                <option value="00">Pilih Tahun</option>
					    <option value="<?php echo $x;?>"><?php echo $x; ?></option>
					    <?php } ?>
					</select>
				</div>
				<div class="col-sm-2 distance">
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
			    <div class="col-sm-1 distance">
			    	<button type="submit" class="btn btn-primary">TAMPILKAN</button>
			    </div> 
			</form>
		    <div class="col-sm-1 distance">
		    	<hr class="vertical-line">
		    	<button  class="btn btn-primary btn-laporan distance2" id="print_btn" >CETAK</button>
		    </div>	    
	    </div>
    </div>
    <hr class="horizontal-line">


    <div class="col-sm-12">
    	<div class="container">
	    	<div class="col-sm-2">
			    <br/><p>Total Denda</p>
			    <h4>Rp 768.000</h4>	
			</div>
			<div class="col-sm-2">
			    <br/><p>Rata2 Keterlambatan</p>
			    <h4>25 Menit</h4>	
			</div>
			<div class="col-sm-4"></div>
			<div class="col-sm-2">
			    <br/><p>Rangking 1</p>
			    <h4>Ibnu Shodiqin</h4>	
			</div>
			<div class="col-sm-2">
			    <br/><p>Rangking Terakhir</p>
			    <h4>M. HandharBeni</h4>	
			</div>

		</div>	
		<hr class="horizontal-line">

    </div>

    <hr>
    <!-- tabel -->           
	<div class="col-sm-12 distance-tabel">
		<div class="container">
		        <div class="table-responsive">
		        	<table class="table table-condensed" id="table">
		                <thead>
		                    <tr>
		                        <th>Nama</th>
		                        <th>Absensi</th>
		                        <th>Keterangan</th>
		                        <th>Tanggal</th>
		                        <th>Jam</th>
		                        <th>Denda</th>
		                        <th colspan="2">Pilih Aksi</th>

		                    </tr>
		                </thead>
		                <tbody>
		                    <tr class="table-flag-blue">
		                        
		                        <td></td>
		                        <td></td>
		                        <td></td>
		                        <td></td>
		                        <td></td>
		                        <td></td>
		                        <td><a href="">Setuju</a></td>
		                        <td><a href="">Tidak</a></td>
		                    </tr>

		                   
		                </tbody>
		            </table>
		        </div>
		    </div>
	    </div>


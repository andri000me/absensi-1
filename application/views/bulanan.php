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
		<div class="box">
		    <div class="col-sm-4">
		    	<br/><h1>Stasistik Bulanan</h1>
		    	<h3>Juli 2015</h3>	
		    </div>
		    <div class="col-sm-6">
		    	<botton class="btn btn-primary btn-lg">Pilih Bulan</botton>
		    	<botton class="btn btn-primary btn-lg">Pilih Tahun</botton>
		    	<botton  class="btn btn-primary btn-lg">Tampilkan</botton>
		    	<botton  class="btn btn-primary btn-lg">Cetak</botton >
		    </div>  
		    <!-- <div class="col-sm-1"><botton  class="btn btn-primary btn-lg">Tampilkan</botton ></div>  
		    <div class="col-sm-1"><botton  class="btn btn-primary btn-lg">Cetak</botton ></div>   -->
	    </div>

    </div>   
    <div class="col-sm-12">
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
    <br>
	<br>
	<br>
    
    <!-- tabel -->           
	<div class="col-sm-12">
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
		                        
		                        <td><a href="">94633</a></td>
		                        <td>11/05/2017</td>
		                        <td>17/05/2017</td>
		                        <td>Rp. 160.000,00</td>
		                        <td>Rp. 667,00</td>
		                        <td>Waiting Confirmation</td>
		                        <td><a href="">Setuju</a></td>
		                        <td><a href="">Tidak</a></td>
		                    </tr>

		                    <tr class="table-flag-blue">
		                        
		                        <td><a href="">96633</a></td>
		                        <td>11/05/2017</td>
		                        <td>17/05/2017</td>
		                        <td>Rp. 224.000,00</td>
		                        <td>Rp. 667,00</td>
		                        <td>Waiting Confirmation</td>
		                        <td><a href="">Setuju</a></td>
		                        <td><a href="">Tidak</a></td>
		                    </tr>        
		                </tbody>
		            </table>
		        </div>
		    </div>
	    </div>

			<script type="text/javascript">
                $(document).ready( function() {
                    $('#table').dataTable( {
                        "aoColumnDefs": [
                          { "bSortable": true, "aTargets": [ 7 ] }
                        ] } );
                    
                } );
            </script>  

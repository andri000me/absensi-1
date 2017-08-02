	<div class="container">
		<div class="col-sm-12">
			<div class="row">
			    <div class="col-sm-3">
			    	<br/><h2>Stasistik Bulanan</h2>
			    	<h4><?= $_POST['']; ?>Juli 2015</h4>	
			    </div>
			    <div class="col-sm-2"></div>
			    
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
		            <select class="form-control" data-placeholder="Nama Karyawan"  name="l_bulan">
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
			    	<botton  class="btn btn-primary btn-laporan">TAMPILKAN</botton>
			    </div> 
			    <div class="col-sm-1 distance">
			    	<hr class="vertical-line">
			    </div>
			 
			    <div class="col-sm-1 distance">
			    	
			    	<botton  class="btn btn-primary btn-laporan"> <span class="glyphicon glyphicon-print" aria-hidden="true"></span> CETAK</botton >
			    </div>	
			</div>        
	    </div>
	    <hr class="horizontal-line">
    </div>  
    

    <div class="container">
    	<div class="col-sm-12">
    		<div class="row">
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
		</div>	
		<hr class="horizontal-line">

    </div>

    
    <!-- tabel -->           
	<div class="container">
		<div class="col-sm-12 distance-tabel">
			<div class="row">
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
	    </div>

			<script type="text/javascript">
                $(document).ready( function() {
                    $('#table').dataTable( {
                        "aoColumnDefs": [
                          { "bSortable": true, "aTargets": [ 7 ] }
                        ] } );
                    
                } );
            </script>  

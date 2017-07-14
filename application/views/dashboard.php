<div class="container">
	<div class="col-md-12">
		<div class="row">
			<br/>
			<div class="col-md-6">
				<h1>Selamat Datang, -nama user-</h1>
				<h3>Juli 2015</h3>		
			</div>
			<div class="col-md-6">
				<div class="dist">
					<button class="btn btn-primary btn-lg">TAMBAH ABSENSI</button>
					<button class="btn btn-primary btn-lg">TAMBAH IZIN</button>
				</div>
			</div>
		</div>
	</div>
	<br/>
	<br/>
	<br/>
	<div class="col-md-12 dist">
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
            	"aoColumnDefs": [ { "bSortable": true, "aTargets": [ 7 ] } ]
            } );    
        } );
    </script>
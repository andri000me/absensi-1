<script type="text/javascript">
	$( document ).ready(function() {
		$('#perbulan').val('<?=$tahun.'-'.$bulan?>');
	});
</script>
<div class="container">
    <ol class="breadcrumb">
      <li  class='active'>Acc </li>
    </ol>
    <br>
    <div id="notif"></div>
    <br>
    <form class="form-inline" method="POST" id="form">
      <div class="form-group">
        <label>Bulan : <?= $tahun.'-'.$bulan?></label>
        <select class="form-control" name="vtanggal" id="perbulan">
			<option value='<?=$tahun?>-01'>Januari</option>
			<option value='<?=$tahun?>-02'>Februari</option>
			<option value='<?=$tahun?>-03'>Maret</option>
			<option value='<?=$tahun?>-04'>April</option>
			<option value='<?=$tahun?>-05'>Mei</option>
			<option value='<?=$tahun?>-06'>juni</option>
			<option value='<?=$tahun?>-07'>juli</option>
			<option value='<?=$tahun?>-08'>agustus</option>
			<option value='<?=$tahun?>-09'>september</option>
			<option value='<?=$tahun?>-10'>oktober</option>
			<option value='<?=$tahun?>-11'>november</option>
			<option value='<?=$tahun?>-12'>desember</option>
		</select>
      </div>
      <button type="submit" class="btn btn-primary" id="lihat" onclick="update()">Submit</button>
    </form>
    <br>
</div>
<div class="container">
    <div>
        <h2>ABSEN</h2>
        <div class='table-responsive'>
            <table class='table  table-condensed' id='absenpertanggal'>
                <thead>
                    <tr>
                        <th>id</th>
                        <th>nama</th>
                        <th>keterangan</th>
                        <th>detail</th>
                        <th>tanggal</th>
                        <th>jam</th>
                        <th>acc</th>
                        <th>denda</th>
                        <th class='text-center'>action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
<br>
<br>
<br>
<div class="container">
    <div>
        <h2>IJIN</h2>
        <div class='table-responsive'>
            <table class='table  table-condensed' id='ijinpertanggal'>
                <thead>
                    <tr>
                        <th>id</th>
                        <th>nama</th>
                        <th>detail</th>
                        <th>start</th>
                        <th>end</th>
                        <th>tanggal</th>
                        <th>denda</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

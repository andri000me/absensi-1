<script type="text/javascript">
	$( document ).ready(function() {
        $('#perbulan').val('<?=substr(date("Y-m-d"),-5,2)?>');
		$('#pertahun').val('<?=substr(date("Y-m-d"),-10,4)?>');
	});
</script>
<div class="container">
    <ol class="breadcrumb">
      <li  class='active'>Acc </li>
    </ol>
    <br>
    <div id="notif"></div>
    <br>
    <div class="row no-print">
        <div class="col-sm-3 col-xs-12">
            <h2>Statistik Bulanan</h2>
        </div>
        <div class="col-sm-9" style="margin-top: 40px">
            <form method="POST" class="form-horizontal" id="form" >
                <div class="col-sm-3 col-sm-push-2" style="padding-bottom: 10px">
                    <select class="form-control" name="vtahun" id="pertahun">
                        <?php $date = date('Y'); 
                            for($x = $date; $x>=2017; $x--) { ?>
                        <option value="00">Pilih Tahun</option>
                        <option value="<?php echo $x;?>"><?php echo $x; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-sm-3 col-sm-push-2" style="padding-bottom: 10px">
                    <select class="form-control" name="vbulan" id="perbulan">
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
                <div class="col-sm-2 col-sm-push-2 col-xs-6" >
                    <button class="btn btn-primary col-xs-12" id="lihat" onclick="update()">TAMPILKAN</button>
                </div>
                
            </form>
            <div class="col-sm-2 col-sm-push-2 col-xs-6" >
                <button  class="btn btn-primary col-xs-12" id="print_acc" > <span class="glyphicon glyphicon-print" aria-hidden="true"></span> CETAK</button>
            </div>
        </div>
    </div>
    <br>
</div>
<div id="absen-print">
<div class="container">
    <div>
        <h2>ABSEN</h2>
        <h4 id="bulan-tahun"></h4>
        <div class='table-responsive'>
            <table class='table  table-condensed' id='absenperbulan'>
                <thead>
                    <tr>
                        <th>id</th>
                        <th>nama</th>
                        <th>status</th>
                        <th>keterangan</th>
                        <th>tanggal</th>
                        <th>jam</th>
                        <th>acc</th>
                        <th>denda</th>
                        <th class='text-center no-print'>action</th>
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
            <table class='table  table-condensed' id='ijinperbulan'>
                <thead>
                    <tr>
                        <th>id</th>
                        <th>nama</th>
                        <th>alasan</th>
                        <th>start</th>
                        <th>end</th>
                        <th>tanggal</th>
                        <th>denda</th>
                        <th class="no-print ">action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

<script type='text/javascript'>
    $( document ).ready(function() {
        $('button#print_acc').on('click', function(e) {
            console.log('acc');
            $('#absenperbulan').DataTable().destroy();
            $('#ijinperbulan').DataTable().destroy();

            $('#absenperbulan').DataTable({paging: false});
            $('#ijinperbulan').DataTable({paging: false});


            $("#absen_print").print({
            globalStyles : false,
            mediaPrint : true,
            stylesheet : "<?php echo base_url("assets/css/bootstrap.css") ?>",
            iframe : false,
            append: null,
            prepend: null,
            deferred: $.Deferred().done(function() { console.log('Printing done', arguments); })
            });
            $('#absenperbulan').DataTable().destroy();
            $('#ijinperbulan').DataTable().destroy();
            $('#absenperbulan').DataTable();
            $('#ijinperbulan').DataTable();
        });
    });
</script>
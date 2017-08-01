<div class="container">
    <ol class="breadcrumb">
      <li  class='active'>Acc</li>
    </ol>
    <br>
    <div id="notif"></div>
    <br>
    <form class="form-inline" method="POST" id="form">
      <div class="form-group">
        <label>Tanggal :</label>
        <input type="date" class="form-control" value="<?= date('Y-m-d'); ?>" name="vtanggal" >
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
                        <th>late minute</th>
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
                        <th>kompensasi</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>


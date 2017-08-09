<!-- modal delete absen  -->
<div class="modal fade" id="deleteAbsenModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <form id="formdeleteAbsen">      
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Delete Absen</h4>
                </div>
                    <input type="hidden" name="id_del" id="idDeleteAbsen">
                    <div class="modal-body ">
                        Are you sure?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">CANCEL</button>
                        <button class="btn btn-primary" id="btn-delete-absen" >DELETE</button>
                    </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
$('#deleteAbsenModal').on('show.bs.modal', function(e) {
    $("#idDeleteAbsen").attr('value', $(e.relatedTarget).data('idhapus'));
});
</script>
<!-- /modal delete absen  -->


<!-- modal delete ijin -->
<div class="modal fade" id="deleteIjinModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <form id="formdeleteIjin">      
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Delete Ijin</h4>
                </div>
                    <input type="hidden" name="id_del" id="idDeleteIjin">
                    <div class="modal-body ">
                        Are you sure?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">CANCEL</button>
                        <a class="btn btn-primary" id="btn-delete-ijin" >DELETE</a>
                    </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
$('#deleteIjinModal').on('show.bs.modal', function(e) {
    $("#idDeleteIjin").attr('value', $(e.relatedTarget).data('idi'));
});
</script>
<!-- /modal delete ijin -->


<!-- modal reject absen -->
<div class="modal fade" id="rejectAbsenModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <form id="formreject">      
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Reject Absen</h4>
                </div>
                    <input type="hidden" name="id_rej" id="idReject">
                    <div class="modal-body ">
                        Update acc menjadi belum disetujui. Jika status adalah hadir, maka tidak dapat melakukan ijin.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">CANCEL</button>
                        <a class="btn btn-primary" id="btn-reject" >SUBMIT</a>
                    </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
$('#rejectAbsenModal').on('show.bs.modal', function(e) {
    $("#idReject").attr('value', $(e.relatedTarget).data('idreject'));
});
</script>
<!-- /modal reject absen -->


<!-- modal accept absen -->
<div class="modal fade" id="acceptAbsenModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <form id="formaccept">      
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Accept Absen</h4>
                </div>
                    <input type="hidden" name="id_acc" id="idAccept">
                    <div class="modal-body ">
                        Akan mengupdate acc menjadi telah disetujui
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">CANCEL</button>
                        <a class="btn btn-primary" id="btn-acc" >ACCEPT</a>
                    </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
$('#acceptAbsenModal').on('show.bs.modal', function(e) {
    $("#idAccept").attr('value', $(e.relatedTarget).data('idaccept'));
});
</script>
<!-- /modal accept absen -->

<div class="modal fade" id="updateAbsenModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <form id="formupdateAbsen" method="POST">      
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Update
                </div>
                <div class="modal-body ">
                    <input type='hidden' name='u_id_a' id='idU'>
                    <input type='hidden' name='u_id_k' id='idkU'>
                    <div class='form-group'>
                        <label class='control-label'>Jam</label>
                        <div class='input-group clockpicker' data-align='top' data-autoclose='true' data-placement='bottom' id="clockabsen">
                            <input type='text' class='form-control' name='u_jam' id='jamUp'>
                            <span class='input-group-addon'>
                                <span class='glyphicon glyphicon-time'></span>
                            </span>
                        </div>
                    </div>
                    <div class='form-group'>
                        <label>tanggal</label>
                        <input type='date' class='form-control' name='u_tanggal' id='tglUp'>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Keterangan</label>
                        <select class="form-control" name="u_keterangan" id="ketUp" onchange="editDetail()">
                            <?php
                                if ($data_s->num_rows() > 0) {
                                    foreach ($data_s->result_array() as $row_s) {
                                        echo "<option value='".$row_s['id_s']."'>".$row_s['keterangan_s']."</option>";
                                    }                                    
                                }                                
                            ?>
                        </select>
                    </div>                    
                    <div class='form-group'>
                        <label>detail keterangan</label>
                        <input type='text' class='form-control' name='u_detail' id='detUp'>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Acc</label>
                        <div >
                            <select class="form-control" name="u_acc" id='accUp'>
                                <?php
                                    for ($i=0; $i <=1 ; $i++) {
                                        echo ($i == 1)?"<option value='".$i."'>sudah di acc </option>": "<option value='".$i."'>belum di acc </option>" ;
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">CANCEL</button>
                    <a class="btn btn-primary" id="btn-update">UPDATE</a>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    var asli = document.getElementById("detUp").value;
    function editDetail(){
        console.log("");
    }
</script>


<div class="modal fade" id="updateIjinModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <form id="formupdateIjin" method="POST">      
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Update
                </div>
                <div class="modal-body ">
                    <input type="hidden" name="u_id_i" id="idiUpdate">
                    <input type="hidden" name="u_id_k" id="idkUpdate">
                    <div class="form-group">
                        <label class="control-label">Nama</label>
                        <input type="text" class="form-control" id="namaiUpdate" name="u_nama" readonly>
                    </div>
                    <div class="form-group">
                        <label class="control-label">tanggal</label>
                        <input type="date" class="form-control" name="u_tanggal" id="tanggaliUpdate" readonly>
                    </div>
                    <div class="form-group">
                        <label class="control-label">perihal</label>
                        <textarea class="form-control" name="u_perihal" style="min-height: 100px;" id="perihaliUpdate"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="control-label">start</label>
                        <div class="input-group clockpicker" data-align="top" data-autoclose="true" data-placement='top' id="clockstart">
                            <input type="text" class="form-control" name="u_start" id="startiUpdate">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-time"></span>
                            </span>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="control-label">end</label>
                        <div class="input-group clockpicker" data-align="top" data-autoclose="true" data-placement='top' id="clockend">
                            <input type="text" class="form-control" name="u_end" id="endiUpdate">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-time"></span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">CANCEL</button>
                    <a class="btn btn-primary" id="btn-update-ijin">UPDATE</a>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    $('#clockstart').clockpicker();
    $('#clockabsen').clockpicker();
    //$('.clockpicker').clockpicker({placement: 'bottom'});
    $('#clockend').clockpicker();
    
</script>
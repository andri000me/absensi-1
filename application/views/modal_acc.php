<div class="modal fade" id="deleteAbsenModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <form id="formdelete">      
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Delete Absen</h4>
                </div>
                    <input type="hidden" name="id_del" id="idDelete">
                    <div class="modal-body ">
                        Are you sure?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <a class="btn btn-primary" id="btn-delete" >delete</a>
                    </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
$('#deleteAbsenModal').on('show.bs.modal', function(e) {
    $("#idDelete").attr('value', $(e.relatedTarget).data('idhapus'));
});
</script>

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
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <a class="btn btn-primary" id="btn-reject" >Submit</a>
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
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <a class="btn btn-primary" id="btn-acc" >Acc</a>
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

<div class="modal fade" id="updateAbsenModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <form id="formupdate" method="POST">      
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Update
                </div>
                <div class="modal-body ">
                    <input type='hidden' name='u_id_a' id='idU'>
                    <input type='hidden' name='u_id_k' id='idkU'>
                    <div class='form-group'>
                        <label class=' control-label'>Jam</label>
                        <div class='input-group clockpicker' data-align='top' data-autoclose='true' data-placement='top'>
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
                        <select class="form-control" name="u_keterangan" id="ketUp">
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
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <a class="btn btn-primary" id="btn-update">Update</a>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    $('.clockpicker').clockpicker({
        placement: 'bottom',
    });
</script>

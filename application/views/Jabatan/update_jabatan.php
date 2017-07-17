<div class="container">
<ol class="breadcrumb">
  <li><a href="<?php echo base_url('Jabatan_C')?>">jabatan</a></li>
  <li class="active">edit jabatan</li>
</ol>
    <h3> UPDATE JABATAN</h3>
    <form class="form-horizontal" action="<?php echo base_url();?>Jabatan_C/update_info" method="POST" id="registerForm" autocomplete="on" enctype="multipart/form-data">
<?php foreach ($jabatan as $row) { ?>
        <div class="form-group">
            <div class="col-sm-12">
                <input type="text" class="form-control" name="u_id_J" value="<?php echo $row->id_j?>" readonly>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <input type="text" class="form-control" name="u_jabatan" value="<?php echo $row->jabatan?>">
            </div>
        </div>
        <br>
        <div class="text-right">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
<?php  } ?>
    </form>
</div>
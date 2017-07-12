<?php foreach ($misc->result() as $row) { ?>
<div class="container">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('Status_C/view/pengaturan')?>" class='active' >Pengaturan</a></li>
        <li class='active'>Update</li>
    </ol>
    <h3> UPDATE MISC</h3>
    <form class="form-horizontal" action="<?php echo base_url();?>Status_C/update_misc_info" method="POST" id="registerForm" autocomplete="on" enctype="multipart/form-data">
        <div class="form-group">
            <div class="col-sm-12">
                <input type="text" class="form-control" name="u_id_m" value="<?php echo $row->id_m?>" readonly>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <label class="control-label"> Value </label>
                <input type="text" class="form-control" name="u_misc" value="<?php echo $row->misc?>">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <label class="control-label"> Konteks </label>
                <input type="text" class="form-control" name="u_detail" value="<?php echo $row->detail?>">
            </div>
        </div>
        <br>
        <div class="text-right">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
<?php  } ?>
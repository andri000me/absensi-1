<?php foreach ($status->result() as $row) { ?>
<div class="container">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('Status_C/view')?>" class='active' >Status</a></li>
        <li class='active'>Update</li>
    </ol>

	<h3>Edit Status</h3>
	<form class="form-horizontal" action="<?php echo base_url();?>Status_C/update_info" method="POST" autocomplete="on" enctype="multipart/form-data">
        <div class="form-group">
            <div class="col-sm-12">
                <label>ID Status</label>
                <input type="text" class="form-control" name="u_id_s" value="<?php echo $row->id_s; ?>" readonly>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <label>Nama Status</label>
                <input type="text" class="form-control" name="u_keterangan_status" value="<?php echo $row->keterangan_s; ?>">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <label>Info Status</label>
                <input type="text" class="form-control" name="u_info_status" value="<?php echo $row->info_s; ?>">
            </div>
        </div>
        <br>
        <div class="text-right">
	        <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
<?php } ?>
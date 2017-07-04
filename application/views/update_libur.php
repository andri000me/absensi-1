<div class="container">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('Holiday_C/')?>" >Holiday</a></li>
        <li class='active'>Update</li>
    </ol>
	<h3>Edit Liburan</h3>
	<form class="form-horizontal" action="<?php echo base_url('Holiday_C/update_info')?>" method="POST" autocomplete="on" enctype="multipart/form-data">
        <div class="form-group">
            <div class="col-sm-12">
                <input type="text" class="form-control" name="u_id_libur" value="<?php echo $liburan[0]->id_libur?>" readonly>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <input type="date" class="form-control" name="u_tanggal" value="<?php echo $liburan[0]->tanggal?>">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <input type="text" class="form-control" name="u_detail" value="<?php echo $liburan[0]->detail?>">
            </div>
        </div>
        <br>
        <div class="text-right">
	        <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>

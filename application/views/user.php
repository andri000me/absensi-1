<div class="container">
  <ol class="breadcrumb">
    <li  class="active">User</li>
  </ol>
	<div class="col-xs-12 text-right">
		<button type="button" class="btn btn-success" data-toggle="modal" data-target="#addUserModal">Add User</button>
	</div>
  <br>
	<div class="col-sm-12">
    <br>
    <?=$this->session->flashdata("alert_foto");?>
    <?=$this->session->flashdata("alert_unlink");?>
    <?=$this->session->flashdata("alert_create_user");?>
    <?=$this->session->flashdata("alert_delete_user");?>
  </div>
</div>

<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title" id="myModalLabel">Register</h4>
          	</div>
          	<form class="form-horizontal" action="<?php echo base_url();?>User_C/create_user" method="POST" id="registerForm" autocomplete="on" enctype="multipart/form-data">
            	<div class="modal-body">
              		<div class="form-group">
                		<div class="col-sm-12">
                  			<input type="text" class="form-control" placeholder="Nama Karyawan" name="c_nama" value="<?php echo set_value('c_nama'); ?>">
                		</div>
              		</div>
              		<div class="form-group">
                		<div class="col-sm-12">
                  			<input type="text" class="form-control" placeholder="Alamat Karyawan" name="c_alamat" value="<?php echo set_value('c_alamat');?>" >
                		</div>
              		</div>
              		<div class="form-group">
                		<div class="col-sm-12">
                  			<input type="text" class="form-control" placeholder="Email Karyawan" name="c_email" value="<?php echo set_value('c_email');?>">
                		</div>
              		</div>
              		<div class="form-group">
                		<div class="col-sm-12">
                  			<input type="text" class="form-control" placeholder="No HP Karyawan" name="c_nohp" value="<?php echo set_value('c_nohp');?>">
                		</div>
              		</div>
              		<div class="form-group" >
                		<div class="col-sm-12">
                  			<select class=" form-control" placeholder="Jabatan Karyawan" name="c_jabatan" tabindex="2" value="<?php echo set_value('c_jabatan');?>">
                    			<option value="" disabled selected>Jabatan Karyawan</option>
		        	                <?php 
		                        foreach($jabatans->result() as $row){ 
		                        	echo '<option value="'.$row->id_j.'">'.$row->jabatan.'</option>';
		                        }?>
                  			</select>
                		</div>
              		</div>
              		<div class="form-group">
                		<div class="col-sm-12">
                  			<input type="text" class="form-control" placeholder="Username Karyawan" name="c_username" value="<?php echo set_value('c_username');?>">
                		</div>
              		</div>
              		<div class="form-group">
	                	<div class="col-sm-12">
                  			<input type="password" class="form-control" placeholder="Password Karyawan" name="c_password" value="<?php echo set_value('c_password');?>">
                		</div>
              		</div>
              		<div class="form-group">
	                	<div class="col-sm-12">
                			<label for="exampleInputFile">Foto Profil</label>
                			<input type="file" id="exampleInputFile" name="c_foto">
                		</div>
              		</div>
            	</div>
            	<div class="modal-footer">
            		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              		<button type="submit" class="btn btn-primary">Submit</button>
            	</div>
        	</form>
    	</div>
	</div>
</div>
<br>
<div class="container">
	<div class="table-responsive">
  		<table class="table  table-condensed">
  			<thead>
        		<tr>
	            	<th>id</th>
	            	<th>Nama</th>
	            	<th>Alamat</th>
	            	<th>Email</th>
	            	<th>No Hp</th>
	            	<th>Jabatan</th>
	            	<th>Foto</th>
	            	<th>Action</th>
            	</tr>
        	</thead>
	        <tbody>
	        	<?php 
              //echo $id_admin[0]->id_k;
                foreach ($karyawan->result() as $row) {
                    echo "<tr>";
                    echo "<td>".$row->id_k."</td>";
                    echo "<td>".$row->nama_k."</td>";
                    echo "<td>".$row->alamat_k."</td>";
                    echo "<td>".$row->email_k."</td>";
                    echo "<td>".$row->noHp_k."</td>";
                    echo "<td>";
                    foreach ($jabatans->result() as $rowo) {
                      echo ($row->jabatan_k == $rowo->id_j) ? $rowo->jabatan : '';
                    }
                    echo "</td>";
                    echo "<td><img class='img-circle' style='width:30px;height:30px;' src='".base_url().$row->foto_k."'></td>";
                    $bulan = date('n');
                    $tahun = date('Y');
                    echo "<td>
                        <a href='".base_url()."User_C/delete_user/".$row->id_k."'><span class='glyphicon glyphicon-trash'></span></a>
                        <a href='".base_url()."User_C/update_user/".$row->id_k."'><span class='glyphicon glyphicon-edit'></span></a>
                        <a href='".base_url()."User_C/detail_per_user_per_bulan/".$row->id_k."/".$bulan."/".$tahun."'><span class='glyphicon glyphicon-th'></span></a></td>";
                    echo "</tr>";
              }
	        	?>
	        </tbody>
  		</table>
	</div>
</div>
<?php
foreach ($user->result() as $row) {
    $bulan = date('n');$tahun = date('Y');
?>
<div class="container">
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('User_C')?>">User</a></li>
      <li ><a>update user</a></li>
      <li class="active" ><?=$row->nama_k?></li>
    </ol>
	<div class="row">
    <h4 class="text-center">DATA SAYA</h4><br>
    <div class="col-sm-12">
        <div class="text-right">
            <a href="<?=base_url("User_C/detail_per_user_per_bulan/".$row->id_k."/".$bulan."/".$tahun)?>" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> LIHAT ABSENSI SAYA</a>
        </div>
    </div>
        <br>
        <br>
        <br>
        <?=$this->session->flashdata("alert_update_info");?>
        <?=$this->session->flashdata("alert_update_cuti");?>
        <?=$this->session->flashdata("alert_update_login");?>
        <form class="form-horizontal" action="<?php echo base_url();?>User_C/update_info" method="POST" id="registerForm" autocomplete="on" enctype="multipart/form-data">
            <div class="col-xs-12 col-sm-4" style="margin-top:50px; padding: 10px 10px 10px 10px;background-color: #f1f1f1">
                <img src="<?php echo base_url().$row->foto_k;?>" class="img-responsive center-block" alt="Image">
                <label for="exampleInputFile">Foto Profil</label>
                <input type="file" id="exampleInputFile" name="u_foto">
            </div>
            <div class="col-sm-8">
                <br>
                
                <div class="form-group">
                    <label class="col-sm-2 control-label">ID karyawan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" readonly name="u_id" value="<?php echo $row->id_k; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Nama</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control"  name='u_nama' required="required" value="<?php echo $row->nama_k;?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control"  name="u_alamat" required="required" value="<?php echo $row->alamat_k;?>" >
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control"  name="u_email" required="required" value="<?php echo $row->email_k;?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">No HP</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control"  name="u_nohp" required="required" value="<?php echo $row->noHp_k;?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Date added</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control"  name="u_date_added" value="<?php echo $row->date_added;?>" disabled>
                    </div>
                </div>

                <!-- VARIABEL UNTUK CEK APAKAH BISA_CUTI DIUPDATE -->
                <input type="hidden" class="form-control" name="u_bisa_cuti_db" value="<?php echo $row->bisa_cuti;?>" >
                
                <!-- VARIABEL UNTUK LINK FOTO-->
                <input type="hidden" class="form-control" name="unlink_foto_k" value="<?php echo $row->foto_k;?>">


                <div class="form-group">
                    <label class="col-sm-2 control-label">Bisa cuti</label>
                    <div class="col-sm-10">
                        <select name="u_bisa_cuti_form" id="input" class="form-control" >
                            <?php if ($row->bisa_cuti == 0 ) {?>
                                <option value="0" selected >Belum bisa cuti</option>
                                <option value="1" >Sudah bisa cuti</option>
                            <?php } else{ ?>
                                <option value="0" >Belum bisa cuti</option>
                                <option value="1" selected >Sudah bisa cuti</option>
                            <?php }?>
                        </select>
                    </div>
                </div>
                <div class="form-group" >
                    <label class="col-sm-2 control-label">Jabatan</label>
                    <div class="col-sm-10">
                        <select class=" form-control" name="u_jabatan" tabindex="2" value="<?php echo $row->jabatan_k;?>">
                            <?php
                            $a=$row->jabatan_k;
                            foreach($jabatans->result() as $option){
                                echo '<option value="'.$option->id_j.'"';
                                echo ($a == $option->id_j) ? 'selected' : '';
                                echo '>'.$option->jabatan.'</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">SEND UPDATE</button>
                </div>  
            </div>
        </form>
        <br>


        <div class="col-sm-12 "><hr>
            <h4 class="text-center">DATA LOGIN</h4><br>
            <?php foreach ($login->result() as $rowo) {?>
            <!-- RESET PASSWORD -->
            <form action="<?= base_url();?>User_C/update_login" method="POST" class="form-inline">
                <div class="form-group">
                    <label class="sr-only" for="">label</label>
                    <input type="hidden" class="form-control" name="u_id" value="<?=$row->id_k?>">
                    <input type="hidden" class="form-control" name="u_id_L" value="<?php echo $rowo->id_L; ?>">
                </div>          
                <div class="text-right">
                    <button type="submit" class="btn btn-primary btn-lg" name="reset" value="reset"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span> RESET PASSWORD</button>
                </div>
            </form>
            <!-- ubah username, password, hak akses -->
            <form class="form-horizontal" action="<?php echo base_url();?>User_C/update_login" method="POST" id="registerForm" >
                
                <div class="form-group">
                    <div class="col-sm-12">
                        <input type="hidden" class="form-control" name="u_id" value="<?php echo $row->id_k; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <input type="hidden" class="form-control" name="u_id_L" value="<?php echo $rowo->id_L; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <input type="hidden" class="form-control" name="u_password_real" value="<?php echo $rowo->password_k; ?>">
                    </div>
                </div>
                <?php 
                $hak[1]='Super Admin';
                $hak[2]='Bawahan Admin';
                $hak[3]='Anggota';
                if ($this->session->userdata('logged_in')['hak_akses'] != 3){ ?>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Hak Akses</label>
                    <div class="col-sm-10" >
                        <select name="u_hak_akses" id="input" class="form-control" >
                            <?php
                            if ($this->session->userdata('logged_in')['hak_akses'] == 1){
                                $i =1;
                                for ($i ; $i <=3 ; $i++) { 
                                    echo "<option value='".$i."'";
                                    echo ($i == $rowo->hak_akses) ? 'selected' : '';
                                    echo ">".$i." ".$hak[$i]."</option>";
                                }
                            }
                            else{
                                echo "<option value='".$rowo->hak_akses."' selected>".$hak[$rowo->hak_akses]."</option>";
                            }
                             ?>
                        </select>
                    </div>
                </div>
                <?php } else{ ?>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Hak</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="u_hak_akses" value='<?php echo $rowo->hak_akses." ".$hak[$rowo->hak_akses]; ?>' readonly>
                    </div>
                </div>
                <?php } ?>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="u_username" value="<?php echo $rowo->username_k;?>" required="required">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" placeholder="Masukkan password baru" name="u_password">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Verifikasi Password Baru</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" placeholder="Masukkan lagi password baru" name="u_password_baru_verifikasi">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Password lama</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" placeholder="Masukkan password lama" name="u_password_lama">
                    </div>
                </div>
                <?php   } ?>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary" name="ganti" value="ganti">SEND UPDATE</button>
                </div>  
            </form>
            
        </div>
    </div>
</div>
<?php
}
?><br>
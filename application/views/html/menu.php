    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <?php
            $date = date('Y-m-d');
            $dataCondition['tanggal'] = $date;
            $apakah_hari_libur = $this->Absen_M->read('data_libur',$dataCondition)->result();
            if ($apakah_hari_libur == array()) {?>
              <a class="navbar-brand" disabled href="/absensi">Absensi</a>
            <?php
            }
          ?>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <?php 
            if ($apakah_hari_libur == array()) {?>
              <li><a href="<?php echo site_url('Home_C/view/ijin')?>">ijin</a></li>
              <?php }
            ?>
              <?php if ($this->session->userdata('logged_in')['hak_akses'] == 1 or $this->session->userdata('logged_in')['hak_akses'] == 2){ ?>

                <li>
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <span>User</span>
                    <b class="arrow fa fa-caret-down"></b>
                  </a>
                  <ul class="dropdown-menu dropdown-navbar">
                    <li><a href="<?php echo site_url('User_C') ?>">Data Karyawan</a></li>
                    <li><a href="<?php echo site_url("User_C/update_user/".$this->session->userdata('logged_in')['id_k'])?>">myAccounts</a></li>
                  </ul>
                </li>

                <li>
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <span>Value</span>
                    <b class="arrow fa fa-caret-down"></b>
                  </a>
                  <ul class="dropdown-menu dropdown-navbar">
                    <li><a href="<?php echo site_url('Status_C/view') ?>">Status</a></li>
                    <li><a href="<?php echo site_url('Status_C/view/pengaturan') ?>">Pengaturan</a></li>
                    <li><a href="<?php echo site_url('Jabatan_C')?>">Jabatan</a></li>
                    <li><a href="<?php echo site_url('Holiday_C/') ?>">Holiday</a></li>                
                  </ul>
                </li>
                
                <li><a href="<?php echo site_url('Overview_C/view') ?>">Overview</a></li>                

                <li>
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <span>Acc</span>
                    <b class="arrow fa fa-caret-down"></b>
                  </a>
                  <ul class="dropdown-menu dropdown-navbar">
                    <li><a href="<?php echo site_url('Acc_C/lihat/'.date('m')."/".date('Y')) ?>">Perbulan</a></li>
                    <li><a href="<?php echo site_url('Acc_C/lihat_pertanggal') ?>">Pertanggal</a></li>
                  </ul>
                </li>

              <?php } ?>
              <?php if (isset($this->session->userdata['logged_in'])) { ?>
                <li><a href="<?php echo site_url('Home_C/logout/') ?>" >Logout <?php echo $this->session->userdata('logged_in')['username']; ?></a></li>
              <?php } else { ?>
                <li><a href="" data-toggle="modal" data-target="#loginModal">Logins</a></li>
              <?php } ?>
          </ul>
        </div>
      </div>
    </nav>
    <?php 
      $active = $this->router->fetch_class();
      $active1= $this->router->fetch_method();
    ?>
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
            unset($date,$dataCondition);

            if ($apakah_hari_libur == array()) { ?>
              <a class="navbar-brand" disabled href="/absensi">Illiyin Studio</a>
            <?php
            }
          ?>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
          <li>
                    <a href="<?php echo base_url('Home_C/hari_ini') ?>">Hari ini</a>
                  </li>
            <?php if ($this->session->userdata('logged_in')['hak_akses'] == 1 or $this->session->userdata('logged_in')['hak_akses'] == 2){ ?>
                <li <?php echo ($active1 =="view_dashboard")? 'class = active':''?>><a href="<?php echo base_url('Home_C/view_dashboard')?>"> Dashboard </a></li>
                
                <li <?php echo ($active =="User_C" or $active1 =="update_user ")? 'class = active':''?>><a href="<?php echo base_url('User_C') ?>"> Pengguna </a></li>

                <li <?php echo ($active =="Acc_C")? 'class = active':''?>>
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <span>Statistik</span>
                    <b class="arrow fa fa-caret-down"></b>
                  </a>
                  <ul class="dropdown-menu dropdown-navbar">
                    <li><a href="<?php echo base_url('Acc_C/lihat_pertanggal') ?>">Harian</a></li>
                    <li><a href="<?php echo base_url('Acc_C/lihat_perbulan') ?>">Bulanan</a></li>
                  </ul>
                </li>

                 <li <?php echo ($active =="Overview_C")? 'class = active':''?>>
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <span>Laporan</span>
                    <b class="arrow fa fa-caret-down"></b>
                  </a>
                  <ul class="dropdown-menu dropdown-navbar">
                    <li><a href="<?php echo base_url('Overview_C/view/harian')?>">Harian</a></li>
                    <li><a href="<?php echo base_url('Overview_C/view')?>">Bulanan</a></li>
                  </ul>
                </li>
                <li <?php echo ($active =="Status_C" or $active =="Jabatan_C" or $active=="Holiday_C")? 'class = active':''?>>
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <span>Pengaturan</span>
                    <b class="arrow fa fa-caret-down"></b>
                  </a>
                  <ul class="dropdown-menu dropdown-navbar">
                    <li><a href="<?php echo base_url('Status_C/view/pengaturan') ?>">Pengaturan</a></li>
                    <li><a href="<?php echo base_url('Status_C/view') ?>">Status</a></li>
                    <li><a href="<?php echo base_url('Jabatan_C')?>">Jabatan</a></li>
                    <li><a href="<?php echo base_url('Holiday_C/') ?>">Hari Libur</a></li>                
                  </ul>
                </li>

                <li <?php echo ($active =="User_C")? 'class = active':''?>>
                  <a class="dropdown-toggle" data-toggle="dropdown">
                  <img class="profil" src="<?php echo base_url().$this->session->userdata('logged_in')['link_foto']?>" alt="User's Photo" />  
                    
                    <b class="arrow fa fa-caret-down"></b>
                  </a>
                  <ul class="dropdown-menu dropdown-navbar">
                    <li><a href="<?php echo base_url("User_C/update_my_account/".$this->session->userdata('logged_in')['id_k'])?>">myAccounts</a></li>
                  <?php /*if (isset($this->session->userdata['logged_in'])) {*/ ?>
                    <li>
                      <a id='hak-akses' href="<?php echo base_url('Home_C/logout/')?>" data-my="<?php echo $this->session->userdata('logged_in')['username']?>">Logout <?php echo $this->session->userdata('logged_in')['username']?> </a>
                    </li>
                  <?php /*} else {*/ ?>
                    <!-- <li><a href="" data-toggle="modal" data-target="#loginModal">Logins</a></li> -->
                  <?php /*}*/ ?>
                  </ul>
                </li>
              <?php } else { ?>
                  <li>
                    <a href="" data-toggle="modal" data-target="#loginModal">Login</a>
                  </li>
                  
              <?php  } ?>

          </ul>
        </div>
      </div>
    </nav>

    <script>
      var div = document.getElementById("hak-akses");
      if ($(div).data('my')) {
        var myData = $(div).data('my');
      } else {
        var myData = '';
      }
      console.log(myData);
  </script>
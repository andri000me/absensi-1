<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Acc_C extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('Absen_M');
        date_default_timezone_set("Asia/Jakarta");
        if (!$this->session->userdata('logged_in')){
            redirect();
        }
    }
    public function lihat_perbulan()
    {
        $datar['data_s'] = $this->Absen_M->rawQuery("SELECT * FROM data_s");
        $this->load->view('html/header');
        $this->load->view('html/menu');
        $this->load->view('Acc/modal_acc',$datar);
        $this->load->view('Acc/acc');
        $this->load->view('Acc/javaskrip_perbulan');
        $this->load->view('html/footer');
    }
    public function lihat_pertanggal()
    {        
        $datar['data_s'] = $this->Absen_M->rawQuery("SELECT * FROM data_s");
        $this->load->view('html/header');
        $this->load->view('html/menu');
        $this->load->view('Acc/modal_acc',$datar);
        $this->load->view('Acc/acc_pertanggal');
        $this->load->view('Acc/javaskrip_pertanggal');
        $this->load->view('html/footer');
    }
    public function show_perbulan()
    {
        $date = $this->input->post('vbulan');
        $year = $this->input->post('vtahun');
        $datar['absen']= $this->Absen_M->rawQuery("
            SELECT 
            data_ra.id_a, 
            data_s.keterangan_s,
            data_ra.detail, 
            data_ra.tanggal, 
            data_ra.jam, 
            data_ra.acc, 
            data_ra.id_k,
            data_ra.denda, 
            data_k.nama_k 
            FROM data_ra
            INNER JOIN data_k ON data_ra.id_k = data_k.id_k
            INNER JOIN data_s ON data_ra.id_s = data_s.id_s
            WHERE tanggal LIKE'".$year."-".$date."%' ORDER BY data_ra.id_a DESC")->result();
        $datar['ijin']= $this->Absen_M->rawQuery("SELECT data_k.nama_k, data_k.id_k, data_i.perihal, data_i.end, data_i.start, data_i.tanggal, data_i.id_i,data_i.denda FROM data_i INNER JOIN data_k ON data_i.id_k = data_k.id_k WHERE tanggal LIKE '".$year."-".$date."%' ")->result();
        $datar['data_s'] = $this->Absen_M->rawQuery("SELECT * FROM data_s")->result();
        $datar['date'] = (int)$date;
        $datar['year'] = $year;
        echo json_encode($datar);
    }
    public function show_pertanggal()
    {
        $date = $this->input->post('vtanggal');
        $datar['absen']= $this->Absen_M->rawQuery("SELECT 
            data_ra.id_a, 
            data_s.keterangan_s,
            data_ra.detail, 
            data_ra.tanggal, 
            data_ra.jam, 
            data_ra.acc, 
            data_ra.id_k,
            data_ra.denda,
            data_ra.late_minute, 
            data_k.nama_k 
            FROM data_ra
            INNER JOIN data_k ON data_ra.id_k = data_k.id_k
            INNER JOIN data_s ON data_ra.id_s = data_s.id_s
            WHERE tanggal ='".$date."' ")->result();
        $datar['ijin']= $this->Absen_M->rawQuery("SELECT data_k.nama_k, data_k.id_k, data_i.perihal, data_i.end, data_i.start, data_i.tanggal, data_i.id_i,data_i.denda FROM data_i INNER JOIN data_k ON data_i.id_k = data_k.id_k WHERE tanggal ='".$date."%' ")->result();
        $datar['data_s'] = $this->Absen_M->rawQuery("SELECT * FROM data_s")->result();
        echo json_encode($datar);
    }
    public function acceptAbsen()
    {
    	$dataUpdate['acc'] = 1;
    	$dataCondition['id_a'] = $this->input->post('id_acc');
    	$result = $this->Absen_M->update('data_ra',$dataCondition,$dataUpdate);
    	if($result){
			$alert_update_absen_acc = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong> absen berhasil di ACC!</strong></div>";
		}
		else{
			$alert_update_absen_acc = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>absen gagal di acc! </strong></div>";
		}
        echo $alert_update_absen_acc;
    }
    public function rejectAbsen()
    {
    	$dataUpdate['acc'] = 0;
    	$dataCondition['id_a'] = $this->input->post('id_rej');
    	$result = $this->Absen_M->update('data_ra',$dataCondition,$dataUpdate);
    	if($result){
			$alert_update_absen_acc = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong> absen berhasil di tolak!</strong></div>";
        }
        else{
            $alert_update_absen_acc = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>absen gagal di tolak! </strong></div>";
        }
        echo $alert_update_absen_acc;
    }
    public function deleteAbsen()
    {
        $dataCondition['id_a'] = $this->input->post('id_del');
        $result = $this->Absen_M->delete('data_ra',$dataCondition);
        if($result){
            $alert_update_absen_acc = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Delete Absensi Berhasil! </strong> </div>";
        }
        else{
            $alert_update_absen_acc = "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Delete Absensi Gagal! </strong></div>";
        }
        echo $alert_update_absen_acc;
        unset($dataCondition,$result,$data);
    }
    public function edit_absensi_ku_dariacc($data)
    {

        $datax['detail_absen'] = $this->Absen_M->rawQuery("select * from data_ra
                                                            inner join data_k on data_ra.id_k = data_k.id_k
                                                            inner join data_s on data_ra.id_s = data_s.id_s
                                                            where data_ra.id_a = ".$data);
        echo json_encode($datax['detail_absen']->result_array());
    }
    public function edit_ijin_ku_dari_acc($data)
    {
        $datax['ijin_ku'] = $this->Absen_M->rawQuery("SELECT data_i.id_i,data_i.id_k,data_i.perihal,data_i.start,data_i.end,data_i.tanggal,data_i.denda,data_k.nama_k
                                                        FROM data_i
                                                        INNER JOIN data_k ON data_i.id_k = data_k.id_k
                                                        WHERE id_i =".$data)->result();
        echo json_encode($datax['ijin_ku']);
    }
    public function update_absensi_ku()
    {
        if ($this->input->post() != null) {
            $dataCondition['id_a'] = $this->input->post('u_id_a');
            $dataCondition['id_k'] = $this->input->post('u_id_k');
            $data['id_s'] = $this->input->post('u_keterangan');
            $data['tanggal'] = $this->input->post('u_tanggal');
            $data['jam'] = $this->input->post('u_jam');
            $data['acc'] = $this->input->post('u_acc');
            
            /*ambil jam masuk*/
            $where_idm['id_m'] =  1;
            $datax['jam_masuk'] = $this->Absen_M->read('data_m',$where_idm)->result();
            $jam_masuk = $datax['jam_masuk'][0]->misc;

            /*ambil jam pulang*/
            $where_idm['id_m'] =  4;
            $datax['jam_pulang'] = $this->Absen_M->read('data_m',$where_idm)->result();
            $jam_pulang = $datax['jam_pulang'][0]->misc;

            $where_idm['id_m'] =  9;$datax['jam_kerja_custom'] = $this->Absen_M->read('data_m',$where_idm)->result();
            $jam_kerja_custom = $datax['jam_kerja_custom'][0]->misc;

            unset($where_idm['id_m']);

            /*ambil identitas(jabatan) karyawan, untuk anak magang*/
            $where_idm['id_k'] =  $dataCondition['id_k'];
            $datax['identitas_karyawan'] = $this->Absen_M->read('data_k',$where_idm)->result();

            unset($where_idm);
            
            if ($data['id_s'] == 1 )
            {
                if ($data['jam']>$jam_pulang) {
                    $alert_update_absensi_ku = "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Eror!</strong></div>";
                    die();
                }
                elseif ($data['jam'] > $jam_masuk and $data['jam'] < $jam_pulang){
                    /*menentukan telat atau tidak sekaligus denda*/
                    
                    $where_idm['id_m'] =  7;$datax['denda_terlambat'] = $this->Absen_M->read('data_m',$where_idm)->result();
                    $denda_terlambat = $datax['denda_terlambat'][0]->misc;
                    unset($where_idm);
                    
                    $datetime1 = new DateTime($jam_masuk);
                    $datetime2 = new DateTime($data['jam']);
                    $interval = $datetime1->diff($datetime2);

                    $jam = $interval->format('%H');
                    $menit = $interval->format('%I');
                    $detik  = $interval->format('%S');

                    $to_menit = ($jam * 60) + ($menit) + ($detik / 60);/*calculate minute*/
                    $to_menit_round = ceil($to_menit);/*kelewat 1 detik, langsung kehitung menit++ untuk ngisi late_minute*/
                    $bagi_15 = $to_menit / 15;/*bagi 15 menitan*/
                    $bagi_15_round = ceil($bagi_15);/*untuk pengali denda*/
                    if ($datax['identitas_karyawan'][0]->jabatan_k != 12) {/*saat bukan anak magang*/
                        $data['denda'] = $bagi_15_round * $denda_terlambat;
                    } else { /*jika anak magang*/
                        $data['denda'] = 0;
                    }
                    $data['detail'] = "telat";/*menentukan berapa menit terlambat*/
                    $data['late_minute'] = $to_menit_round;
                }
                else /*saat datang tepat waktu*/
                {
                    $data['detail'] = "tepat waktu";
                    $data['denda'] = 0;
                    $data['late_minute'] = 0;
                }
                // $alert_update_absensi_ku = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>".$data['late_minute']."</div>";
                $result = $this->Absen_M->update('data_ra',$dataCondition,$data);
                $results = json_decode($result, true);
                if ($results['status']) {
                        $alert_update_absensi_ku = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Update Absensi Berhasil! </strong> </div>";
                }
                else{
                    if ($results['error_message']['code'] == 1062) {
                        $alert_update_absensi_ku = "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Update gagal! U</strong> </div>";
                    }else{
                        $alert_update_absensi_ku = "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Update Absensi eror! </strong> </div>";
                    }
                }
            }
            elseif ($data['id_s'] == 2) {
                $data['detail'] = "other";
                $data['late_minute'] = 0;
                $data['denda'] = 0;
                $data['id_s'] = 1;

                $result = $this->Absen_M->update('data_ra',$dataCondition,$data);
                $results = json_decode($result, true);
                if ($results['status']) {
                        $alert_update_absensi_ku = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Update Absensi Berhasil! </strong> </div>";
                }
                else{
                    if ($results['error_message']['code'] == 1062) {
                        $alert_update_absensi_ku = "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Update gagal! U</strong> </div>";
                    }else{
                        $alert_update_absensi_ku = "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Update Absensi eror! </strong> </div>";
                    }
                }
            }
            elseif ($data['id_s'] == 5) {
                if ($datax['identitas_karyawan'][0]->jabatan_k != 12) {
                    $where_idm['id_m'] =  8;
                    $datax['denda_alpha'] = $this->Absen_M->read('data_m',$where_idm)->result();
                    $denda_alpha = $datax['denda_alpha'][0]->misc;
                    $data['denda'] = $jam_kerja_custom * $denda_alpha * 4;
                }
                else{//saat anak magang
                    $data['denda'] = 0;
                }
                $data['detail'] = $this->input->post('u_detail');

                $result = $this->Absen_M->update('data_ra',$dataCondition,$data);
                $results = json_decode($result, true);
                if ($results['status']) {
                        $alert_update_absensi_ku = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Update Absensi Berhasil! </strong> </div>";
                }
                else{
                    if ($results['error_message']['code'] == 1062) {
                        $alert_update_absensi_ku = "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Update gagal! U</strong> </div>";
                    }else{
                        $alert_update_absensi_ku = "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Update Absensi eror! </strong> </div>";
                    }
                }
            }
            elseif ($data['id_s'] == 6) {
                if ($datax['identitas_karyawan'][0]->jabatan_k != 12) {
                    $where_idm['id_m'] =  5;$datax['denda_ijin_1_hari'] = $this->Absen_M->read('data_m',$where_idm)->result();
                    $denda_ijin_1_hari = $datax['denda_ijin_1_hari'][0]->misc;
                    $data['denda'] = $jam_kerja_custom * $denda_ijin_1_hari;
                }else{
                    $data['denda'] = 0;
                }
                $data['detail'] = $this->input->post('u_detail');
                $data['late_minute'] = 0;

                $result = $this->Absen_M->update('data_ra',$dataCondition,$data);
                $results = json_decode($result, true);
                if ($results['status']) {
                        $alert_update_absensi_ku = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Update Absensi Berhasil! </strong> </div>";
                }
                else{
                    if ($results['error_message']['code'] == 1062) {
                        $alert_update_absensi_ku = "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Update gagal! U</strong> </div>";
                    }else{
                        $alert_update_absensi_ku = "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Update Absensi eror! </strong> </div>";
                    }
                }
            }
            elseif ($data['id_s'] == 3)//apakah mengajukan cuti
            {
                $where_idk['id_k'] = $dataCondition['id_k'];
                if ($datax['identitas_karyawan'][0]->bisa_cuti == '0' and $datax['identitas_karyawan'][0]->jabatan_k != 12) { //alert untuk karyawan
                    $alert_update_absensi_ku =  "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Anda belum bisa cuti!</strong></div>";
                }
                elseif ($datax['identitas_karyawan'][0]->jabatan_k == '12') { //alert untuk magang
                    $alert_update_absensi_ku =  "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Magang tidak boleh cuti!</strong></div>";
                }
                else{// bisa_cuti ==1 dan bukan anak magang
                    $data_c = $this->Absen_M->read('data_c',$where_idk)->result();
                    $wes_cuti = $data_c[0]->cuti_berapakali;
                    $jatah_cuti = $data_c[0]->jatah_cuti;
                    if ($wes_cuti == $jatah_cuti)
                    {
                        $data['denda'] =0;
                        $data['late_minute']=0;
                        $data['detail'] = $this->input->post('u_detail');
                        unset($data['id_s']);
                        $result = $this->Absen_M->update('data_ra',$dataCondition,$data);
                        $results = json_decode($result, true);
                        if ($results['status']) {
                        $alert_update_absensi_ku =  "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> Batas cuti ".$datax['identitas_karyawan'][0]->nama_k." sudah habis. Update berhasil</div>";
                        }
                        else
                        {
                            if ($results['error_message']['code'] == 1062) {
                                $alert_update_absensi_ku = "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Update Absensi Gagal! </strong> </div>";
                            }else{
                                $alert_update_absensi_ku = "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Update cuti eror! </strong> </div>";
                            }
                        }
                    }
                    else
                    {
                        $data['denda'] =0;
                        $data['late_minute']=0;
                        $data['detail'] = $this->input->post('u_detail');
                        $result = $this->Absen_M->update('data_ra',$dataCondition,$data);
                        $results = json_decode($result, true);
                        if ($results['status']) {
                            $sisa_cuti = $jatah_cuti-1;
                            $alert_update_absensi_ku =  "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Cuti untuk ".$datax['identitas_karyawan'][0]->nama_k." berhasil! </strong> jatah cuti anda tinggal ".$sisa_cuti."</div>";
                        }
                        else
                        {
                            if ($results['error_message']['code'] == 1062) {
                                $alert_update_absensi_ku = "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Update Absensi Gagal! </strong> </div>";
                            }else{
                                $alert_update_absensi_ku = "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Update Absensi eror! </strong> </div>";
                            }
                        }
                    }   
                }
            }
            elseif($data['id_s'] == 4){
                if ($data['jam'] > $jam_masuk) {
                            
                    $where_idm['id_m'] =  7;
                    $datax['denda_terlambat'] = $this->Absen_M->read('data_m',$where_idm)->result();
                    $denda_terlambat = $datax['denda_terlambat'][0]->misc;
                    unset($where_idm);
                    
                    $datetime1 = new DateTime($jam_masuk);
                    $datetime2 = new DateTime($data['jam']);
                    $interval = $datetime1->diff($datetime2);

                    $jam = $interval->format('%H');
                    $menit = $interval->format('%I');
                    $detik  = $interval->format('%S');

                    $to_menit = ($jam * 60) + ($menit) + ($detik / 60);/*calculate minute*/
                    $to_menit_round =ceil($to_menit);/*kelewat 1 detik, langsung kehitung menit++ untuk ngisi late_minute*/
                    $bagi_15 = $to_menit / 15;/*bagi 15 menitan*/
                    $bagi_15_round = ceil($bagi_15);/*untuk pengali denda*/
                    if ($datax['identitas_karyawan'][0]->jabatan_k != 12) {
                        $data['denda'] = $bagi_15_round * $denda_terlambat;
                    }
                    else{
                        $data['denda'] = 0;
                    }
                    $data['late_minute'] = $to_menit_round;
                }
                elseif ($data['jam'] < $jam_masuk) {
                    $data['denda'] = 0;
                    $data['late_minute'] = 0;
                }
                $data['detail'] = $this->input->post('u_detail');
                $result = $this->Absen_M->update('data_ra',$dataCondition,$data);
                $results = json_decode($result, true);
                if ($results['status']) {
                        $alert_update_absensi_ku = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Update sakit Berhasil! </strong> </div>";
                }
                else{
                    if ($results['error_message']['code'] == 1062) {
                        $alert_update_absensi_ku = "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Update gagal! U</strong> </div>";
                    }else{
                        $alert_update_absensi_ku = "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Update Absensi eror! </strong> </div>";
                    }
                }
            }
            else{
                $alert_update_absensi_ku ='not handled';
            }
            // $datas['id_k'] = $dataCondition['id_k'];
            // $datalike['tanggal'] = $data['tanggal'];            
            echo $alert_update_absensi_ku;
        }
    }
    public function update_ijin_ku()
    {
        if ($this->input->post() != null) {

            $where_idm['id_m'] =  1;
            $datax['jam_masuk'] = $this->Absen_M->read('data_m',$where_idm)->result();
            $jam_masuk = $datax['jam_masuk'][0]->misc;
            unset($where_idm);

            $where_idm['id_m'] =  4;
            $datax['jam_pulang'] = $this->Absen_M->read('data_m',$where_idm)->result();
            $jam_pulang = $datax['jam_pulang'][0]->misc;

            unset($datax,$where_idm);
            
            $data['start'] = $this->input->post('u_start');
            $data['end'] = $this->input->post('u_end');

            if ($data['end'] > $jam_pulang) {
                $data['end'] = $jam_pulang;
            }

            $starta = $data['start'].":00";/*hanya untuk bypass if dibawahnya persis. jika ambil dari form, isi $data['start'] adalah 07:30 sehingga lebih kecil dari di peraturan(07:30:00) */
            if ($starta < $jam_masuk ) {
                $alert_update_ijin_acc =  "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Ijin gagal! perbaiki jam ijin start</strong> Inputan jam diluar jam kerja</div>";
            }
            else{
                $dataCondition['id_i'] = $this->input->post('u_id_i');
                $data['perihal'] = $this->input->post('u_perihal');
                $data['tanggal'] = $this->input->post('u_tanggal');

                $tanggal = substr($data['tanggal'],-5,2);
                $tahun = substr($data['tanggal'],-10,4);
                
                $where_idm['id_m'] =  6;
                $datax['denda_ijin'] = $this->Absen_M->read('data_m',$where_idm)->result();
                $denda_ijin = $datax['denda_ijin'][0]->misc;
                
                $where_idk['id_k'] = $this->input->post('u_id_k');
                $datax['identitas_karyawan'] = $this->Absen_M->read('data_k',$where_idk)->result();
                $jabatan_k = $datax['identitas_karyawan'][0]->jabatan_k;
                unset($where_idm,$datax,$where_idk);

                // $total_denda = 0;
                // $loop = $difference / 0.5;
                // for ($i=1; $i <=$loop ; $i++) { 
                //     if ($i % 2 == 0) {
                //         $total_denda += $denda_ijin;
                //     }
                // }
                // $data['denda'] = $total_denda;
                if ($jabatan_k != 12 && $data['end'] !="00:00:00") {
                    $datetime1 = new DateTime($data['end']);
                    $datetime2 = new DateTime($data['start']);
                    $interval = $datetime1->diff($datetime2);

                    $jam = $interval->format('%H');
                    $menit = $interval->format('%I');
                    $detik  = $interval->format('%S');
                    $to_menit = ($jam * 60) + ($menit) + ($detik / 60);/*calculate minute*/
                    $to_menit_round =ceil($to_menit);
                    $bagi_60 = $to_menit / 60;/*bagi 60 menitan*/
                    $bagi_60_round = ceil($bagi_60);/*untuk pengali denda*/
                    $total_denda= $bagi_60_round * $denda_ijin;
                    $data['denda'] = $total_denda;
                }
                else{
                    $data['denda'] = 0;
                }

                $result = $this->Absen_M->update('data_i',$dataCondition,$data);
                $results = json_decode($result, true);
                /*false  object*/
                /*true  array*/
                if ($results['status']) {
                    $alert_update_ijin_acc = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Update Ijin Berhasil!</strong></div>";
                }else{
                    if ($results['error_message']['code'] == 1062) {
                        $alert_update_ijin_acc = "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Update Ijin gagal! </strong></div>";
                    }else{
                        $alert_update_ijin_acc = "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Update Ijin gagal!</strong></div>";
                    }
                }
            }
            echo json_encode($alert_update_ijin_acc);
        }
    }
    public function delete_ijinku()
    {
        $dataCondition['id_i'] = $this->input->post('id_del');
        $result = $this->Absen_M->delete('data_i',$dataCondition);
        if($result){
            $alert_delete_ijin_acc = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Delete Ijin Berhasil! </strong> </div>";
            $this->session->set_flashdata('alert_delete_ijin_acc', $alert_delete_ijin_acc);
        }
        else{
            $alert_delete_ijin_acc = "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Delete Ijin Gagal! </strong></div>";
            $this->session->set_flashdata('alert_delete_ijin_acc', $alert_delete_ijin_acc);
        }
        echo json_encode($alert_delete_ijin_acc);
    }
}
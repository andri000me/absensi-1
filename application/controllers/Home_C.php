<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home_C extends CI_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->model('Absen_M');
		date_default_timezone_set("Asia/Jakarta");
    }
	public function view_absen()
	{
		$date = date('Y-m-d');
		$dt = strtotime($date);
		$day = date("l",$dt);

		$dataCondition['tanggal'] = $date;
		$apakah_hari_libur = $this->Absen_M->read('data_libur',$dataCondition)->result();
		unset($dataCondition['tanggal']);
		if(($apakah_hari_libur != array() OR $day == 'Sunday' OR $day == 'Saturday' ) AND isset($this->session->userdata['logged_in']) == false) {
			$this->load->view('html/header');
			$this->load->view('html/block');
		}
		// elseif(($apakah_hari_libur != array() OR $day == 'Sunday' OR $day == 'Saturday' ) AND isset($this->session->userdata['logged_in']) == true){
		// 	redirect('User_C');
		// }
		else {
			$data['nama_karyawan']=$this->Absen_M->readS('data_k')->result();
			$data['status']=$this->Absen_M->readS('data_s')->result();
			// echo "<pre>";
			// var_dump($data['status']);
			foreach ($data['status'] as $key) {
				$array_status[$key->id_s]=array('nama' => $key->keterangan_s,
					'info' => $key->info_s);
			}
			$data['array_status1'] =$array_status;
			$data['arrst'] = json_encode($data['array_status1']);
			// var_dump($data['array_status1']);
			// var_dump($array_status);
			// echo "</pre>";
			// $array_status

			$where_idm['id_m'] =  1;$datax['jam_masuk'] = $this->Absen_M->read('data_m',$where_idm)->result();
			$data['jam_masuk'] = $datax['jam_masuk'][0]->misc;
			$where_idm['id_m'] =  4;$datax['jam_pulang'] = $this->Absen_M->read('data_m',$where_idm)->result();
			$data['jam_pulang'] = $datax['jam_pulang'][0]->misc;
			unset($datax,$where_idm);
			$this->load->view('html/header');
			$this->load->view('html/menu');
			$this->load->view('Home/absen',$data);
			$this->load->view('html/footer');
		}
	}
	public function view_ijin()
	{
		if (!$this->session->userdata('logged_in')){
            redirect();
        }
		$date = date('Y-m-d');
		$dataCondition['tanggal'] = $date;
		$apakah_hari_libur = $this->Absen_M->read('data_libur',$dataCondition)->result();
		unset($dataCondition['tanggal']);
		if ($apakah_hari_libur != array() AND isset($this->session->userdata['logged_in']) == false) {
			$this->load->view('html/header');
			$this->load->view('html/block');
		}elseif($apakah_hari_libur != array() AND isset($this->session->userdata['logged_in']) == true){
			redirect('Jabatan_C');
		}
		else {
			$where_idm['id_m'] =  6;
			$data['denda_ijin'] = $this->Absen_M->read('data_m',$where_idm)->result();
			$data['denda_ijin'] = $data['denda_ijin'][0]->misc;

			$data['nama_karyawan']=$this->Absen_M->readS('data_k')->result();
			$dataCondition['end']= '00:00:00';
			$data['ijin']=$this->Absen_M->rawQuery("
				SELECT data_k.nama_k, 
				data_i.perihal,
				data_i.start, 
				data_i.end, 
				data_i.tanggal, 
				data_i.id_i 
				FROM data_i 
				INNER JOIN data_k ON data_i.id_k = data_k.id_k 
				WHERE end = '".$dataCondition['end']."'")->result();

			$data['list_ijin']=$this->Absen_M->rawQuery("
				SELECT data_k.nama_k, 
				data_i.perihal, 
				data_i.start, 
				data_i.end, 
				data_i.tanggal, 
				data_i.id_i,
				data_i.denda 
				FROM data_i INNER JOIN data_k ON data_i.id_k = data_k.id_k 
				WHERE tanggal = '".$date."'")->result();
			unset($dataCondition);
			$where_idm['id_m'] =  1;$datax['jam_masuk'] = $this->Absen_M->read('data_m',$where_idm)->result();
			$data['jam_masuk'] = $datax['jam_masuk'][0]->misc;
			$where_idm['id_m'] =  4;$datax['jam_pulang'] = $this->Absen_M->read('data_m',$where_idm)->result();
			$data['jam_pulang'] = $datax['jam_pulang'][0]->misc;
			unset($datax,$where_idm);
			$this->load->view('html/header');
			$this->load->view('html/menu');
			$this->load->view('Home/ijin',$data);
			$this->load->view('html/footer');
		}
	}
	public function hari_ini()
	{
		$this->load->view('html/header');
		$this->load->view('html/menu');
		$this->load->view('Home/hari_ini');
		$this->load->view('html/footer');
	}
	public function view_dashboard()
	{
		if (!$this->session->userdata('logged_in')){
            redirect();
        }
		$dataCondition['tanggal'] = date('Y-m-d');
		$apakah_hari_libur = $this->Absen_M->read('data_libur',$dataCondition)->result();
		unset($dataCondition['tanggal']);
		$data['nama_karyawan']=$this->Absen_M->readS('data_k')->result();
		$data['status']=$this->Absen_M->readS('data_s')->result();
		$this->load->view('html/header');
		$this->load->view('html/menu');
		$this->load->view('Home/dashboard',$data);
		$this->load->view('html/footer');
	}
	public function show_absen()
	{
		$date= date('Y-m-d');
		$data['absen']=$this->Absen_M->rawQuery("
				SELECT data_ra.id_a, 
				data_s.keterangan_s, 
				data_ra.detail, 
				data_ra.tanggal, 
				data_ra.jam, 
				data_ra.acc, 
				data_k.nama_k, 
				data_ra.denda FROM data_ra
				INNER JOIN data_k ON data_ra.id_k = data_k.id_k
				INNER JOIN data_s ON data_ra.id_s = data_s.id_s
				WHERE tanggal = '".$date."'	ORDER BY data_ra.id_a DESC ")->result();
		echo json_encode($data);
	}
	public function show_ijin()
	{
		$date= date('Y-m-d');
		$dataCondition['end']= '00:00:00';
		$data['ijin']=$this->Absen_M->rawQuery("
			SELECT data_k.nama_k, 
			data_i.perihal, 
			data_i.start, 
			data_i.end, 
			data_i.tanggal, 
			data_i.id_i 
			FROM data_i INNER JOIN data_k ON data_i.id_k = data_k.id_k 
			WHERE end = '".$dataCondition['end']."'")->result();
		$data['list_ijin']=$this->Absen_M->rawQuery("
			SELECT data_k.nama_k, 
			data_i.perihal, 
			data_i.start, 
			data_i.end, 
			data_i.tanggal, 
			data_i.id_i,
			data_i.denda 
			FROM data_i INNER JOIN data_k ON data_i.id_k = data_k.id_k 
			WHERE tanggal = '".$date."'")->result();
		unset($dataCondition);
		echo json_encode($data);
	}
	public function login()
	{
		$this->form_validation->set_rules('l_username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('l_password', 'Password', 'trim|required|xss_clean');
		if ($this->form_validation->run() == FALSE) {
			if(isset($this->session->userdata['logged_in'])){
				$this->session->set_flashdata("alert_login_validate", "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>anda sudah login!</strong></div>");
			}else{
				$this->session->set_flashdata("alert_login_validate", "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>login gagal!</strong> </div>");
			}
			redirect();
		}
		else {
			$data = array(	'username_k' => $this->input->post('l_username'),
							'password_k' => md5($this->input->post('l_password')
			));
			$result = $this->Absen_M->read('data_l',$data)->result();
			$data_k['id_k'] = $result[0]->id_k;
			$link_foto = $this->Absen_M->read('data_k',$data_k)->result();
			if ($result != array()) {
				$session_data = array(
					'username' => $result[0]->username_k,
					'id_k' => $result[0]->id_k,
					'hak_akses' => $result[0]->hak_akses,
					'nama_k'=>$link_foto[0]->nama_k,
					'link_foto' => $link_foto[0]->foto_k
				);
				if (($session_data['hak_akses'] == '1') or ($session_data['hak_akses'] == '2')) { //saat punya hak akses
					$this->session->set_flashdata("alert_login", "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' 	aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>login sukses!</strong> Selamat datang ".$session_data['nama_k']." </div>");
					// $this->session->set_flashdata("alert_welcome", "Selamat datang ".$session_data['nama_k']);

					$this->session->set_userdata('logged_in', $session_data);
					redirect('Home_C/view_dashboard');
				} else { // saat punya username dan password tapi tidak punya hak akses
					$this->session->set_flashdata("alert_login", "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' 	aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>anda bukan admin!</strong> </div>");
					redirect();
				}
			} else {//username password tidak ditemukan
				$this->session->set_flashdata("alert_login", "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Anda tidak punya akses!</strong> </div>");
				redirect();
			}
		}
	}
	public function logout() 
	{
		$sess_array = array(
							'username' => '',
							'id_k' =>'',
							'hak_akses' =>''
		);
		$this->session->unset_userdata('logged_in', $sess_array);
		$this->session->set_flashdata("alert_login", "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Logged out!</strong> </div>");
		redirect();
	}
	public function create_absen_free()
	{
		if ($this->input->post() != null) 
		{
			// start check apakah (hari itu adalah tanggal merah) atau (hari itu adalah sabtu atau minggu)
			$data['tanggal'] = $this->input->post('c_tanggal');
			$dataCondition['tanggal'] =$data['tanggal'];
			$result = $this->Absen_M->read('data_libur',$dataCondition)->result();
			$dt = strtotime($data['tanggal']);
			$day = date("l",$dt);
			// var_dump($day);
			if (($result == array()) and ($day != 'Sunday' and $day != 'Saturday')) {// cek apakah itu adalah hari kerja
				// start check apakah sudah ada absen pada tanggal dari form
				$data['id_k'] = $this->input->post('c_id_k');
				$dataCondition['id_k'] = $data['id_k'];
				$result = $this->Absen_M->read('data_ra',$dataCondition)->result();
				if ($result == array()) {/*jika tidak ada absen pada tanggal itu maka start membuat absensi*/
					$where_idm['id_m'] =  1;$datax['jam_masuk'] = $this->Absen_M->read('data_m',$where_idm)->result();
					$jam_masuk = $datax['jam_masuk'][0]->misc;
					$where_idm['id_m'] =  4;$datax['jam_pulang'] = $this->Absen_M->read('data_m',$where_idm)->result();
					$jam_pulang = $datax['jam_pulang'][0]->misc;
					$where_idm['id_m'] =  9;$datax['jam_kerja_custom'] = $this->Absen_M->read('data_m',$where_idm)->result();
					$jam_kerja_custom = $datax['jam_kerja_custom'][0]->misc;
					unset($dataCondition['tanggal']);
					$datax['identitas_karyawan'] = $this->Absen_M->read('data_k',$dataCondition)->result();
					$data['id_s'] = $this->input->post('c_status');
					$data['detail'] = $this->input->post('c_detail');
					$data['jam'] = $this->input->post('c_jam');
					$data['acc'] = 1;
					if ($data['id_s'] == 1) {/*penentuan late_minute dan denda jika status adalah hadir*/
						if ($data['detail']=='telat') {/* maka hitung denda*/
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
							$to_menit_round =ceil($to_menit);/*kelewat 1 detik, langsung kehitung menit++ untuk ngisi late_minute*/
							$bagi_15 = $to_menit / 15;/*bagi 15 menitan*/
							$bagi_15_round = ceil($bagi_15);/*untuk pengali denda*/
							if ($datax['identitas_karyawan'][0]->jabatan_k != 12) { /*jika bukan anak magang*/
								$data['denda'] = $bagi_15_round * $denda_terlambat;
							}else { /*jika anak magang*/
								$data['denda'] = 0;
							}
							$data['late_minute'] = $to_menit_round;
						}else{/*jika tepat waktu*/
							$data['denda'] = 0;
							$data['late_minute'] = 0;
						}
						// var_dump($data);
						$result = $this->Absen_M->create('data_ra',$data);
						if($result)
						{
							echo "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Absen Hadir ".$datax['identitas_karyawan'][0]->nama_k." berhasil!</strong> Hadir jam ".$data['jam'].".  Denda anda Rp.".number_format($data['denda'],2,',','.')." terlambat ".$data['late_minute']." menit</div>";
						}
						else{
							echo "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Absen gagal DB!</strong></div>";
						}
					}
					elseif ($data['id_s'] == 2) {/*contoh : hadir pukul 11.00 karena ijin guru. tidak dikenakan denda, dan late minute=0 */
						$data['detail'] = "other";
						$data['id_s'] = 1;
						$data['late_minute'] = 0;
						$data['denda'] = 0;
						$result = $this->Absen_M->create('data_ra',$data);
						if($result){
							echo "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Hadir other untuk ".$datax['identitas_karyawan'][0]->nama_k." berhasil! </strong> denda  Rp.0</div>";
						}
						else
						{
							echo "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Cuti gagal! DB</strong></div>";
						}
					}
					elseif ($data['id_s'] == 5) {/*alpha*/
						if ($datax['identitas_karyawan'][0]->jabatan_k != 12) {
							$where_idm['id_m'] =  8;
							$datax['denda_alpha'] = $this->Absen_M->read('data_m',$where_idm)->result();
							$denda_alpha = (int)$datax['denda_alpha'][0]->misc;

							$datetime1 = new DateTime($jam_masuk);
							$datetime2 = new DateTime($jam_pulang);
							$interval = $datetime1->diff($datetime2);

							$jam = $interval->format('%H');
							$menit = $interval->format('%I');
							$detik  = $interval->format('%S');

							$to_menit = ($jam * 60) + ($menit) + ($detik / 60);/*calculate minute*/
							$bagi_15 = $to_menit / 15;/*bagi 15 menitan*/
							$bagi_15_round = ceil($bagi_15);/*untuk pengali denda*/
							
							$data['denda'] = $bagi_15_round * $denda_alpha ;
						}
						else{//saat anak magang
							$data['denda'] = 0;
						}
						// echo "<pre>";
						// var_dump($bagi_15);
						// var_dump($bagi_15_round);
						// var_dump($denda_alpha);
						// var_dump($data['denda']);
						// echo "</pre>";
						$data['detail'] = $this->input->post('c_detail');							
						$result = $this->Absen_M->create('data_ra',$data);
						if($result)
						{
							echo "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Absen Alpha ".$datax['identitas_karyawan'][0]->nama_k." berhasil!</strong> Denda anda Rp. ".number_format($data['denda'],2,',','.')."</div>";
						}
						else{
							echo "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Absen gagal DB!</strong></div>";
						}
					}
					elseif ($data['id_s'] == 6 ) {/*ijin 1hari*/
						if ($datax['identitas_karyawan'][0]->jabatan_k != 12) {
							$where_idm['id_m'] =  5;$datax['denda_ijin_1_hari'] = $this->Absen_M->read('data_m',$where_idm)->result();
							$denda_ijin_1_hari = $datax['denda_ijin_1_hari'][0]->misc;
							$data['denda'] = $jam_kerja_custom * $denda_ijin_1_hari;
						}else{
							$data['denda'] = 0;
						}
						$data['late_minute'] = 0;
						$data['detail'] = $this->input->post('c_detail');
						$result = $this->Absen_M->create('data_ra',$data);
						if($result)
						{
							echo "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Absen ijin 1 hari ".$datax['identitas_karyawan'][0]->nama_k." berhasil!</strong> Denda anda Rp.".number_format($data['denda'],2,',','.')."</div>";
						}
						else{
							echo "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Absen gagal DB!</strong></div>";
						}
					}
					elseif($data['id_s'] == 4){/*sakit*/
						$where_idm['id_m'] =  7;
						$datax['denda_terlambat'] = $this->Absen_M->read('data_m',$where_idm)->result();
						$denda_terlambat = $datax['denda_terlambat'][0]->misc;
						unset($where_idm);
						if ($data['jam'] > $jam_masuk && $data['jam'] < $jam_pulang ) {
							
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
						elseif ($data['jam'] > $jam_pulang) {
							$datetime1 = new DateTime($jam_masuk);
							$datetime2 = new DateTime($jam_pulang);
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
						$data['detail'] = $this->input->post('c_detail');
						$result = $this->Absen_M->create('data_ra',$data);
						if($result){
							echo "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Absen sakit ".$datax['identitas_karyawan'][0]->nama_k." berhasil!</strong> Denda anda Rp.".number_format($data['denda'],2,',','.')."</div>";
						}
						else{
							echo "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Absen gagal DB!</strong></div>";
						}
					}
					elseif ($data['id_s'] == 3){/*cuti*/
						if ($datax['identitas_karyawan'][0]->bisa_cuti == '0' and $datax['identitas_karyawan'][0]->jabatan_k != 12) { //alert untuk karyawan
							echo "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Anda belum bisa cuti!</strong></div>";
						}
						elseif ($datax['identitas_karyawan'][0]->jabatan_k == '12') { //alert untuk magang
							echo "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Magang tidak boleh cuti!</strong></div>";
						}
						else{// bisa_cuti ==1 dan bukan anak magang
							$data_c = $this->Absen_M->read('data_c',$dataCondition)->result();
							$wes_cuti = $data_c[0]->cuti_berapakali;
							$jatah_cuti = $data_c[0]->jatah_cuti;
							if ($wes_cuti == $jatah_cuti){
								echo "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Cuti gagal!</strong> Batas cuti ".$datax['identitas_karyawan'][0]->nama_k." sudah habis</div>";
							}
							else{
								$result = $this->Absen_M->create('data_ra',$data);
								if($result){
									$sisa_cuti = $jatah_cuti-$wes_cuti-1;
									echo "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Cuti untuk ".$datax['identitas_karyawan'][0]->nama_k." berhasil! </strong> jatah cuti ".$datax['identitas_karyawan'][0]->nama_k." tinggal ".$sisa_cuti."</div>";
								}
								else
								{
									echo "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Cuti gagal! DB</strong></div>";
								}
							}	
						}
					}
				}else{
					echo "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>ada absen pada tanggal itu juga</strong></div>";
				}
			}else{
				echo "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>tanggal di form bukan hari kerja</strong></div>";
			}
		}
	}
	public function create_absen()
	{
		if ($this->input->post() != null) {
			$data['tanggal'] = date("Y-m-d");
			$dataCondition['tanggal'] = $data['tanggal'];

			$result = $this->Absen_M->read('data_libur',$dataCondition)->result();
			$dt = strtotime($data['tanggal']);
			$day = date("l",$dt);
			// var_dump($day);
			if (($result == array()) and ($day != 'Sunday' and $day != 'Saturday')) {// cek apakah itu adalah hari kerja
				$dataCondition['id_k'] = $this->input->post('c_id_k');

				$result = $this->Absen_M->read('data_ra',$dataCondition)->result();
				unset($dataCondition['tanggal']);
				$datax['identitas_karyawan'] = $this->Absen_M->read('data_k',$dataCondition)->result();
				if ($result == array()) { /*belum absen hari ini*/
					$dataCondition['password_k'] = md5($this->input->post('c_password'));
					$result = $this->Absen_M->read('data_l',$dataCondition)->result();
					unset($dataCondition['password_k']);
					if ($result != array()) {//auth sukses
						$data['id_k'] = $dataCondition['id_k'];
						$data['id_s'] = $this->input->post('c_status');
						$data['jam'] = date('H:i:s', time());
						// $data['jam'] = "07:44:42";
						$data['acc'] ='0';
						$where_idm['id_m'] =  1;$datax['jam_masuk'] = $this->Absen_M->read('data_m',$where_idm)->result();
						$jam_masuk = $datax['jam_masuk'][0]->misc;
						$where_idm['id_m'] =  4;$datax['jam_pulang'] = $this->Absen_M->read('data_m',$where_idm)->result();
						$jam_pulang = $datax['jam_pulang'][0]->misc;
						$where_idm['id_m'] =  9;$datax['jam_kerja_custom'] = $this->Absen_M->read('data_m',$where_idm)->result();
						$jam_kerja_custom = $datax['jam_kerja_custom'][0]->misc;
						if ($data['id_s'] == 1){
							if ($data['jam']>$jam_pulang) {
								echo "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Eror!</strong></div>";
								die();
							}
							elseif ($data['jam'] > $jam_masuk and $data['jam'] < $jam_pulang){/*menentukan telat atau tidak sekaligus denda*/
								if ($datax['identitas_karyawan'][0]->jabatan_k != 12) {/*saat bukan anak magang*/
									
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
							// echo "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Absen Hadir ".$datax['identitas_karyawan'][0]->nama_k." berhasil!</strong> Denda anda Rp.".number_format($data['denda'],2,',','.')." Late ".$data['late_minute']."</div>";
							$result = $this->Absen_M->create('data_ra',$data);
							if($result)
							{
								echo "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Absen Hadir ".$datax['identitas_karyawan'][0]->nama_k." berhasil!</strong> Denda anda Rp.".number_format($data['denda'],2,',','.').". Terlambat ".$data['late_minute']."menit</div>";
							}
							else{
								echo "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Absen gagal DB!</strong></div>";
							}
						}
						elseif ($data['id_s'] == 2) {/*hadir pukul 11.00 karena ijin guru. tidak dikenakan denda, dan late minute=0 */
							$data['detail'] = "other";
							$data['id_s'] = 1;
							$result = $this->Absen_M->create('data_ra',$data);
							if($result){
								echo "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Hadir other untuk ".$datax['identitas_karyawan'][0]->nama_k." berhasil! </strong> denda  Rp.0</div>";
							}
							else
							{
								echo "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Cuti gagal! DB</strong></div>";
							}
						}
						elseif ($data['id_s'] == 3){/*cuti*/
							if ($datax['identitas_karyawan'][0]->bisa_cuti == '0' and $datax['identitas_karyawan'][0]->jabatan_k != 12) { //alert untuk karyawan
								echo "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Anda belum bisa cuti!</strong></div>";
							}
							elseif ($datax['identitas_karyawan'][0]->jabatan_k == '12') { //alert untuk magang
								echo "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Magang tidak boleh cuti!</strong></div>";
							}
							else{// bisa_cuti ==1 dan bukan anak magang
								$data['detail'] = $this->input->post('c_detail');
								$where_idk['id_k'] = $data['id_k'];
								$data_c = $this->Absen_M->read('data_c',$where_idk)->result();
								$wes_cuti = $data_c[0]->cuti_berapakali;
								$jatah_cuti = $data_c[0]->jatah_cuti;
								if ($wes_cuti == $jatah_cuti){
									echo "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Cuti gagal!</strong> Batas cuti ".$datax['identitas_karyawan'][0]->nama_k." sudah habis</div>";
								}
								else{
									$result = $this->Absen_M->create('data_ra',$data);
									if($result){
										$sisa_cuti = $jatah_cuti-1;
										echo "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Cuti untuk ".$datax['identitas_karyawan'][0]->nama_k." berhasil! </strong> jatah cuti ".$datax['identitas_karyawan'][0]->nama_k." tinggal ".$sisa_cuti."</div>";
									}
									else
									{
										echo "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Cuti gagal! DB</strong></div>";
									}
								}	
							}
						}
						elseif($data['id_s'] == 4){/*sakit*/
							$where_idm['id_m'] =  7;
							$datax['denda_terlambat'] = $this->Absen_M->read('data_m',$where_idm)->result();
							$denda_terlambat = $datax['denda_terlambat'][0]->misc;
							unset($where_idm);
							if ($data['jam'] > $jam_masuk && $data['jam'] < $jam_pulang ) {
								
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
							elseif ($data['jam'] > $jam_pulang) {
								$datetime1 = new DateTime($jam_masuk);
								$datetime2 = new DateTime($jam_pulang);
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
							else if($data['jam'] > $jam_pulang){
								
							}
							elseif ($data['jam'] < $jam_masuk) {
								$data['denda'] = 0;
								$data['late_minute'] = 0;
							}
							$data['detail'] = $this->input->post('c_detail');
							$result = $this->Absen_M->create('data_ra',$data);
							if($result){
								echo "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Absen sakit ".$datax['identitas_karyawan'][0]->nama_k." berhasil!</strong> Denda anda Rp.".number_format($data['denda'],2,',','.').". Terlambat ".$data['late_minute']."</div>";
							}
							else{
								echo "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Absen gagal DB!</strong></div>";
							}
						}
						elseif ($data['id_s'] == 5) {/*alpha*/
							if ($datax['identitas_karyawan'][0]->jabatan_k != 12) {
								$where_idm['id_m'] =  8;
								$datax['denda_alpha'] = $this->Absen_M->read('data_m',$where_idm)->result();
								$denda_alpha = $datax['denda_alpha'][0]->misc;
								$data['denda'] = $jam_kerja_custom * $denda_alpha * 4;
							}
							else{//saat anak magang
								$data['denda'] = 0;
							}
							$data['detail'] = $this->input->post('c_detail');							
							$result = $this->Absen_M->create('data_ra',$data);
							if($result)
							{
								echo "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Absen Alpha ".$datax['identitas_karyawan'][0]->nama_k." berhasil!</strong> Denda anda Rp. ".number_format($data['denda'],2,',','.')."</div>";
							}
							else{
								echo "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Absen gagal DB!</strong></div>";
							}
						}
						elseif ($data['id_s'] == 6 ) {/*ijin 1hari*/
							if ($datax['identitas_karyawan'][0]->jabatan_k != 12) {
								$where_idm['id_m'] =  5;$datax['denda_ijin_1_hari'] = $this->Absen_M->read('data_m',$where_idm)->result();
								$denda_ijin_1_hari = $datax['denda_ijin_1_hari'][0]->misc;
								$data['denda'] = $jam_kerja_custom * $denda_ijin_1_hari;
							}else{
								$data['denda'] = 0;
							}
							$data['detail'] = $this->input->post('c_detail');
							$result = $this->Absen_M->create('data_ra',$data);
							if($result)
							{
								echo "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Absen ijin 1 hari ".$datax['identitas_karyawan'][0]->nama_k." berhasil!</strong> Denda anda Rp.".number_format($data['denda'],2,',','.')."</div>";
							}
							else{
								echo "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Absen gagal DB!</strong></div>";
							}
						}
						else{
							echo "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Not Handled</strong></div>";
						}
					}
					else {
						echo "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong> Authentication failed!</strong></div>";
					}
				}
				else{
					echo "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong> ".$datax['identitas_karyawan'][0]->nama_k." sudah absen hari ini</strong></div>";
				}
			}
			else{
					echo "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong> Bukan hari kerja</strong></div>";
			}
		}
	}
	public function create_ijin_free()
	{
		if ($this->input->post() != null) {
			$data['start'] = $this->input->post('c_jam_start');
			$data['end'] = $this->input->post('c_jam_end');
			$data['id_k'] = $this->input->post('c_id_k');
			$data['tanggal'] = $this->input->post('c_tanggal');

			$kurangi = $this->input->post('c_kurangi');
			$kurangii = $this->input->post('c_kurangii');

			$where_idm['id_m'] =  1;
			$datax['jam_masuk'] = $this->Absen_M->read('data_m',$where_idm)->result();
			$jam_masuk = $datax['jam_masuk'][0]->misc;

			$where_idm['id_m'] =  4;
			$datax['jam_pulang'] = $this->Absen_M->read('data_m',$where_idm)->result();
			$jam_pulang = $datax['jam_pulang'][0]->misc;

			$where_idk['id_k'] = $data['id_k'];
			$datax['identitas_karyawan'] = $this->Absen_M->read('data_k',$where_idk)->result();
			$jabatan_k = $datax['identitas_karyawan'][0]->jabatan_k;

			unset($datax,$where_idm,$where_idk);
			/*didalam jam kerja atau tidak sudah di validasi di javascript ijin.php*/
			// if ($data['start'] > $jam_pulang OR $data['start'] < $jam_masuk ) {
			// 	$alert_create_ijin =  "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>tidak di dalam jam kerja</strong></div>";	
			// }

			$datar['id_k']  = $data['id_k'];
			$datar['tanggal'] = $data['tanggal'];
			$datar['id_s'] = '1';
			$datar['acc'] = '1';

			$apakah_hadir_dan_acc = $this->Absen_M->read('data_ra',$datar)->result();
			unset($datar);

			if ($apakah_hadir_dan_acc != array()) {
				$data['perihal'] = $this->input->post('c_perihal');

				$datetime1 = new DateTime($data['end']);
				$datetime2 = new DateTime($data['start']);
				$interval = $datetime1->diff($datetime2);

				$jam = $interval->format('%H');
				$menit = $interval->format('%I');
				$detik  = $interval->format('%S');

				$to_menit = ($jam * 60) + ($menit) + ($detik / 60);/*calculate minute*/
				$to_menit_round =ceil($to_menit);/*kelewat 1 detik, langsung kehitung menit++ untuk ngisi late_minute*/
				if($to_menit_round >= 30) {
					if ($jabatan_k != 12) {
						$where_idm['id_m'] =  6;
						$datax['denda_ijin'] = $this->Absen_M->read('data_m',$where_idm)->result();
						$denda_ijin = $datax['denda_ijin'][0]->misc;

						// $total_denda = 0;
						// $loop = $to_menit_round / 30;
						// for ($i=1; $i <=$loop ; $i++) { 
						// 	if ($i % 2 == 0) {
						// 		$total_denda += $denda_ijin;
						// 	}
						// }
						$bagi_60 = $to_menit / 60;/*bagi 60 menitan*/
						$bagi_60_round = ceil($bagi_60);/*untuk pengali denda*/

						if ($kurangi != '') {
							$bagi_60_round = $bagi_60_round - 1;
						}
						if ($kurangii != '') {
							$bagi_60_round = $bagi_60_round - 0.5;
						}

						$total_denda= $bagi_60_round * $denda_ijin;
						$data['denda'] = $total_denda;
					}
					else{
						$data['denda'] = 0;
					}
					$alert_create_ijin = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>".$bagi_60_round."</div>";

					// $result = $this->Absen_M->create('data_i',$data);
					// if($result){
		 		// 		$alert_create_ijin =  "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>ijin berhasil dibuat</strong></div>";
		 		// 	}else{
		 		// 		$alert_create_ijin =  "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>gagal memasukkan ke database</strong></div>";	
		 		// 	}
				} else {
					$alert_create_ijin = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>ijin berhasil di stop.</strong> Data ijin anda dihapus karena kurang dari 30 menit</div>";
				}
			}
			else{
				$alert_create_ijin = "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>belum hadir dan acc.</strong></div>";
			}
		}
		echo json_encode($alert_create_ijin);
	}
	public function create_ijin()
	{
		if ($this->input->post() != null) {
			$data['id_k'] = $this->input->post('c_id_k');
			$data['perihal'] = $this->input->post('c_perihal');
			$data['start'] = date('H:i:s', time());
			$data['tanggal'] = date('Y-m-d');
			
			$where_idm['id_m'] =  1;
			$datax['jam_masuk'] = $this->Absen_M->read('data_m',$where_idm)->result();
			$jam_masuk = $datax['jam_masuk'][0]->misc;

			$where_idm['id_m'] =  4;
			$datax['jam_pulang'] = $this->Absen_M->read('data_m',$where_idm)->result();
			$jam_pulang = $datax['jam_pulang'][0]->misc;

			unset($datax,$where_idm);

			$datar['id_k']  = $data['id_k'];
			$datar['tanggal'] = $data['tanggal'];
			$datar['id_s'] = '1';
			$datar['acc'] = '1';

			$apakah_hadir_dan_acc = $this->Absen_M->read('data_ra',$datar)->result();
			unset($datar['id_s'],$datar['acc']);

			$datar['end'] = "00:00:00";
			if (date('H:i:s') > $jam_pulang or date('H:i:s') < $jam_masuk) {
				$alert_create_ijin =  "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Diluar jam kerja</strong></div>";
			} else {
				if ($apakah_hadir_dan_acc != array()) {
					$apakah_ijinku_belum_end =$this->Absen_M->read('data_i',$datar)->result();
					if ($apakah_ijinku_belum_end == array()) {
						if ($data['start'] < $jam_masuk){
				 			$alert_create_ijin =  "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>jam start belum masuk jam kerja</strong></div>";	
				 		}else {
				 			$insert_data_t = $this->Absen_M->create('data_i',$data);
				 			if($insert_data_t){
				 				$alert_create_ijin =  "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>ijin berhasil</strong> ijin anda akan distop oleh admin saat anda kembali</div>";
				 			}else{
				 				$alert_create_ijin =  "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>gagal memasukkan ke database</strong></div>";	
				 			}
				 		}
					} else {
						$alert_create_ijin =  "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>anda masih punya tanggungan ijin</strong></div>";	
					}
					
			 	} else {
				 	$alert_create_ijin =  "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Harus hadir dan mendapat acc agar bisa ijin</strong></div>";	
				}
			}
			echo json_encode($alert_create_ijin);
			//redirect('Home_C/view/ijin');
		}
	}
	public function stop_ijin($data)
	{

		$where_idm['id_m'] =  4;
		$datax['jam_pulang'] = $this->Absen_M->read('data_m',$where_idm)->result();
		$jam_pulang = $datax['jam_pulang'][0]->misc;
		unset($datax,$where_idm);

		$where_idi['id_i'] =  $data;
		$datax['start'] = $this->Absen_M->read('data_i',$where_idi)->result();
		$start = $datax['start'][0]->start;
		$where_idk['id_k'] = $datax['start']->id_k;
		$datax['identitas_karyawan'] = $this->Absen_M->read('data_k',$where_idk)->result();
		$jabantan_k = $datax['identitas_karyawan'][0]->jabatan_k;
		unset($datax,$where_idi,$where_idk);

		$dataCondition['id_i'] = $data;
		// $datau['end'] = "10:15:00";
		$datau['end'] = date('H:i:s', time());

		if ($datau['end'] > $jam_pulang) {
			$datau['end'] = $jam_pulang;
		}
		
		$datetime1 = new DateTime($datau['end']);
		$datetime2 = new DateTime($start);
		$interval = $datetime1->diff($datetime2);

		$jam = $interval->format('%H');
		$menit = $interval->format('%I');
		$detik  = $interval->format('%S');

		$to_menit = ($jam * 60) + ($menit) + ($detik / 60);/*calculate minute*/
		$to_menit_round =ceil($to_menit);/*kelewat 1 detik, langsung kehitung menit++ untuk ngisi late_minute*/

		if($to_menit_round >= 30) {
			if ($jabatan_k != 12) {
				$where_idm['id_m'] =  6;
				$datax['denda_ijin'] = $this->Absen_M->read('data_m',$where_idm)->result();
				$denda_ijin = $datax['denda_ijin'][0]->misc;
				
				$bagi_60 = $to_menit / 60;/*bagi 60 menitan*/
				$bagi_60_round = ceil($bagi_60);/*untuk pengali denda*/
				$total_denda= $bagi_60_round * $denda_ijin;

				$datau['denda'] = $total_denda;
			}
			else{
				$datau['denda'] = 0;
			}
			$result = $this->Absen_M->update('data_i',$dataCondition,$datau);
			$results = json_decode($result, true);

			if ($results['status']) {
				$alert_stop_ijin = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>ijin berhasil di stop.</strong> Data ijin anda telah masuk ke laporan</div>";
			}
			else{
				$alert_stop_ijin = "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>ijin gagal di stop(database) </strong> </div>";
			}
		} else {
			$result = $this->Absen_M->delete('data_i',$dataCondition);
			if ($result) {
				$alert_stop_ijin = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>ijin berhasil di stop.</strong> Data ijin anda dihapus karena kurang dari 30 menit</div>";
			}
			else{
				$alert_stop_ijin = "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>ijin gagal di stop. </strong> ijin gagal di hapus(database) </div>";
			}
		}
		echo json_encode($alert_stop_ijin);
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
}

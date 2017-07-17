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
			$data['nama_karyawan']=$this->Absen_M->readS('data_k')->result();
			$data['status']=$this->Absen_M->readS('data_s')->result();

			$this->load->view('html/header');
			$this->load->view('html/menu');
			$this->load->view('Home/absen',$data);
			$this->load->view('html/footer');
		}
	}
	public function view_ijin()
	{
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
			$data['nama_karyawan']=$this->Absen_M->readS('data_k')->result();
			$dataCondition['end']= '00:00:00';
			$data['ijin']=$this->Absen_M->rawQuery("
				SELECT data_k.nama_k, data_i.perihal, data_i.start, data_i.end, data_i.tanggal, data_i.id_i FROM data_i INNER JOIN data_k ON data_i.id_k = data_k.id_k WHERE end = '".$dataCondition['end']."'")->result();
			$data['list_ijin']=$this->Absen_M->rawQuery("
				SELECT data_k.nama_k, data_i.perihal, data_i.start, data_i.end, data_i.tanggal, data_i.id_i,data_i.denda FROM data_i INNER JOIN data_k ON data_i.id_k = data_k.id_k WHERE tanggal = '".$date."'")->result();
			unset($dataCondition);

			$this->load->view('html/header');
			$this->load->view('html/menu');
			$this->load->view('Home/ijin',$data);
			$this->load->view('html/footer');
		}
	}
	public function view_dashboard()
	{
		$date = date('Y-m-d');
		$dataCondition['tanggal'] = $date;
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
				SELECT data_ra.id_a, data_s.keterangan_s, data_ra.detail, data_ra.tanggal, data_ra.jam, data_ra.acc, data_k.nama_k, data_ra.denda FROM data_ra
				INNER JOIN data_k ON data_ra.id_k = data_k.id_k
				INNER JOIN data_s ON data_ra.id_s = data_s.id_s
				WHERE tanggal = '".$date."' AND acc = 0	ORDER BY data_ra.id_a DESC ")->result();
		echo json_encode($data);
	}
	public function show_ijin()
	{
		$date= date('Y-m-d');
		$dataCondition['end']= '00:00:00';
		$data['ijin']=$this->Absen_M->rawQuery("
			SELECT data_k.nama_k, data_i.perihal, data_i.start, data_i.end, data_i.tanggal, data_i.id_i FROM data_i INNER JOIN data_k ON data_i.id_k = data_k.id_k WHERE end = '".$dataCondition['end']."'")->result();
		$data['list_ijin']=$this->Absen_M->rawQuery("
			SELECT data_k.nama_k, data_i.perihal, data_i.start, data_i.end, data_i.tanggal, data_i.id_i,data_i.denda FROM data_i INNER JOIN data_k ON data_i.id_k = data_k.id_k WHERE tanggal = '".$date."'")->result();
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
					'link_foto' => $link_foto[0]->foto_k
				);
				if (($session_data['hak_akses'] == '1') or ($session_data['hak_akses'] == '2')) {
					$this->session->set_flashdata("alert_login", "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' 	aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>login sukses!</strong> </div>");
					$this->session->set_userdata('logged_in', $session_data);
					// header('Location: http://localhost/absensi/Home_C/view');
				} else {
					$this->session->set_flashdata("alert_login", "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' 	aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>anda bukan admin!</strong> </div>");
					// redirect();
				}
			} else {
				$this->session->set_flashdata("alert_login", "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>username dan password tidak ditemukan!</strong> </div>");
				// redirect();
			}
		}
			redirect();
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
	
	public function create_absen()
	{
		if ($this->input->post() != null) {
			$data['id_k'] = $this->input->post('c_id_k');
			$data['id_s'] = $this->input->post('c_status');

			$where_idm['id_m'] =  1;
			$datax['jam_masuk'] = $this->Absen_M->read('data_m',$where_idm)->result();
			$jam_masuk = $datax['jam_masuk'][0]->misc;

			$where_idm['id_m'] =  4;
			$datax['jam_pulang'] = $this->Absen_M->read('data_m',$where_idm)->result();
			$jam_pulang = $datax['jam_pulang'][0]->misc;
			unset($where_idm);


			$data['tanggal'] = date("Y-m-d");
			//$data['tanggal'] = "2017-06-09";
			$data['jam'] = date('H:i:s', time());
			$data['acc'] ='0';
			
			

			if ($data['id_s'] == 1) 
			{
				if ($data['jam'] > $jam_masuk and $data['jam'] < $jam_pulang)
				{
					$time1 = strtotime($data['jam']);
					$time2 = strtotime($jam_masuk);

					$seperempat = round(1/4 ,2);
					$difference = round(abs($time1 - $time2) / 3600,2)  /*% $seperempat*/;
					$difference = floor($difference / $seperempat);
					$where_idm['id_m'] =  7;
					$datax['denda_terlambat'] = $this->Absen_M->read('data_m',$where_idm)->result();
					$denda_terlambat = $datax['denda_terlambat'][0]->misc;
					unset($where_idm,$datax);

					$data['denda'] = $difference * $denda_terlambat;
					$data['detail'] = "telat";
				}
				elseif ($data['jam']>$jam_pulang) {
					echo "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Eror!</strong></div>";
					die();
				}
				else
				{
					$data['detail'] = "tepat waktu";
					$data['denda'] = 0;	
				}
			}
			elseif ($data['id_s'] == 5) {
				$time1 = strtotime($jam_masuk);
				$time2 = strtotime($jam_pulang);

				$seperempat = round(1/4 ,2);
				$difference = round(abs($time2 - $time1) / 3600,2)-1  /*% $seperempat*/;
				$difference = floor($difference / $seperempat);
				
				$where_idm['id_m'] =  8;
				$datax['denda_alpha'] = $this->Absen_M->read('data_m',$where_idm)->result();
				$denda_alpha = $datax['denda_alpha'][0]->misc;
				unset($where_idm,$datax);

				$data['denda'] = $difference * $denda_alpha;
				$data['detail'] = $this->input->post('c_detail');
			}
			elseif ($data['id_s'] == 6) {
				$where_idm['id_m'] =  5;
				$datax['denda_ijin_1_hari'] = $this->Absen_M->read('data_m',$where_idm)->result();
				$denda_ijin_1_hari = $datax['denda_ijin_1_hari'][0]->misc;
				unset($where_idm,$datax);				
				$time1 = strtotime($jam_masuk);
				$time2 = strtotime($jam_pulang);
				$difference = round(abs($time2 - $time1) / 3600,2);
				// echo "{$difference}";
				$difference = $difference * $denda_ijin_1_hari;
				$data['denda'] = $difference;
				$data['detail'] = $this->input->post('c_detail');
			}
			else
			{
				$data['detail'] = $this->input->post('c_detail');
				$data['denda'] = 0;
			}

			$datas['id_k'] = $data['id_k'];
			$datas['tanggal'] = $data['tanggal'];
			$cari = $this->Absen_M->searchResult('data_ra',$datas)->result_array();//apakah sudah absen hari ini
			if ($cari == array())
			{
				$datas['start'] = $jam_masuk;
				$datas['end'] = $jam_pulang;
				if ($data['id_s'] == 3)
				{
					$where_idk['id_k'] = $data['id_k'];
					$data_k = $this->Absen_M->read('data_k',$where_idk)->result();
					if ($data_k[0]->bisa_cuti == 0 and $data_k[0]->jabatan_k != 12) {
						echo "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Anda belum bisa cuti!</strong></div>";
					}
					elseif ($data_k[0]->bisa_cuti==0 and $data_k[0]->jabatan_k == 12) {
						echo "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Magang tidak boleh cuti!</strong></div>";
					}
					else{// bisa_cuti ==1 dan bukan anak magang
						$data_c = $this->Absen_M->read('data_c',$where_idk)->result();
						$wes_cuti = $data_c[0]->cuti_berapakali;
						$jatah_cuti = $data_c[0]->jatah_cuti;
						
						if ($wes_cuti == $jatah_cuti)
						{
							echo "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Cuti gagal!</strong> Batas cuti anda habis</div>";
						}
						else
						{
							$result = $this->Absen_M->create('data_ra',$data);
							if($result){
								echo "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Cuti berhasil!</strong></div>";
							}
							else
							{
								echo "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Cuti gagal!</strong></div>";
							}
						}	
					}
				}
				else// hadir
				{
					$result = $this->Absen_M->create('data_ra',$data);
					if($result && $data['id_s'] != 6)
					{
						echo "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Absen berhasil!</strong></div>";
					}
					elseif ($result && $data['id_s'] == 6) {
						echo "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>ijin 1 hari berhasil!</strong> jangan lupa membayar sejumlah $data[denda]</div>";
					}
					elseif($result == false)
					{
						echo "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Absen gagal!</strong></div>";
					}
				}
			}
			else
			{
				echo "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>anda sudah absen hari ini!</strong></div>";
			}
		}		
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

			$datar['end']= "00:00:00";
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
			unset($datax,$where_idi);

			$dataCondition['id_i'] = $data;
			$datau['end'] = date('H:i:s', time());

			if ($datau['end'] > $jam_pulang) {
				$datau['end'] = $jam_pulang;
			}
			
			$time1 = strtotime($start);
			$time2 = strtotime($datau['end']);
			$difference = round(abs($time2 - $time1) / 3600,2);
			
			if ($difference >= 0.5) {

				$where_idm['id_m'] =  6;
				$datax['denda_ijin'] = $this->Absen_M->read('data_m',$where_idm)->result();
				$denda_ijin = $datax['denda_ijin'][0]->misc;
				unset($where_idm,$datax);

				$difference = round(ceil($difference), 0, PHP_ROUND_HALF_UP);
				$datau['denda']= $difference * $denda_ijin;

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
			// $this->session->set_flashdata('alert_update_absen_acc', $alert_update_absen_acc);
		}
		else{
			$alert_update_absen_acc = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>absen gagal di acc! </strong></div>";
			// $this->session->set_flashdata('alert_update_absen_acc', $alert_update_absen_acc);
		}
        echo $alert_update_absen_acc;
		// redirect('Acc_C/lihat/'.$bulan.'/'.$tahun);
    	
    }
    public function rejectAbsen()
    {
    	$dataUpdate['acc'] = 0;
    	$dataCondition['id_a'] = $this->input->post('id_rej');
    	$result = $this->Absen_M->update('data_ra',$dataCondition,$dataUpdate);
    	if($result){
			$alert_update_absen_acc = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong> absen berhasil di tolak!</strong></div>";
			// $this->session->set_flashdata('alert_update_absen_acc', $alert_update_absen_acc);
        }
        else{
            $alert_update_absen_acc = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>absen gagal di tolak! </strong></div>";
            // $this->session->set_flashdata('alert_update_absen_acc', $alert_update_absen_acc);
        }
        // redirect('Acc_C/lihat/'.$bulan.'/'.$tahun);
        echo $alert_update_absen_acc;
    }
}

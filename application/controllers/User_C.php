<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_C extends CI_Controller {
	//private $date;
	public function __construct(){
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
        $this->load->model('Absen_M');
    }
    public function cek_bisa_cuti_nol()
    {
    	$dataCondition['bisa_cuti'] = 0;
    	$query = $this->Absen_M->read("data_k",$dataCondition)->result();
    	// echo "<pre>";
    	if ($query != array()) {
	    	foreach ($query as $row) {
	    		//echo $row->date_added."<br>";
	    		$d1 = new DateTime();
				$d2 = new DateTime($row->date_added);
				$d3 = $d1->diff($d2);
				$d4 = ($d3->y*12)+$d3->m;
				// var_dump($d1);
				// var_dump($d2);
				// echo "D4:".$d4."<br>";
				// $a = 13;$b=12;
				// echo "13 %12 = ".($a % 12)."<br><br>";
				if ($d4 > 12) {					
					$dataCondition['id_k'] = $row->id_k;
					$dataUpdate['bisa_cuti'] = 1;
					$query = $this->Absen_M->update("data_k",$dataCondition,$dataUpdate);
					// $results = json_decode($query, true);
					unset($dataUpdate['bisa_cuti'],$dataCondition['id_k']);
					
					// if ($results['status']) {
					// 	echo "sukses k".$row->id_k."<br>";
					// }
					// else{
					// 	echo "gagal update k".$row->id_k;
					// }
					
					$dataC['id_k'] = $row->id_k;
					$data['jatah_cuti'] = $d4  % 12;
					$data['last_sync'] = date('Y-m-d');
					$queryl = $this->Absen_M->update("data_c",$dataC,$data);
					// $results = json_decode($queryl, true);
					// if ($results['status']) {
					// 	echo "sukses l".$row->id_k;
					// }
					// else{
					// 	var_dump($results['error_message']);
					// }
					unset($data['jatah_cuti'],$dataC['id_k'],$data['last_sync']);
				}
	    	}
    	}
    	// else{
    	// 	echo "nothing";
    	// }
    	// var_dump($query);
    	// echo "</pre>";
    }
    public function cek_bisa_cuti_satu()
    {
    	$query = $this->Absen_M->rawQuery("
				SELECT data_k.id_k,
					data_k.date_added,
					data_c.jatah_cuti,
					data_c.last_sync
				FROM data_k
				INNER JOIN data_c ON data_c.id_k = data_k.id_k
				WHERE data_k.bisa_cuti = 1
    	")->result();
    	foreach ($query as $row) {
    		// echo $row->last_sync;
    		$d1 = new DateTime($row->last_sync);
			$d2 = new DateTime();
			$d3 = $d1->diff($d2);
			$d4 = ($d3->y*12)+$d3->m;
    		if ($d4 != 0) {
    			$dataCondition['id_k'] = $row->id_k;
    			$dataUpdate['last_sync'] = date('Y-m-d');
    			$dataUpdate['jatah_cuti'] = (int)$row->jatah_cuti + $d4;
    			$update_data_c = $this->Absen_M->update('data_c',$dataCondition,$dataUpdate);
     			// $results = json_decode($update_data_c,true);
				// if ($results['status']) {
				// 	echo "sukses l=".$row->id_k."<br>";
				// }
				// else{
				// 	var_dump($results['error_message']);
				// }

    		}
    		// else{
    		// 	echo " >> 0 <br>";
    		// }
    	}

    }
    public function index()
    {
    	$this->cek_bisa_cuti_nol();
    	$this->cek_bisa_cuti_satu();
        $data['jabatans'] = $this->Absen_M->readS('data_j');
        $datar['hak_akses'] = 1;
        $data['id_admin'] = $this->Absen_M->read('data_l',$datar)->result();
        if (($this->session->userdata('logged_in')['id_k']) == ($data['id_admin'][0]->id_k)) {
        	$data['karyawan'] = $this->Absen_M->rawQuery("SELECT data_k.id_k,data_k.nama_k,data_k.alamat_k,data_k.email_k,data_k.noHp_k,data_k.jabatan_k,data_k.foto_k FROM data_l INNER JOIN data_k ON data_l.id_k = data_k.id_k WHERE data_k.id_k != ".$this->session->userdata('logged_in')['id_k']);
        } else {
        	$data['karyawan'] = $this->Absen_M->rawQuery("SELECT data_k.id_k,data_k.nama_k,data_k.alamat_k,data_k.email_k,data_k.noHp_k,data_k.jabatan_k,data_k.foto_k FROM data_l INNER JOIN data_k ON data_l.id_k = data_k.id_k WHERE data_l.hak_akses != 1 AND data_k.id_k != ".$this->session->userdata('logged_in')['id_k']);
        }
        
		$this->load->view('html/header');
		$this->load->view('html/menu');
		$this->load->view('user',$data);
		$this->load->view('html/footer');
	}
	public function create_user()
	{
		if ($this->input->post() != null) {
			$this->form_validation->set_rules('c_nama','Nama','trim|required|is_unique[data_k.nama_k]');
			$this->form_validation->set_rules('c_alamat','Alamat','trim|required|min_length[3]');
			$this->form_validation->set_rules('c_email','Email','trim|required|valid_email|is_unique[data_k.email_k]');
			$this->form_validation->set_rules('c_nohp','No HP','trim|required|min_length[12]');
			$this->form_validation->set_rules('c_jabatan','Jabatan','trim|required');
			$this->form_validation->set_rules('c_username','Username','trim|required|is_unique[data_l.username_k]');
			$this->form_validation->set_rules('c_password','Password','trim|required');
			if($this->form_validation->run()==TRUE){
			    $data['nama_k'] = $this->input->post('c_nama');
				$data['alamat_k'] = $this->input->post('c_alamat');
			    $data['email_k'] = $this->input->post('c_email');
			    $data['noHp_k'] = $this->input->post('c_nohp');
			    $data['jabatan_k'] = $this->input->post('c_jabatan');

			    $data['date_added'] = date('Y-m-d');
			    $data['bisa_cuti'] = 0;
			    
			    $datal['username_k'] = $this->input->post('c_username');
			    $datal['password_k'] = md5($this->input->post('c_password'));
				$datal['hak_akses'] = 3;
				
				$config['upload_path']          = FCPATH."assets/img/";
	            $config['allowed_types']        = 'gif|jpg|png|jpeg';

	            $this->load->library('upload',$config);

	            if($this->upload->do_upload('c_foto')){
	                $datax = $this->upload->data();
	                $data['foto_k'] = "assets/img/".$datax['file_name'];
	                $alert_foto = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Upload foto profil berhasil!</strong></div>";
					$this->session->set_flashdata('alert_foto', $alert_foto);
	            }
	            else{
	            	$alert_foto = "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Upload foto profil gagal!</strong></div>";
					$this->session->set_flashdata('alert_foto', $alert_foto);
					die();
	            }

		        $result = $this->Absen_M->createId('data_k',$data);
				if($result){
					$datal['id_k'] = $result;
					$resultl = $this->Absen_M->create('data_l',$datal);
					if ($resultl) {

						$cuti['id_k'] = $result;
						$cuti['cuti_berapakali'] = 0;
						$cuti['jatah_cuti'] = 0;
						$cuti['last_sync'] = 0;

						$resultc = $this->Absen_M->create('data_c',$cuti);
						if ($resultc) {
							$alert_create_user = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Create User Berhasil!</strong></div>";
							$this->session->set_flashdata('alert_create_user', $alert_create_user);
							redirect(base_url('User_C'));
						}
						else{
							$alert_create_user = "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Create User Gagal!(database cuti)</strong></div>";
		            		$this->session->set_flashdata('alert_create_user', $alert_create_user);
							$this->index();
						}
					}
					else{
						$alert_create_user = "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Create User Gagal!(database login)</strong></div>";
	            		$this->session->set_flashdata('alert_create_user', $alert_create_user);
						$this->index();
					}
				}
				else{
					$alert_create_user = "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Create User Gagal!(database karyawan)</strong></div>";
					$this->session->set_flashdata('alert_create_user', $alert_create_user);
					$this->index();
				}
			}
			else
			{
	            $alert_create_user = validation_errors("<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>",
	            	'</div>');
	            $this->session->set_flashdata('alert_create_user', $alert_create_user);
	            $this->index();
			}
		}
	}
	public function delete_user($data)
	{
		$dataCondition['id_k'] = $data;
		$file = $this->Absen_M->read('data_k',$dataCondition)->result();

		$lokasi = $file[0]->foto_k;
		$delete = realpath(APPPATH.'../'.$lokasi);
		//print_r($delete);

		if ($delete){
			unlink($delete);
		  $alert_unlink = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Delete profil Berhasil!</strong></div>";
			$this->session->set_flashdata('alert_unlink', $alert_unlink);
		}
		else{
		  $alert_unlink = "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Delete profil gagal!</strong></div>";
			$this->session->set_flashdata('alert_unlink', $alert_unlink);
		}
		$result = $this->Absen_M->delete('data_k',$dataCondition);
		if ($result) {
			$alert_delete_user = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Delete User Berhasil!</strong></div>";
			$this->session->set_flashdata('alert_delete_user', $alert_delete_user);
		}
		else{
			$alert_delete_user = "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Delete User gagal!</strong></div>";
			$this->session->set_flashdata('alert_delete_user', $alert_delete_user);
		}
		redirect('User_C/');
	}
	public function update_user($data)
	{
		if (isset($this->session->userdata['logged_in'])) {
			$dataCondition['id_k'] = $data;
			$datax['user'] = $this->Absen_M->read('data_k',$dataCondition);//user
			$datax['login'] = $this->Absen_M->read('data_l',$dataCondition);//login
		    $datax['jabatans'] = $this->Absen_M->readS('data_j');//jabatan
			$this->load->view('html/header');
			$this->load->view('html/menu');
			$this->load->view('update_user',$datax);
			$this->load->view('html/footer');
		}else{
			redirect();
		}
	}
	public function update_info()
	{
		if ($this->input->post() != null) {
			$this->form_validation->set_rules('u_id','Id','trim|required');
			$this->form_validation->set_rules('u_nama','Nama','trim|required');
			$this->form_validation->set_rules('u_alamat','Alamat','trim|required|min_length[3]');
			$this->form_validation->set_rules('u_email','Email','trim|required|valid_email');
			$this->form_validation->set_rules('u_nohp','No HP','trim|required|min_length[12]');
			$this->form_validation->set_rules('u_jabatan','Jabatan','trim|required');
			
			if($this->form_validation->run()==TRUE){
				$dataCondition['id_k'] = $this->input->post('u_id');
			    //$data['id_k'] = $this->input->post('u_id');
			    $data['nama_k'] = $this->input->post('u_nama');
				$data['alamat_k'] = $this->input->post('u_alamat');
			    $data['email_k'] = $this->input->post('u_email');
			    $data['noHp_k'] = $this->input->post('u_nohp');
			    $data['jabatan_k'] = $this->input->post('u_jabatan');

			    $data_banding['bisa_cuti_db'] = (int)$this->input->post('u_bisa_cuti_db');
			    $data_banding['bisa_cuti_form'] = (int)$this->input->post('u_bisa_cuti_form');

			    if ($data_banding['bisa_cuti_form'] > $data_banding['bisa_cuti_db']) { // apakah terjadi update bisa cuti-> apakah edit bisa_cuti dari 0 menjadi 1
			    	$data['bisa_cuti'] = $data_banding['bisa_cuti_form'];
			    	$dataUpdate['jatah_cuti'] = 1;
			    	$dataUpdate['last_sync'] = date("Y-m-d");
			    	$update_data_c = $this->Absen_M->update('data_c',$dataCondition,$dataUpdate);
			    	$results = json_decode($update_data_c, true);
					if ($results['status']) {
						$alert_update_cuti = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Update cuti Berhasil!</strong></div>";
						$this->session->set_flashdata('alert_update_cuti', $alert_update_cuti);
					}else{
						$alert_update_cuti = "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Update cuti gagal!</strong></div>";
						$this->session->set_flashdata('alert_update_cuti', $alert_update_cuti);
					} 
			    }
			    else{
			    	$alert_update_cuti = "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>F = ".$data_banding['bisa_cuti_form']."|| DB = ".$data_banding['bisa_cuti_db']."</strong></div>";
					$this->session->set_flashdata('alert_update_cuti', $alert_update_cuti);
			    }
				
				$config['upload_path']          = FCPATH."assets/img/";
	            $config['allowed_types']        = 'gif|jpg|png|jpeg';
	            $this->load->library('upload', $config);
	            if(null !== 'u_foto'){
			    	$unlink_foto_k= $this->input->post('unlink_foto_k');
		            if($this->upload->do_upload('u_foto')){
			    		unlink(FCPATH."/".$unlink_foto_k);
		                $datax = $this->upload->data();
		                $data['foto_k'] = "assets/img/".$datax['file_name'];
		            }
	            }
		        $result = $this->Absen_M->update('data_k',$dataCondition, $data);
				$results = json_decode($result, true);
				/*false  object*/
				/*true  array*/
				if ($results['status']) {
					$alert_update_info = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Update info Berhasil!</strong></div>";
					$this->session->set_flashdata('alert_update_info', $alert_update_info);
				}else{
					if ($results['error_message']['code'] == 1062) {
						$alert_update_info = "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Update info gagal! Email telah terdaftar</strong></div>";
						$this->session->set_flashdata('alert_update_info', $alert_update_info);
					}else{
						$alert_update_info = "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Update info gagal!</strong></div>";
						$this->session->set_flashdata('alert_update_info', $alert_update_info);
					}
				} 
			}
			else
			{
	            $alert_update_info = validation_errors("<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>",'</div>');
	            $this->session->set_flashdata('alert_update_info', $alert_update_info);
				//redirect('User_C/update_user/'.$data['id_k']);
			}
			// echo"<pre>";
			// var_dump($data);
			// var_dump($data_banding);
			// echo"<pre>";
			redirect('User_C/update_user/'.$dataCondition['id_k']);
			
		}
		
	}
	public function update_login()
	{
	    if ($this->input->post() != null) {
		    $dataCondition['id_l'] =  $this->input->post('u_id_L');
		    $data['password_real'] = $this->input->post('u_password_real');
		    $data['id_k'] = $this->input->post('u_id');
		    $datal['hak_akses'] = $this->input->post('u_hak_akses');
		    $datal['username_k'] = $this->input->post('u_username');
		    $datal['password_k'] = $this->input->post('u_password');
		    if ($datal['password_k'] == null) {
		    	unset($datal['password_k']);
		    	$result = $this->Absen_M->update('data_l',$dataCondition,$datal);
		    	$results = json_decode($result, true);
				if ($results['status']) {
					echo "bagus";
					$alert_update_login = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Update login Berhasil!</strong></div>";
					$this->session->set_flashdata('alert_update_login', $alert_update_login);
				}else{
					$alert_update_login = "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Update login gagal!</strong></div>";
					$this->session->set_flashdata('alert_update_login', $alert_update_login);
				}
		    } else {
		    	$datal['password_k'] = md5($datal['password_k']);
			    $data['password_baru_verifikasi'] = md5($this->input->post('u_password_baru_verifikasi'));
			    $data['password_lama'] = md5($this->input->post('u_password_lama'));
			    if ($datal['password_k'] == $data['password_baru_verifikasi']) {
			    	if ($data['password_lama'] == $data['password_real']) {
			    		$result = $this->Absen_M->update('data_l',$dataCondition,$datal);
				    	$results = json_decode($result, true);
						if ($results['status']) {
							$alert_update_login = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Update login Berhasil!</strong></div>";
							$this->session->set_flashdata('alert_update_login', $alert_update_login);
						}else{
							$alert_update_login = "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Update login gagal!</strong></div>";
							$this->session->set_flashdata('alert_update_login', $alert_update_login);
						}
			    	} else {
			    		$alert_update_login = "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>password lama salah!</strong></div>";
						$this->session->set_flashdata('alert_update_login', $alert_update_login);
			    	}
			    } else {
			    	$alert_update_login = "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>password baru tidak sama!</strong></div>";
					$this->session->set_flashdata('alert_update_login', $alert_update_login);
			    }
		    }	    
			$dataSession = $this->session->userdata('logged_in');			
			if ($data['id_k'] == $this->session->userdata('logged_in')['id_k'] ) {
				redirect('Home_C/logout');
			}
	    }
		redirect('User_C/update_user/'.$data['id_k']);
	}
/*	public function detail_per_user($siapa){
		if (isset($this->session->userdata['logged_in'])) {
			$data['siapa']=$siapa;
			$data['absen'] = $this->Absen_M->rawQuery("SELECT data_ra.id_A,data_ra.id_k,data_s.keterangan_s,data_ra.detail,data_ra.tanggal,data_ra.jam,data_ra.acc FROM data_ra INNER JOIN data_s ON data_ra.id_s = data_s.id_s INNER JOIN data_k ON data_ra.id_k = data_k.id_k WHERE data_ra.id_k =".$siapa." AND data_ra.tanggal LIKE '".$this->date."%'")->result();
			//var_dump($data['absen']);


		    $data['ijin'] = $this->Absen_M->rawQuery("SELECT data_i.id_i,data_i.id_k,data_i.perihal,data_i.start,data_i.end,data_i.tanggal FROM data_k INNER JOIN data_i ON data_i.id_k = data_k.id_k WHERE data_k.id_k =".$siapa." AND data_i.tanggal LIKE '".$this->date."%'")->result();
		    //var_dump($data['ijin']);

		    $datar['id_k'] =$siapa;
		    $data['cuti'] = $this->Absen_M->read('data_c',$datar)->result();
		    $this->load->view('html/header');
		    $this->load->view('html/menu');
		    $this->load->view('detail_per_user',$data);
		    $this->load->view('html/footer');
		}else{
			redirect();
		}
    }*/
    public function detail_per_user_per_bulan($siapa,$bulan,$tahun)
    {
			$data['siapa'] = $siapa;
			$dataCondition['id_k'] =$siapa;
			$data['nama_k'] = $this->Absen_M->read('data_k',$dataCondition)->result();
			unset($dataCondition);
			$data['absen'] = $this->Absen_M->rawQuery("SELECT data_k.nama_k,data_ra.id_A,data_ra.id_k,data_s.keterangan_s,data_ra.detail,data_ra.tanggal,data_ra.jam,data_ra.acc,data_ra.denda FROM data_ra INNER JOIN data_s ON data_ra.id_s = data_s.id_s INNER JOIN data_k ON data_ra.id_k = data_k.id_k WHERE data_ra.id_k =".$siapa." AND MONTH (data_ra.tanggal) = '".$bulan."' AND YEAR (data_ra.tanggal) ='".$tahun."' ")->result();
			/*echo "<pre> ABSEN: ";
			print_r($data['absen']);
			echo "</pre>";*/


		    $data['ijin'] = $this->Absen_M->rawQuery("SELECT data_i.id_i,data_i.id_k,data_i.perihal,data_i.start,data_i.end,data_i.tanggal,data_i.denda FROM data_k INNER JOIN data_i ON data_i.id_k = data_k.id_k WHERE data_k.id_k ='".$siapa."' AND MONTH (data_i.tanggal) = '".$bulan."' AND YEAR (data_i.tanggal) ='".$tahun."' ")->result();

		    $data['denda_absen'] = $this->Absen_M->rawQuery("SELECT data_ra.denda FROM data_ra WHERE data_ra.id_k = ".$siapa." AND MONTH (data_ra.tanggal) = '".$bulan."' AND YEAR (data_ra.tanggal) ='".$tahun."' ")->result();

		    $data['denda_ijin'] = $this->Absen_M->rawQuery("SELECT data_i.denda FROM data_i WHERE data_i.id_k = ".$siapa." AND MONTH (data_i.tanggal) = '".$bulan."' AND YEAR (data_i.tanggal) ='".$tahun."' ")->result();
			/*echo "<pre>IJIN: ";
		    print_r($data['ijin']);
			echo "</pre>";*/

		    $datar['id_k'] =$siapa;

		    $data['hadir'] = $this->Absen_M->rawQuery("SELECT * FROM data_ra WHERE id_k=".$datar['id_k']." AND id_s = 1 AND MONTH (data_ra.tanggal) = '".$bulan."' AND YEAR (data_ra.tanggal) ='".$tahun."' ")->result();
		    // print_r($data['hadir']);
		    $data_chart=[];
		    if($data['hadir'] != array()){
			    foreach($data['hadir'] as $absen) {
			    	$date = strtotime($absen->tanggal);
			    	$data_chart[] = array(date('Y-m-d',$date), (float)date("H.i", strtotime($absen->jam)) );
			    }

			   //  $data['data_chart'] = json_encode($data_chart);
		    // }
		    // else{
		    }
		    $data['data_chart'] = json_encode($data_chart);
		    // }

		    $data['cuti'] = $this->Absen_M->read('data_c',$datar)->result();
		    $data['bulan'] = $bulan;
		    $data['tahun'] = $tahun;
		    $this->load->view('html/header');
		    $this->load->view('html/menu');
		    $this->load->view('detail_per_user',$data);
		    $this->load->view('html/footer');
		    // print_r($data_chart);
		
    }
    public function edit_absensi_ku($data,$datab){
    		$datar['id_a'] = $data;
	        $datax['absen'] = $this->Absen_M->read('data_ra',$datar);
	        unset($datar);

	        $datar['id_k'] = $datab;
	        $datax['who'] = $this->Absen_M->read('data_k',$datar)->result();
	        unset($datar);
	        
	        $datax['status'] = $this->Absen_M->readS('data_s');
	        $this->load->view('html/header');
	        $this->load->view('html/menu');
	        $this->load->view('edit_absensi',$datax);
	        $this->load->view('html/footer');
    }
    public function delete_absensi_ku($data,$datab){
    	$dataCondition['id_A'] = $data;
    	$dataCondition['id_k'] = $datab;
        $result = $this->Absen_M->delete('data_ra',$dataCondition);
        if($result){
            $alert_delete_absensi_ku = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Delete Absensi Berhasil! </strong> </div>";
            $this->session->set_flashdata('alert_delete_absensi_ku', $alert_delete_absensi_ku);
        }
        else{
            $alert_delete_absensi_ku = "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Delete Absensi Gagal! </strong></div>";
            $this->session->set_flashdata('alert_delete_absensi_ku', $alert_delete_absensi_ku);
        }
        unset($dataCondition,$result,$data);
        $bulan = date('m');$tahun = date('Y');
        redirect('User_C/detail_per_user_per_bulan/'.$datab.'/'.$bulan.'/'.$tahun);
    }
    public function update_absensi_ku(){
    	if ($this->input->post() != null) {
    		$dataCondition['id_a'] = $this->input->post('u_id_a');
	        $dataCondition['id_k'] = $this->input->post('u_id_k');
	        $data['id_s'] = $this->input->post('u_keterangan');
	        
	        $data['tanggal'] = $this->input->post('u_tanggal');
	        $data['jam'] = $this->input->post('u_jam');
	        $data['acc'] = $this->input->post('u_acc');
	        
	        $where_idm['id_m'] =  1;
			$datax['jam_masuk'] = $this->Absen_M->read('data_m',$where_idm)->result();
			$jam_masuk = $datax['jam_masuk'][0]->misc;
			$where_idm['id_m'] =  4;
			$datax['jam_pulang'] = $this->Absen_M->read('data_m',$where_idm)->result();
			$jam_pulang = $datax['jam_pulang'][0]->misc;
			unset($where_idm);

	        if ($data['id_s'] == 1) {
	            if ($data['jam'] > $jam_masuk) {
	            	$time1 = strtotime($data['jam']);
					$time2 = strtotime($jam_masuk);
					// $time1 = strtotime('08:05:00');
					// $time2 = strtotime('07:00:00');

					$seperempat = round(1/4 ,2);
					$difference = round(abs($time1 - $time2) / 3600,2)  /*% $seperempat*/;
					// echo $data['jam']."<br>";
					// echo $jam_masuk."<br>";
					// echo $time1."<br>";
					// echo $time2."<br>";
					// echo "DIFF :".$difference."<br>";
					$difference = floor($difference / $seperempat);
					
					$where_idm['id_m'] =  7;
					$datax['denda_terlambat'] = $this->Absen_M->read('data_m',$where_idm)->result();
					$denda_terlambat = $datax['denda_terlambat'][0]->misc;
					unset($where_idm,$datax);

					$data['denda'] = $difference * $denda_terlambat;
	                $data['detail'] = "telat";
	            }
	            else{
	                $data['detail'] = "tepat waktu";
	                $data['denda'] = 0;   
	            }
	        }
	        elseif ($data['id_s'] == 5) {
				$time1 = strtotime($jam_masuk);
				$time2 = strtotime($jam_pulang);

				$seperempat = round(1/4 ,2);
				$difference = round(abs($time2 - $time1) / 3600,2)-1  /*% $seperempat*/;
				// echo "DIFFERENCE:".$difference;
				// die(); 
				// echo $data['jam']."<br>";
				// echo $jam_masuk."<br>";
				// echo $time1."<br>";
				// echo $time2."<br>";
				// echo "DIFF :".$difference."<br>";
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
				$difference = $difference * $denda_ijin_1_hari;
				$data['denda'] = $difference;
				$data['detail'] = $this->input->post('c_detail');
			}
	        else{
	            $data['detail'] = $this->input->post('u_detil_keterangan');
				$data['denda'] = 0;
	        }
	        $datas['id_k'] = $dataCondition['id_k'];
			$datalike['tanggal'] = $data['tanggal'];
			// $cari = $this->Absen_M->searchResult('data_ra',$datas,$datalike)->result_array();//apakah sudah absen hari ini
			// var_dump($cari);
			// if ($cari === array()) 
			// {
		        $result = $this->Absen_M->update('data_ra',$dataCondition,$data);
		        $results = json_decode($result, true);
		        if ($results['status']) {
						$alert_update_absensi_ku = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Update Absensi Berhasil! </strong> </div>";
		            $this->session->set_flashdata('alert_update_absensi_ku', $alert_update_absensi_ku);
					}
				else{
					if ($results['error_message']['code'] == 1062) {
						$alert_update_absensi_ku = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Update Absensi Berhasil! </strong> </div>";
		            $this->session->set_flashdata('alert_update_absensi_ku', $alert_update_absensi_ku);
					}else{
						$alert_update_absensi_ku = "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Update Absensi eror! </strong> </div>";
		            	$this->session->set_flashdata('alert_update_absensi_ku', $alert_update_absensi_ku);
					}
				}
			/*}
			else{
				$alert_update_absensi_ku = "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Update Absensi gagal! </strong>ada absen hari itu </div>";
		        $this->session->set_flashdata('alert_update_absensi_ku', $alert_update_absensi_ku);
			}*/
			$bulan = date('m');$tahun = date('Y');	
    	}
        
        redirect('User_C/detail_per_user_per_bulan/'.$dataCondition['id_k'].'/'.$bulan.'/'.$tahun);
    }
    public function delete_ijin_ku($data,$datab){
    	$dataCondition['id_i'] = $data;
    	$dataCondition['id_k'] = $datab;
        $result = $this->Absen_M->delete('data_i',$dataCondition);
        if($result){
            $alert_delete_ijin_ku = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Delete Ijin Berhasil! </strong> </div>";
            $this->session->set_flashdata('alert_delete_ijin_ku', $alert_delete_ijin_ku);
        }
        else{
            $alert_delete_ijin_ku = "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Delete Ijin Gagal! </strong></div>";
            $this->session->set_flashdata('alert_delete_ijin_ku', $alert_delete_ijin_ku);
        }
        unset($dataCondition,$result,$data);
        $bulan = date('m');$tahun = date('Y');
        redirect('User_C/detail_per_user_per_bulan/'.$datab.'/'.$bulan.'/'.$tahun);
    }
    public function edit_ijin_ku($data,$datab){
    	if (isset($this->session->userdata['logged_in'])) {
    		
    		$datar['id_i'] = $data;
    		$datar['id_k'] = $datab;
	    	
	    	$datax['ijin_ku'] = $this->Absen_M->read('data_i',$datar);
	    	
	    	/*var_dump($datax);
	    	echo "<br>";
	    	echo "<br>";
	    	var_dump($datar);*/
	    	unset($datar);

	        $this->load->view('html/header');
	        $this->load->view('html/menu');
	        $this->load->view('edit_ijin',$datax);
	        $this->load->view('html/footer');
		}else{
			redirect();
		}
    }
    public function update_ijin_ku(){
    	if ($this->input->post() != null) {
    		$dataCondition['id_i'] = $this->input->post('u_id_i');
	    	$data['id_k'] = $this->input->post('u_id_k');
		    $data['perihal'] = $this->input->post('u_perihal');
			$data['start'] = $this->input->post('u_start');
		    $data['end'] = $this->input->post('u_end');
		    $data['tanggal'] = $this->input->post('u_tanggal');

		    $time1 = strtotime($data['start']);
			$time2 = strtotime($data['end']);
			$difference = round(abs($time2 - $time1) / 3600,2);

			$where_idm['id_m'] =  6;
			$datax['denda_ijin'] = $this->Absen_M->read('data_m',$where_idm)->result();
			$denda_ijin = $datax['denda_ijin'][0]->misc;
			unset($where_idm,$datax);

			$where_idm['id_m'] =  4;
			$datax['jam_pulang'] = $this->Absen_M->read('data_m',$where_idm)->result();
			$jam_pulang = $datax['jam_pulang'][0]->misc;
			unset($datax,$where_idm);

			$difference = round(ceil($difference), 0, PHP_ROUND_HALF_UP);
			$data['denda']= $difference * $denda_ijin;

			if ($data['end'] > $jam_pulang) {
				$data['end'] = $jam_pulang;
			}




		    $where_idm['id_m'] =  1;
			$datax['jam_masuk'] = $this->Absen_M->read('data_m',$where_idm)->result();
			$jam_masuk = $datax['jam_masuk'][0]->misc;
			unset($where_idm);


			if ($data['start'] < $jam_masuk ) {
				$this->session->set_flashdata("alert_update_ijin_ku", "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Ijin gagal! perbaiki jam ijin start</strong> Inputan jam diluar jam kerja</div>");
			}
			// elseif ($data['end'] > $jam_akhir) {
			// 	$this->session->set_flashdata("alert_update_ijin_ku", "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Ijin gagal! perbaiki jam ijin end</strong> Inputan jam diluar jam kerja</div>");
			// }
			else{
				// if ($data['start'] > $data['end']) {
				// 	$this->session->set_flashdata("alert_update_ijin_ku", "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Ijin gagal!</strong> Inputan jam kurang benar</div>");
				// }else{
				    $result = $this->Absen_M->update('data_i',$dataCondition,$data);
					$results = json_decode($result, true);
					/*false  object*/
					/*true  array*/
					if ($results['status']) {
						$alert_update_ijin_ku = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Update Ijin Berhasil!</strong></div>";
						$this->session->set_flashdata('alert_update_ijin_ku', $alert_update_ijin_ku);
					}else{
						if ($results['error_message']['code'] == 1062) {
							$alert_update_ijin_ku = "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Update Ijin gagal! Email telah terdaftar</strong></div>";
							$this->session->set_flashdata('alert_update_ijin_ku', $alert_update_ijin_ku);
						}else{
							$alert_update_ijin_ku = "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Update Ijin gagal!</strong></div>";
							$this->session->set_flashdata('alert_update_ijin_ku', $alert_update_ijin_ku);
						}
					}
				// }
			}
			$bulan = date('m');$tahun = date('Y');
    	}
        redirect('User_C/detail_per_user_per_bulan/'.$data 	['id_k'].'/'.$bulan.'/'.$tahun);
    }
    public function lihat5bulan($id_k,$bulan,$tahun)
    {
    	if (isset($this->session->userdata['logged_in'])) {
    		
	        $this->load->view('html/header');
	        $this->load->view('html/menu');

	    	//$bulan = 3;
	    	$a = $bulan;
	    	$query  = "SELECT";
	    	$kueri  = "SELECT";
	    	$queri  = "SELECT";
	    	$kuery  = "SELECT";

	    	for ($jump = 5; $jump >=0 ;$jump--) { 
	    		if ($a == 0) {
	    			$a = 12;
	    			$tahun = $tahun -1;
	    		}

	    		/*START BIKIN QUERY HITUNG TANGGAL MERAH di data_libur*/
				if ($jump == 0) {
					$query = $query." ( SELECT COUNT(data_libur.id_libur) FROM data_libur WHERE MONTH (data_libur.tanggal) = '".$a."' AND YEAR (data_libur.tanggal) = '".$tahun."') AS ke".$a;
				} else {
					$query = $query." ( SELECT COUNT(data_libur.id_libur) FROM data_libur WHERE MONTH (data_libur.tanggal) = '".$a."' AND YEAR (data_libur.tanggal) = '".$tahun."') AS ke".$a.",";
				}
				/*END BIKIN QUERY HITUNG TANGGAL MERAH di data_libur*/
				
				$number[$a] = cal_days_in_month(CAL_GREGORIAN,date($a), date($tahun));

				/*START HITUNG SABTU MINGGU*/
	    		$libur[$a] = 0;	
	    		for ($i = 1; $i <= $number[$a]; $i++) {

					$date = date("Y-m-{$i}");
					$dt = strtotime($date);
					$day = date("l",$dt);

					if ($day == 'Sunday' OR $day == 'Saturday') {
						$libur[$a]  = $libur[$a] + 1;
					}
				}
				/*END HITUNG SABTU MINGGU*/

				/*START HITUNG KEHADIRAN KU di data_ra*/
				if ($jump == 0) {
					$kueri = $kueri." (SELECT COUNT(data_ra.id_s) FROM data_ra WHERE data_ra.id_k = '".$id_k."' and data_ra.id_s = '1' and data_ra.acc ='1' and MONTH (data_ra.tanggal) = '".$a."' AND YEAR (data_ra.tanggal) = '".$tahun."') AS hadir_".$a;
				} else {
					$kueri = $kueri." (SELECT COUNT(data_ra.id_s) FROM data_ra WHERE data_ra.id_k = '".$id_k."' and data_ra.id_s = '1' and data_ra.acc ='1' and MONTH (data_ra.tanggal) = '".$a."' AND YEAR (data_ra.tanggal) = '".$tahun."') AS hadir_".$a.",";
				}
				/*END HITUNG KEHADIRAN KU di data_ra*/

				/*START HITUNG ONTIME KU di data_ra*/
				if ($jump == 0) {
					$queri = $queri." (SELECT COUNT(data_ra.id_s) FROM data_ra WHERE data_ra.id_k = '".$id_k."' and data_ra.id_s = '1' and data_ra.detail='tepat waktu' and data_ra.acc ='1'  and MONTH (data_ra.tanggal) = '".$a."' AND YEAR (data_ra.tanggal) = '".$tahun."') AS ontime_".$a;
				} else {
					$queri = $queri." (SELECT COUNT(data_ra.id_s) FROM data_ra WHERE data_ra.id_k = '".$id_k."' and data_ra.id_s = '1' and data_ra.detail='tepat waktu' and data_ra.acc ='1' and MONTH (data_ra.tanggal) = '".$a."' AND YEAR (data_ra.tanggal) = '".$tahun."') AS ontime_".$a.",";
				}
				/*END HITUNG ONTIME KU di data_ra*/

				/*START HITUNG TELAT KU di data_ra*/
				if ($jump == 0) {
					$kuery = $kuery." (SELECT COUNT(data_ra.id_s) FROM data_ra WHERE data_ra.id_k = '".$id_k."' and data_ra.id_s = '1' and data_ra.detail='telat' and data_ra.acc ='1'  and MONTH (data_ra.tanggal) = '".$a."' AND YEAR (data_ra.tanggal) = '".$tahun."') AS late_".$a;
				} else {
					$kuery = $kuery." (SELECT COUNT(data_ra.id_s) FROM data_ra WHERE data_ra.id_k = '".$id_k."' and data_ra.id_s = '1' and data_ra.detail='telat' and data_ra.acc ='1' and MONTH (data_ra.tanggal) = '".$a."' AND YEAR (data_ra.tanggal) = '".$tahun."') AS late_".$a.",";
				}
				/*END HITUNG TELAT KU di data_ra*/

	    		$a =$a -1;
	    	}
			$jml_libur = $this->Absen_M->rawQuery($query)->result();
			$jml_hadir = $this->Absen_M->rawQuery($kueri)->result();
			$jml_ontime = $this->Absen_M->rawQuery($queri)->result();
			$jml_late = $this->Absen_M->rawQuery($kuery)->result();

			foreach ($libur as $key => $value) {
				$nama = 'ke'.$key;
				if(isset($jml_libur[0]->$nama)) {
					$total[$key] = $jml_libur[0]->$nama + $value;
				}
			}

			/*START HITUNG PROSENTASE*/
			$a = $bulan-5;
			for ($jump = 5; $jump >=0 ;$jump--) {
				if ($a <= 0) {
					$a = 12 + ($a);
					$tahun = $tahun -1;
				}elseif( $a == 13){
					$a = 1;
					$tahun = $tahun -1;
				}
	    		// if ($a == 0) {
	    		// 	$a = 12;
	    		// 	$tahun = $tahun -1;
	    		// }
	    		$hari_kerja[$a] = $number[$a] - $total[$a];
	    		$key = 'hadir_'.$a;
	    		$keyon = 'ontime_'.$a;
	    		$keyla = 'late_'.$a;
	    		// $persen[] = array(date('M Y', strtotime($tahun.'-'.$a)) , ($jml_hadir[0]->$key / $hari_kerja[$a]) * 100);
	    		if ($jml_hadir[0]->$key != 0) {
	    			$persenon[] = array(date('M Y', strtotime($tahun.'-'.$a)) , ($jml_ontime[0]->$keyon / $hari_kerja[$a]) * 100);
	    			$persenla[] = array(date('M Y', strtotime($tahun.'-'.$a)) , ($jml_late[0]->$keyla / $hari_kerja[$a]) * 100);
	    		}
	    		else{
	    			$persenon[] = array(date('M Y', strtotime($tahun.'-'.$a)) , 0);
	    			$persenla[] = array(date('M Y', strtotime($tahun.'-'.$a)) , 0);
	    		}

	    		$kehadiran[date('M Y', strtotime($tahun.'-'.$a))] = array((int)$jml_hadir[0]->$key);
	    		$workday[date('M Y', strtotime($tahun.'-'.$a))] = array((int)$hari_kerja[$a]);
	    		$ontime[date('M Y', strtotime($tahun.'-'.$a))] = array((int)$jml_ontime[0]->$keyon);
	    		$late[date('M Y', strtotime($tahun.'-'.$a))] = array((int)$jml_late[0]->$keyla);
	    		// echo "<pre>";
	    		// // print_r($kehadiran);
	    		// // print_r($workday);
	    		// // print_r($persen);
	    		// // print_r($persenon);
	    		// echo "Bulan: ".$a;
	    		// echo ", HADIR: ".$jml_hadir[0]->$key;
	    		// echo ", ontime: ".$jml_ontime[0]->$keyon;
	    		// echo ", late: ".$jml_late[0]->$keyla;
	    		// echo ", HARI KERJA: ".$hari_kerja[$a];
	    		// echo ", PERSEN HADIR: ".($jml_hadir[0]->$key / $hari_kerja[$a]) * 100 ." %";
	    		// echo ", PERSEN ONTIME: ".($jml_ontime[0]->$keyon / $jml_hadir[0]->$key) * 100 ." %";
	    		// echo ", PERSEN LATE: ".($jml_late[0]->$keyla / $jml_hadir[0]->$key) * 100 ." %";
	    		// echo "</pre>";
	    		$a = $a + 1;
	    		// $a =$a -1;
	    	}
			/*END HITUNG PROSENTASE*/

			// echo "<pre>";
			// var_dump($total);
			// echo "</pre>";
			// echo "<pre>";
			// var_dump($number);
			// echo "</pre>";
			// echo "<pre>";
			// var_dump($jml_hadir);
			// echo "</pre>";
			// echo "<pre>";
			// var_dump($hari_kerja);
			// echo "</pre>";
			// print_r($persen);
			$data['kehadiran'] = json_encode($kehadiran);
			$data['workday'] = json_encode($workday);
			$data['ontime'] = json_encode($ontime);
			$data['late'] = json_encode($late);
			
			// $data['persen'] = json_encode($persen);
			$data['persenon'] = json_encode($persenon);
			$data['persenla'] = json_encode($persenla);
			$data['id_k'] =$id_k;

			$dataCondition['id_k'] =$id_k;
			$data['nama_k'] = $this->Absen_M->read('data_k',$dataCondition)->result();
			unset($dataCondition);

			$data['bulan'] =$bulan;
			$data['tahun'] =$tahun;
			//$data['persen'] =$persen;
			$this->load->view('lihat5bulan',$data);
	        $this->load->view('html/footer');
		}else{
			redirect();
		}
	}
}
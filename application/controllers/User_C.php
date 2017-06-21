<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_C extends CI_Controller {
	private $date;
	public function __construct(){
        parent::__construct();
        $this->load->model('Absen_M');
		$this->date = date('Y-m');
    }
    public function index()
    {
		if (isset($this->session->userdata['logged_in'])) {
			if ($this->session->userdata('logged_in')['hak_akses'] != 3){
		        //$data['users'] = $this->Absen_M->readS('data_k')->result();
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
			else{
				redirect();
			}
		}else{
			redirect();
		}
	}
	public function create_user()
	{
		$this->form_validation->set_rules('c_nama','Nama','trim|required|is_unique[data_k.nama_k]');
		$this->form_validation->set_rules('c_alamat','Alamat','trim|required|min_length[3]');
		$this->form_validation->set_rules('c_email','Email','trim|required|valid_email|is_unique[data_k.email_k]');
		$this->form_validation->set_rules('c_nohp','No HP','trim|required|min_length[12]');
		$this->form_validation->set_rules('c_jabatan','Jabatan','trim|required');
		$this->form_validation->set_rules('c_username','Username','trim|required');
		$this->form_validation->set_rules('c_password','Password','trim|required');
	    
		
		if($this->form_validation->run()==TRUE){
		    $data['nama_k'] = $this->input->post('c_nama');
			$data['alamat_k'] = $this->input->post('c_alamat');
		    $data['email_k'] = $this->input->post('c_email');
		    $data['noHp_k'] = $this->input->post('c_nohp');
		    $data['jabatan_k'] = $this->input->post('c_jabatan');
		    
		    $datal['username_k'] = $this->input->post('c_username');
		    $datal['password_k'] = md5($this->input->post('c_password'));
			$datal['hak_akses']= 3;
			$config['upload_path']          = FCPATH."assets/img/";
            $config['allowed_types']        = 'gif|jpg|png|jpeg';

            $this->load->library('upload',$config);

            if($this->upload->do_upload('c_foto')){

                $datax = $this->upload->data();
                $data['foto_k'] = "assets/img/".$datax['file_name'];
                $alert_foto = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Upload foto profil berhasil!</strong> Username : $datal[username_k]</div>";
				$this->session->set_flashdata('alert_foto', $alert_foto);
            }
            else{
            	/*echo $this->upload->display_errors('<p>', '</p>');*/
            	$alert_foto = "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Upload foto profil gagal!</strong>ekstensi tidak didukung, coba gambar lain</div>";
				$this->session->set_flashdata('alert_foto', $alert_foto);
            }

	        $result = $this->Absen_M->createId('data_k',$data);
			if($result){
				$datal['id_k'] = $result;
				$resultl = $this->Absen_M->create('data_l',$datal);
				if ($resultl) {
					$cuti['id_k'] = $result;
					$cuti['cuti_berapakali'] = 0;
					$resultc = $this->Absen_M->create('data_c',$cuti);
					if ($resultc) {
						$alert_create_user = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Create User Berhasil!</strong> Username : $datal[username_k]</div>";
						$this->session->set_flashdata('alert_create_user', $alert_create_user);
						//redirect(base_url('User_C'));
					}
					else{
						$alert_create_user = "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Create User Gagal!(database cuti)</strong></div>";
	            		$this->session->set_flashdata('alert_create_user', $alert_create_user);
						//redirect(base_url('User_C'));
					}
				}
				else{
					$alert_create_user = "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Create User Gagal!(database login)</strong></div>";
            		$this->session->set_flashdata('alert_create_user', $alert_create_user);
					//redirect(base_url('User_C'));
				}
			}
			else{
				$alert_create_user = "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><strong>Create User Gagal!(database karyawan)</strong></div>";
				$this->session->set_flashdata('alert_create_user', $alert_create_user);
				//redirect(base_url('User_C'));
			}
		}
		else
		{
            $alert_create_user = validation_errors("<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>",'</div>');
            $this->session->set_flashdata('alert_create_user', $alert_create_user);
		}
			redirect(base_url('User_C'));
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
		$this->form_validation->set_rules('u_id','Id','trim|required');
		$this->form_validation->set_rules('u_nama','Nama','trim|required');
		$this->form_validation->set_rules('u_alamat','Alamat','trim|required|min_length[3]');
		$this->form_validation->set_rules('u_email','Email','trim|required|valid_email');
		$this->form_validation->set_rules('u_nohp','No HP','trim|required|min_length[12]');
		$this->form_validation->set_rules('u_jabatan','Jabatan','trim|required');

		$dataCondition['id_k'] = $this->input->post('u_id');
		if($this->form_validation->run()==TRUE){

		    $data['id_k'] = $this->input->post('u_id');
		    $data['nama_k'] = $this->input->post('u_nama');
			$data['alamat_k'] = $this->input->post('u_alamat');
		    $data['email_k'] = $this->input->post('u_email');
		    $data['noHp_k'] = $this->input->post('u_nohp');
		    $data['jabatan_k'] = $this->input->post('u_jabatan');
		    
			$config['upload_path']          = FCPATH."assets/img/";
            $config['allowed_types']        = 'gif|jpg|png|jpeg';

            $this->load->library('upload', $config);

            if(null !== 'u_foto'){
	            if($this->upload->do_upload('u_foto')){
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
		redirect('User_C/update_user/'.$data['id_k']);
	}
	public function update_login()
	{
	    
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
		if (isset($this->session->userdata['logged_in'])) {
			$data['siapa'] = $siapa;
			$data['absen'] = $this->Absen_M->rawQuery("SELECT data_ra.id_A,data_ra.id_k,data_s.keterangan_s,data_ra.detail,data_ra.tanggal,data_ra.jam,data_ra.acc FROM data_ra INNER JOIN data_s ON data_ra.id_s = data_s.id_s INNER JOIN data_k ON data_ra.id_k = data_k.id_k WHERE data_ra.id_k =".$siapa." AND MONTH (data_ra.tanggal) = '".$bulan."' AND YEAR (data_ra.tanggal) ='".$tahun."' ")->result();
			/*echo "<pre> ABSEN: ";
			print_r($data['absen']);
			echo "</pre>";*/


		    $data['ijin'] = $this->Absen_M->rawQuery("SELECT data_i.id_i,data_i.id_k,data_i.perihal,data_i.start,data_i.end,data_i.tanggal FROM data_k INNER JOIN data_i ON data_i.id_k = data_k.id_k WHERE data_k.id_k ='".$siapa."' AND MONTH (data_i.tanggal) = '".$bulan."' AND YEAR (data_i.tanggal) ='".$tahun."' ")->result();
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

			    $data['data_chart'] = json_encode($data_chart);
		    }
		    else{
		    	$data['data_chart'] = json_encode($data_chart);
		    }

		    $data['cuti'] = $this->Absen_M->read('data_c',$datar)->result();
		    $data['bulan'] = $bulan;
		    $data['tahun'] = $tahun;
		    $this->load->view('html/header');
		    $this->load->view('html/menu');
		    $this->load->view('detail_per_user',$data);
		    $this->load->view('html/footer');
		    // print_r($data_chart);
		}else{
			redirect();
		}
    }
    public function edit_absensi_ku($data,$datab){
    	if (isset($this->session->userdata['logged_in'])) {
    		
    		$datar['id_a'] = $data;
	        $datax['absen'] = $this->Absen_M->read('data_ra',$datar);
	        unset($datar);

	        $datar['id_k'] = $datab;
	        $datax['who'] = $this->Absen_M->read('data_k',$datar)->result();
	        
	        
	        $datax['status'] = $this->Absen_M->readS('data_s');
	        $this->load->view('html/header');
	        $this->load->view('html/menu');
	        $this->load->view('edit_absensi',$datax);
	        $this->load->view('html/footer');
		}
		else{
			redirect();
		}
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
        $dataCondition['id_a'] = $this->input->post('u_id_a');
        $dataCondition['id_k'] = $this->input->post('u_id_k');
        $data['id_s'] = $this->input->post('u_keterangan');
        
        $data['tanggal'] = $this->input->post('u_tanggal');
        $data['jam'] = $this->input->post('u_jam');
        $data['acc'] = $this->input->post('u_acc');
        
        $where_idm['id_m'] =  1;
		$datax['jam_masuk'] = $this->Absen_M->read('data_m',$where_idm)->result();
		$jam_masuk = $datax['jam_masuk'][0]->misc;
		unset($where_idm);

        if ($data['id_s'] == 1) {
            if ($data['jam'] > $jam_masuk) {
                $data['detail'] = "telat";
            }
            else{
                $data['detail'] = "tepat waktu";    
            }
        }
        elseif ($data['id_s']==2) {
            $data['detail'] = "tepat waktu";
        }
        else{
            $data['detail'] = $this->input->post('u_detil_keterangan');
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
					$alert_update_absensi_ku = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Update Absensi Berhasil! </strong> </div>";
	            	$this->session->set_flashdata('alert_update_absensi_ku', $alert_update_absensi_ku);
				}
			}
		/*}
		else{
			$alert_update_absensi_ku = "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Update Absensi gagal! </strong>ada absen hari itu </div>";
	        $this->session->set_flashdata('alert_update_absensi_ku', $alert_update_absensi_ku);
		}*/
		$bulan = date('m');$tahun = date('Y');
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
    	$dataCondition['id_i'] = $this->input->post('u_id_i');
    	$data['id_k'] = $this->input->post('u_id_k');
	    $data['perihal'] = $this->input->post('u_perihal');
		$data['start'] = $this->input->post('u_start');
	    $data['end'] = $this->input->post('u_end');
	    $data['tanggal'] = $this->input->post('u_tanggal');


	    $where_idm['id_m'] =  1;
		$datax['jam_masuk'] = $this->Absen_M->read('data_m',$where_idm)->result();
		$jam_masuk = $datax['jam_masuk'][0]->misc;
		unset($where_idm);

		$where_idm['id_m'] =  1;
		$datax['jam_akhir'] = $this->Absen_M->read('data_m',$where_idm)->result();
		$jam_akhir = $datax['jam_akhir'][0]->misc;
		unset($where_idm);


		if ($data['start'] < $jam_masuk ) {
			$this->session->set_flashdata("alert_update_ijin_ku", "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Ijin gagal! perbaiki jam ijin start</strong> Inputan jam diluar jam kerja</div>");
		}
		elseif ($data['end'] > $jam_akhir) {
			$this->session->set_flashdata("alert_update_ijin_ku", "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Ijin gagal! perbaiki jam ijin end</strong> Inputan jam diluar jam kerja</div>");
		}
		else{
			if ($data['start'] > $data['end']) {
				$this->session->set_flashdata("alert_update_ijin_ku", "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Ijin gagal!</strong> Inputan jam kurang benar</div>");
			}else{
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
			}
		}
		$bulan = date('m');$tahun = date('Y');
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

	    	for ($jump = 5; $jump >=0 ;$jump--) { 
	    		if ($a == 0) {
	    			$a = 12;
	    			$tahun = $tahun -1;
	    		}

	    		/*START BIKIN QUERY HITUNG TANGGAL MERAH*/
				if ($jump == 0) {
					$query = $query." ( SELECT COUNT(data_libur.id_libur) FROM data_libur WHERE MONTH (data_libur.tanggal) = '".$a."' AND YEAR (data_libur.tanggal) = '".$tahun."') AS ke".$a;
				} else {
					$query = $query." ( SELECT COUNT(data_libur.id_libur) FROM data_libur WHERE MONTH (data_libur.tanggal) = '".$a."' AND YEAR (data_libur.tanggal) = '".$tahun."') AS ke".$a.",";
				}
				/*END BIKIN QUERY HITUNG TANGGAL MERAH*/
				
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

				/*START HITUNG KEHADIRAN KU*/
				if ($jump == 0) {
					$kueri = $kueri." (SELECT COUNT(data_ra.id_s) FROM data_ra WHERE data_ra.id_k = '".$id_k."' and data_ra.acc ='1' and MONTH (data_ra.tanggal) = '".$a."' AND YEAR (data_ra.tanggal) = '".$tahun."') AS hadir_".$a;
				} else {
					$kueri = $kueri." (SELECT COUNT(data_ra.id_s) FROM data_ra WHERE data_ra.id_k = '".$id_k."' and data_ra.acc ='1' and MONTH (data_ra.tanggal) = '".$a."' AND YEAR (data_ra.tanggal) = '".$tahun."') AS hadir_".$a.",";
				}
				/*END HITUNG KEHADIRAN KU*/

	    		$a =$a -1;
	    	}
			$jml_libur = $this->Absen_M->rawQuery($query)->result();
			$jml_hadir = $this->Absen_M->rawQuery($kueri)->result();

			foreach ($libur as $key => $value) {
				$nama = 'ke'.$key;
				if(isset($jml_libur[0]->$nama)) {
					$total[$key] = $jml_libur[0]->$nama + $value;
				}
			}

			/*START HITUNG PROSENTASE*/
			$a = $bulan;
			for ($jump = 5; $jump >=0 ;$jump--) { 
	    		if ($a == 0) {
	    			$a = 12;
	    			$tahun = $tahun -1;
	    		}
	    		$hari_kerja[$a] = $number[$a] - $total[$a];
	    		$seratus = 100;
	    		$key = 'hadir_'.$a;
	    		$persen[] = array( date('M Y', strtotime($tahun.'-'.$a)) , ($jml_hadir[0]->$key / $hari_kerja[$a]) * 100);
	    		$a =$a -1;
	    	}
	    		// echo "<pre>";
	    		// print_r($persen);
	    		// echo "KEY HADIR: ".$jml_hadir[0]->$key;
	    		// echo ", HARI  KERJA: ".$hari_kerja[$a];
	    		// echo ", HASIL: ".($jml_hadir[0]->$key / $hari_kerja[$a]) * 100;
	    		// echo "</pre>";
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
			$data['persen'] = json_encode($persen);
			$data['id_k'] =$id_k;
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
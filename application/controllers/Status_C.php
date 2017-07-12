<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Status_C extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('Absen_M');
        date_default_timezone_set("Asia/Jakarta");
        if (!$this->session->userdata('logged_in')){
            redirect();
        }
    }
    public function view($page = 'status'){
	        $data['statuss'] = $this->Absen_M->readS('data_s');
	        $data['pengaturans'] = $this->Absen_M->readS('data_m');
			$this->load->view('html/header');
			$this->load->view('html/menu');
			$this->load->view($page,$data);
			$this->load->view('html/footer');
	}
	public function create_status(){
		if ($this->input->post() != null) {
			$this->form_validation->set_rules('c_status','Nama status','trim|required|is_unique[data_s.keterangan_s]');
			$data['keterangan_s'] = $this->input->post('c_status');
			if($this->form_validation->run()==TRUE){
				$result = $this->Absen_M->create('data_s',$data);
				if($result){
					$alert_create_status = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Create Status Berhasil!</strong> status : $data[keterangan_s]</div>";
					$this->session->set_flashdata('alert_create_status', $alert_create_status);
					//$this->index();
				}
				else{
					$alert_create_status = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Create Status Gagal </strong></div>";
					$this->session->set_flashdata('alert_create_status', $alert_create_status);
					//$this->index();
				}
			}
			else{
				$alert_create_status = validation_errors("<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>",'</div>');
	            $this->session->set_flashdata('alert_create_status', $alert_create_status);
			}	
		}
		redirect('Status_C/view');
	}
	public function delete_status($data){
		$dataCondition['id_s'] = $data;
		$result = $this->Absen_M->delete('data_s',$dataCondition);
		if($result){
			$alert_delete_status = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Delete Status Berhasil!</strong></div>";
			$this->session->set_flashdata('alert_delete_status', $alert_delete_status);
			
		}
		else{
			$alert_delete_status = "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Delete Status Gagal!</strong></div>";
			$this->session->set_flashdata('alert_delete_status', $alert_delete_status);
			
		}
		redirect('Status_C/view');
	}
	public function update_status($data){	
		if (isset($this->session->userdata['logged_in'])) {
			$dataCondition['id_s']= $data;
	        $datax['status'] = $this->Absen_M->read('data_s',$dataCondition);
			$this->load->view('html/header');
			$this->load->view('html/menu');
			$this->load->view('update_status',$datax);
			$this->load->view('html/footer');
		}else{
			redirect();
		}
	}
	public function update_info(){
		if ($this->input->post() != null) {
			$this->form_validation->set_rules('u_keterangan_status','Nama status','trim|required|is_unique[data_s.keterangan_s]');
			$dataCondition['id_s'] = $this->input->post('u_id_s');
			$data['keterangan_s'] = $this->input->post('u_keterangan_status');
			if($this->form_validation->run()==TRUE){
				$result = $this->Absen_M->update('data_s',$dataCondition,$data);
				if($result){
					$alert_update_info = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Update Status Berhasil !</strong></div>";
					$this->session->set_flashdata('alert_update_info', $alert_update_info);
					//$this->index();
				}
				else{
					$alert_update_info = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Update Status Gagal! </strong></div>";
					$this->session->set_flashdata('alert_update_info', $alert_update_info);
					//$this->index();
				}
			}
			else{
				$alert_update_info = validation_errors("<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>",'</div>');
	            $this->session->set_flashdata('alert_update_info', $alert_update_info);
			}
		}
			
		redirect('Status_C/view');
	}

	
	public function create_misc(){
		if ($this->input->post() != null) {
			$this->form_validation->set_rules('c_misc','pengaturan','trim|required');
				$data['misc'] = $this->input->post('c_misc');
			if($this->form_validation->run()==TRUE){
				$result = $this->Absen_M->create('data_m',$data);
				if ($result) {
					$alert_create_pengaturan = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Create Pengaturan Berhasil!</strong> </div>";
					$this->session->set_flashdata('alert_create_pengaturan', $alert_create_pengaturan);
				}
				else{
					$alert_create_pengaturan = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Create Pengaturan Gagal </strong></div>";
					$this->session->set_flashdata('alert_create_pengaturan', $alert_create_pengaturan);
				}
			}
			else{
				$alert_create_pengaturan = validation_errors("<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>",'</div>');
	            $this->session->set_flashdata('alert_create_pengaturan', $alert_create_pengaturan);
			}
		}
		redirect('Status_C/view/pengaturan');
	}
	public function update_misc($data){
		$dataCondition['id_m'] =$data;
		$datax['misc'] = $this->Absen_M->read('data_m',$dataCondition);
		$this->load->view('html/header');
		$this->load->view('html/menu');
		$this->load->view('update_misc',$datax);
		$this->load->view('html/footer');
	}
	public function update_misc_info($data){
		if ($this->input->post() != null) {
			$this->form_validation->set_rules('u_misc','Nama Misc','trim|required');
			$dataCondition['id_m'] = $this->input->post('u_id_m');
			$data['misc'] = $this->input->post('u_misc');
			$data['detail'] = $this->input->post('u_detail');
			if($this->form_validation->run()==TRUE){
				$result = $this->Absen_M->update('data_m',$dataCondition,$data);
				if($result){
					$alert_update_pengaturan = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Update Misc Berhasil !</strong></div>";
					$this->session->set_flashdata('alert_update_pengaturan', $alert_update_pengaturan);
				}
				else{
					$alert_update_pengaturan = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Update Misc Gagal! </strong></div>";
					$this->session->set_flashdata('alert_update_pengaturan', $alert_update_pengaturan);
					//$this->index();
				}
			}
			else{
				$alert_update_pengaturan = validation_errors("<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>",'</div>');
	            $this->session->set_flashdata('alert_update_pengaturan', $alert_update_pengaturan);
			}	
		}
		redirect('Status_C/view/pengaturan');
	}
	public function delete_misc($data){
		$dataCondition['id_m'] = $data;
		$result = $this->Absen_M->delete('data_m',$dataCondition);
		if($result){
			$alert_delete_pengaturan = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Delete pengaturan Berhasil!</strong></div>";
			$this->session->set_flashdata('alert_delete_pengaturan', $alert_delete_pengaturan);
			
		}
		else{
			$alert_delete_pengaturan = "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Delete pengaturan Gagal!</strong></div>";
			$this->session->set_flashdata('alert_delete_pengaturan', $alert_delete_pengaturan);
		}
		redirect('Status_C/view/pengaturan');
	}
	




}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan_C extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('Absen_M');
        date_default_timezone_set("Asia/Jakarta");
        if (!$this->session->userdata('logged_in')){
            redirect();
        }
    }
    public function index()
    {
		    $data['jabatans'] = $this->Absen_M->rawQuery("SELECT * FROM data_j where id_j != 9")->result();
			$this->load->view('html/header');
			$this->load->view('html/menu');
			$this->load->view('jabatan',$data);
			$this->load->view('html/footer');
	}
	
	public function create_jabatan()
	{
		if ($this->input->post() != null) {
			$this->form_validation->set_rules('c_jabatan','Nama jabatan','trim|required|is_unique[data_j.jabatan]');

			if($this->form_validation->run()==TRUE){
				$data['jabatan'] = $this->input->post('c_jabatan');
				$result = $this->Absen_M->create('data_j',$data);
				if($result){
					$alert_create_jabatan = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Create Jabatan Berhasil!  </strong>jabatan :$data[jabatan]</div>";
					$this->session->set_flashdata('alert_create_jabatan', $alert_create_jabatan);
				}
				else{
					$alert_create_jabatan = "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Create Jabatan Gagal!  </strong>jabatan :$data[jabatan]</div>";
					$this->session->set_flashdata('alert_create_jabatan', $alert_create_jabatan);
				}
			}
			else{
	            $alert_create_jabatan = validation_errors("<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>",'</div>');
	            $this->session->set_flashdata('alert_create_jabatan', $alert_create_jabatan);
			}
		}
		redirect('Jabatan_C');
	}
	public function delete_jabatan($data)
	{
		$datad['id_j'] = $data;
		$result = $this->Absen_M->delete('data_j',$datad);
		if($result){
			$alert_delete_jabatan = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Delete Jabatan Berhasil!  </strong></div>";
			$this->session->set_flashdata('alert_delete_jabatan', $alert_delete_jabatan);
		}
		else{
			$alert_delete_jabatan = "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>  <strong>Delete Jabatan Gagal!  </strong>jabatan :".$data."</div>";
			$this->session->set_flashdata('alert_delete_jabatan', $alert_delete_jabatan);
		}
		var_dump($result);
		//redirect('Jabatan_C');
	}
	public function update_jabatan($data)
	{
		$dataCondition['id_j'] = $data;
	    $datax['jabatan'] = $this->Absen_M->read('data_j',$dataCondition)->result();
		$this->load->view('html/header');
		$this->load->view('html/menu');
		$this->load->view('update_jabatan',$datax);
		$this->load->view('html/footer');
	}
	public function update_info()
	{
		if ($this->input->post() != null) {
			$this->form_validation->set_rules('u_jabatan','Nama jabatan','trim|required|is_unique[data_j.jabatan]');
			if($this->form_validation->run()==TRUE){
				$dataCondition['id_j'] = $this->input->post('u_id_J');
				$data['jabatan'] = $this->input->post('u_jabatan');
				$result = $this->Absen_M->update('data_j',$dataCondition,$data);
				if($result){
					$alert_update_info = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Update Jabatan Berhasil!</strong></div>";
					$this->session->set_flashdata('alert_update_info', $alert_update_info);
				}
				else{
					$alert_update_info = "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Update Jabatan Gagal!</strong></div>";
					$this->session->set_flashdata('alert_update_info', $alert_update_info);
				}
				redirect('Jabatan_C');
			}
			else{
		        $alert_update_info = validation_errors("<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>",'</div>');
		        $this->session->set_flashdata('alert_update_info', $alert_update_info);
			}	
		}
		redirect('Jabatan_C');
	}
}
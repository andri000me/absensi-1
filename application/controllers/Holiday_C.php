<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Holiday_C extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Absen_M');
    }
    public function index()
    {
        if(isset($this->session->userdata['logged_in'])){
            $datar['liburan'] = $this->Absen_M->readS('data_libur')->result();
        	$this->load->view('html/header');
    		$this->load->view('html/menu');
    		$this->load->view('holiday',$datar);
    		$this->load->view('html/footer');
        }
        else{
            redirect();
        }
    }
    public function delete_liburan($data)
    {
        $dataCondition['id_libur'] = $data;
        $result = $this->Absen_M->delete('data_libur',$dataCondition);
        if($result){
            $notifikasi_libur = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Delete libur Berhasil! </strong> </div>";
            $this->session->set_flashdata('notifikasi_libur', $notifikasi_libur);
        }
        else{
            $notifikasi_libur = "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Delete libur Gagal! </strong></div>";
            $this->session->set_flashdata('notifikasi_libur', $notifikasi_libur);
        }
        unset($dataCondition,$result,$data);
        redirect('Holiday_C');
    }
    public function update_liburan($data)
    {
        if (isset($this->session->userdata['logged_in'])) {
            $dataCondition['id_libur'] = $data;
            $datax['liburan'] = $this->Absen_M->read('data_libur',$dataCondition)->result();
            $this->load->view('html/header');
            $this->load->view('html/menu');
            $this->load->view('update_libur',$datax);
            $this->load->view('html/footer');
        }else{
            redirect();
        }
    }
    public function update_info()
    {
        $dataCondition['id_libur'] = $this->input->post('u_id_libur');
        $data['detail'] = $this->input->post('u_detail');
        $result = $this->Absen_M->update('data_libur',$dataCondition,$data);
        $results = json_decode($result, true);

        if ($results['status']) {
            $this->session->set_flashdata("notifikasi_libur", "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Update berhasil</strong></div>");
        }
        else{
            $this->session->set_flashdata("notifikasi_libur", "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>update gagal(database)</strong> </div>");
        }
        unset($data);
        redirect('Holiday_C');
    }
}
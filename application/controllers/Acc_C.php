<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Acc_C extends CI_Controller {

    private $date;
    public function __construct(){
        parent::__construct();
        $this->load->model('Absen_M');
        date_default_timezone_set("Asia/Jakarta");
        $this->date = date('Y-m-d');
    }
    public function index()
    {
        if(isset($this->session->userdata['logged_in'])){
        	$datar['absen']= $this->Absen_M->rawQuery("SELECT data_ra.id_a, data_s.keterangan_s, data_ra.detail, data_ra.tanggal, data_ra.jam, data_ra.acc, data_k.nama_k FROM data_ra
                INNER JOIN data_k ON data_ra.id_k = data_k.id_k
                INNER JOIN data_s ON data_ra.id_s = data_s.id_s
                WHERE tanggal = '".$this->date."' ORDER BY data_ra.id_a DESC");
            $datar['ijin']= $this->Absen_M->rawQuery("SELECT data_k.nama_k,data_i.perihal, data_i.end, data_i.start, data_i.tanggal, data_i.id_i FROM data_i INNER JOIN data_k ON data_i.id_k = data_k.id_k WHERE tanggal = '".$this->date."'");
        	$this->load->view('html/header');
    		$this->load->view('html/menu');
    		$this->load->view('acc',$datar);
    		$this->load->view('html/footer');
        }
        else{
            redirect();
        }
    }
    public function acceptAbsen($data)
    {
    	$dataUpdate['acc'] = 1;
    	$dataCondition['id_a'] = $data;
    	$result = $this->Absen_M->update('data_ra',$dataCondition,$dataUpdate);
    	if($result){
			$alert_update_absen_acc = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong> absen berhasil di ACC!</strong></div>";
			$this->session->set_flashdata('alert_update_absen_acc', $alert_update_absen_acc);
		}
		else{
			$alert_update_absen_acc = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>absen gagal di acc! </strong></div>";
			$this->session->set_flashdata('alert_update_absen_acc', $alert_update_absen_acc);
		}
		redirect('Acc_C/');
    	
    }
    public function rejectAbsen($data)
    {
    	$dataUpdate['acc'] = 0;
    	$dataCondition['id_a'] = $data;
    	$result = $this->Absen_M->update('data_ra',$dataCondition,$dataUpdate);
    	if($result){
			$alert_update_absen_acc = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong> absen berhasil di tolak!</strong></div>";
			$this->session->set_flashdata('alert_update_absen_acc', $alert_update_absen_acc);
		}
		else{
			$alert_update_absen_acc = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>absen gagal di tolak! </strong></div>";
			$this->session->set_flashdata('alert_update_absen_acc', $alert_update_absen_acc);
		}
		redirect('Acc_C/');
    }
    public function deleteAbsen($data){
        $dataCondition['id_a'] = $data;
        $result = $this->Absen_M->delete('data_ra',$dataCondition);
        if($result){
            $alert_update_absen_acc = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Delete Absensi Berhasil! </strong> </div>";
            $this->session->set_flashdata('alert_update_absen_acc', $alert_update_absen_acc);
        }
        else{
            $alert_update_absen_acc = "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> <strong>Delete Absensi Gagal! </strong></div>";
            $this->session->set_flashdata('alert_update_absen_acc', $alert_update_absen_acc);
        }
        unset($dataCondition,$result,$data);
        redirect('Acc_C');
    }
}
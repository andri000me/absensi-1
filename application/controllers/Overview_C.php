<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Overview_C extends CI_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->model('Absen_M');
    }
    public function view($page = 'bulanan')
    {
        if (isset($this->session->userdata['logged_in'])) {
            $this->load->view('html/header');
            $this->load->view('html/menu');
            $this->load->view('html/side_menu');
            $this->load->view($page);
            $this->load->view('html/footer');
        }else{
            redirect();
        }
    }
    public function lihat($bulan_or_hari){
        if (isset($this->session->userdata['logged_in'])) {
            if ($bulan_or_hari =='bulan') {
                $data['tahun'] = $this->input->post('l_tahun');
                $data['bulan'] = $this->input->post('l_bulan');

                $yg_dicari = $data['tahun']."-".$data['bulan'];
                $datax['cari'] = $this->Absen_M->rawQuery("

                	SELECT  data_ra.id_a, 
                            data_ra.detail, 
                            data_ra.tanggal, 
                            data_ra.jam, 
                            data_s.keterangan_s, 
                            data_ra.acc,
                            data_k.nama_k
                	FROM data_ra 
                	INNER JOIN data_k ON data_ra.id_k = data_k.id_k
                	INNER JOIN data_s ON data_ra.id_s = data_s.id_s

                	WHERE tanggal LIKE '".$yg_dicari."%'")->result();

                $datax['cari_ijin'] = $this->Absen_M->rawQuery("SELECT data_k.nama_k, data_i.perihal, data_i.end, data_i.start, data_i.tanggal, data_i.id_i FROM data_i INNER JOIN data_k ON data_i.id_k = data_k.id_k WHERE tanggal LIKE '".$yg_dicari."%'")->result();

                $monthNum  = substr($yg_dicari, -2) ;
                $dateObj   = DateTime::createFromFormat('!m', $monthNum);
                $datax['yg_dicari']  = $dateObj->format('F');
                
                $this->load->view('html/header');
                $this->load->view('html/menu');
                $this->load->view('html/side_menu');
                $this->load->view('bulanan');
                $this->load->view('bulan',$datax);
                $this->load->view('html/footer');   
            }
            else {
                $datar['tanggal'] = $this->input->post('l_hari');
                $datax['cari'] = $this->Absen_M->rawQuery("

                	SELECT data_ra.id_a, data_ra.detail, data_ra.tanggal, data_ra.jam, data_s.keterangan_s, data_k.nama_k, data_ra.acc
                	FROM data_ra 
                	INNER JOIN data_k ON data_ra.id_k = data_k.id_k
                	INNER JOIN data_s ON data_ra.id_s = data_s.id_s

                	WHERE tanggal ='".$datar['tanggal']."'")->result();

                $datax['cari_ijin'] = $this->Absen_M->rawQuery("SELECT data_k.nama_k, data_i.perihal, data_i.end, data_i.start, data_i.tanggal, data_i.id_i FROM data_i INNER JOIN data_k ON data_i.id_k = data_k.id_k WHERE tanggal ='".$datar['tanggal']."' ")->result();
                // var_dump($datax['cari']);
                $datax['tanggal'] = $datar['tanggal'];
                unset($datar);
                $this->load->view('html/header');
                $this->load->view('html/menu');
                $this->load->view('html/side_menu');
                $this->load->view('harian');
                $this->load->view('hari',$datax);
                $this->load->view('html/footer');
            }
        }else{
            redirect();
        }
    }
    public function detail_per_status($apa){
        if (isset($this->session->userdata['logged_in'])) {
        	$parameter = date('Y-m-d');
        	$parameter = substr($parameter, 0, 7);
            
            $data['status'] = $this->Absen_M->rawQuery("
            	SELECT data_ra.detail, data_ra.tanggal, data_ra.jam, data_ra.acc, data_s.keterangan_s, data_k.nama_k FROM data_ra
				INNER JOIN data_k ON data_ra.id_k = data_k.id_k
				INNER JOIN data_s ON data_ra.id_s = data_s.id_s
				WHERE
				data_s.id_s = ".$apa." AND data_ra.tanggal LIKE '".$parameter."%'")->result();

            $this->load->view('html/header');
            $this->load->view('html/menu');
            $this->load->view('detail_per_status',$data);
            $this->load->view('html/footer');
        }else{
            redirect();
        }
    }
/*    public function acceptAbsen($data)
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
        redirect('Overview_C/lihat/hari/');    
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
    }*/
}
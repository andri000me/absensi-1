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
        	$datar['absen']= $this->Absen_M->rawQuery("SELECT data_ra.id_a, data_s.keterangan_s, data_ra.detail, data_ra.tanggal, data_ra.jam, data_ra.acc, data_ra.id_k,data_ra.denda, data_k.nama_k FROM data_ra
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
    public function edit_absensi_ku_dari_acc($data,$datab){
        if (isset($this->session->userdata['logged_in'])) {
            
            $datar['id_a'] = $data;
            $datax['absen'] = $this->Absen_M->read('data_ra',$datar);
            unset($datar);

            $datar['id_k'] = $datab;
            $datax['who'] = $this->Absen_M->read('data_k',$datar)->result();
            unset($datar);
            
            
            $datax['status'] = $this->Absen_M->readS('data_s');
            $this->load->view('html/header');
            $this->load->view('html/menu');
            $this->load->view('edit_absensi_dari_acc',$datax);
            $this->load->view('html/footer');
        }
        else{
            redirect();
        }
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
        $where_idm['id_m'] =  4;
        $datax['jam_pulang'] = $this->Absen_M->read('data_m',$where_idm)->result();
        $jam_pulang = $datax['jam_pulang'][0]->misc;
        unset($where_idm);

        if ($data['id_s'] == 1) {
            if ($data['jam'] > $jam_masuk) {
                $data['detail'] = "telat";

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
            }
            else{
                $data['detail'] = "tepat waktu";
                $data['denda'] = 0;   
            }
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
            $data['detail'] = $this->input->post('u_detil_keterangan');
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
        redirect('Acc_C/');
    }
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Overview_C extends CI_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->model('Absen_M');
        date_default_timezone_set("Asia/Jakarta");
        if (!$this->session->userdata('logged_in')){
            redirect();
        }
    }
    public function view($page = 'bulanan')
    {
            $this->load->view('html/header');
            $this->load->view('html/menu');
            $this->load->view('html/side_menu');
            $this->load->view($page);
            $this->load->view('html/footer');
    }
    public function lihat($bulan_or_hari){
        if ($this->input->post() != null) {
            if ($bulan_or_hari =='bulan') {
                $data['tahun'] = $this->input->post('l_tahun');
                $data['bulan'] = $this->input->post('l_bulan');
                $datax['cari'] = $this->Absen_M->rawQuery("

                    SELECT  data_ra.id_a, 
                            data_ra.detail, 
                            data_ra.tanggal, 
                            data_ra.jam, 
                            data_s.keterangan_s, 
                            data_ra.acc,
                            data_ra.denda,
                            data_k.nama_k
                    FROM data_ra
                    INNER JOIN data_k ON data_ra.id_k = data_k.id_k
                    INNER JOIN data_s ON data_ra.id_s = data_s.id_s

                    WHERE MONTH (data_ra.tanggal) = '".$data['bulan']."' AND YEAR (data_ra.tanggal) ='".$data['tahun']."' ORDER BY data_ra.id_a")->result();

                $datax['cari_ijin'] = $this->Absen_M->rawQuery("SELECT data_k.nama_k, data_i.perihal, data_i.end, data_i.start, data_i.tanggal,data_i.denda, data_i.id_i FROM data_i INNER JOIN data_k ON data_i.id_k = data_k.id_k WHERE MONTH (data_i.tanggal) = '".$data['bulan']."' AND YEAR (data_i.tanggal) ='".$data['tahun']."'")->result();
                
                $datax['denda_absen']=$this->Absen_M->rawQuery("SELECT (SELECT SUM(data_ra.denda) from data_ra WHERE MONTH (data_ra.tanggal) = '".$data['bulan']."' AND YEAR (data_ra.tanggal) ='".$data['tahun']."' ) AS total_denda")->result();
                
                $datax['denda_ijin']=$this->Absen_M->rawQuery("SELECT (SELECT SUM(data_i.denda) from data_i WHERE MONTH (data_i.tanggal) = '".$data['bulan']."' AND YEAR (data_i.tanggal) ='".$data['tahun']."' ) AS total_denda")->result();

                // $data['denda_absen'] = $this->Absen_M->rawQuery("SELECT data_ra.denda FROM data_ra WHERE MONTH (data_ra.tanggal) = '".$data['bulan']."' AND YEAR (data_ra.tanggal) ='".$data['tahun']."' ")->result();

                // $data['denda_ijin'] = $this->Absen_M->rawQuery("SELECT data_i.denda FROM data_i WHERE MONTH (data_i.tanggal) = '".$data['bulan']."' AND YEAR (data_i.tanggal) ='".$data['tahun']."' ")->result();

                $dateObj   = DateTime::createFromFormat('!m', $data['bulan']);
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

                    SELECT data_ra.id_a, data_ra.detail, data_ra.tanggal, data_ra.jam, data_s.keterangan_s, data_k.nama_k, data_ra.acc,data_ra.denda
                    FROM data_ra 
                    INNER JOIN data_k ON data_ra.id_k = data_k.id_k
                    INNER JOIN data_s ON data_ra.id_s = data_s.id_s

                    WHERE tanggal ='".$datar['tanggal']."'")->result();

                $datax['cari_ijin'] = $this->Absen_M->rawQuery("SELECT data_k.nama_k, data_i.perihal, data_i.end, data_i.start, data_i.tanggal, data_i.id_i FROM data_i INNER JOIN data_k ON data_i.id_k = data_k.id_k WHERE tanggal ='".$datar['tanggal']."' ")->result();
                $datax['tanggal'] = $datar['tanggal'];
                unset($datar);
                $this->load->view('html/header');
                $this->load->view('html/menu');
                $this->load->view('html/side_menu');
                $this->load->view('harian');
                $this->load->view('hari',$datax);
                $this->load->view('html/footer');
            }
        }
    }
    public function detail_per_status($apa = 0){
    	$parameter = date('Y-m-d');
    	$parameter = substr($parameter, 0, 7);
        
        $data['status'] = $this->Absen_M->rawQuery("
        	SELECT data_ra.detail, data_ra.tanggal, data_ra.jam, data_ra.acc, data_s.keterangan_s, data_k.nama_k, data_ra.denda FROM data_ra
			INNER JOIN data_k ON data_ra.id_k = data_k.id_k
			INNER JOIN data_s ON data_ra.id_s = data_s.id_s
			WHERE
			data_s.id_s = ".$apa." AND data_ra.tanggal LIKE '".$parameter."%'")->result();
        $data['keterangan_s'] = $this->Absen_M->rawQuery("SELECT keterangan_s FROM data_S where id_s =".$apa)->result();

        $this->load->view('html/header');
        $this->load->view('html/menu');
        $this->load->view('detail_per_status',$data);
        $this->load->view('html/footer');
    }
}
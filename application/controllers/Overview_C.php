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
            $this->load->view("Overview/".$page);
            $this->load->view('html/footer');
    }
    public function lihat($bulan_or_hari){
        if ($bulan_or_hari =='bulan') {
            if ($this->input->post() != null) {
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

                $dateObj   = DateTime::createFromFormat('!m', $data['bulan']);
                $datax['bulan_dicari']  = $dateObj->format('F'); // bentuk string
                $datax['tahun_dicari']  = $data['tahun']; // untuk dikirim ke view

                /*query ambil ontime dan late setiap karyawan, masukkan dalam array. lalu gunakan multiple sort*/

                $datax['ranking_1_karyawan'] = $this->Absen_M->rawQuery("
                    SELECT 
                    DISTINCT data_ra.id_k AS me,
                    data_k.nama_k AS my,
                    (
                        SELECT count(data_ra.id_k)
                        FROM data_ra
                        INNER JOIN data_k ON data_ra.id_k = data_k.id_k
                        WHERE data_ra.detail = 'tepat waktu' 
                        AND data_k.jabatan_k != 12 
                        AND MONTH (data_ra.tanggal) ='".$data['bulan']."' 
                        AND YEAR (data_ra.tanggal) = '".$data['tahun']."' 
                        AND data_ra.id_k = me
                        GROUP BY data_ra.id_k
                    ) AS ontime,
                    (
                        SELECT count(data_ra.id_k) 
                        FROM data_ra 
                        INNER JOIN data_k ON data_ra.id_k = data_k.id_k
                        WHERE   data_ra.detail = 'telat' AND 
                        data_k.jabatan_k != 12 
                        AND MONTH (data_ra.tanggal) = '".$data['bulan']."' 
                        AND YEAR (data_ra.tanggal) = '".$data['tahun']."' 
                        AND data_ra.id_k = me
                        GROUP BY data_ra.id_k
                    ) AS late
                    
                    FROM data_ra 
                    INNER JOIN data_k ON data_ra.id_k = data_k.id_k
                    WHERE data_k.jabatan_k != 12
                    ")->result();
                foreach ($datax['ranking_1_karyawan'] as $key => $value) {
                    $karyawan[] = array('karyawan'=> $value->me ,'nama_k' =>$value->my , 'ontime' => $value->ontime,'late'=> $value->late);
                }
                /*pecah kedalam ontime dan late*/
                foreach ($karyawan as $key => $row) {
                    $late[$key]  = $row['late'];
                    $ontime[$key] = $row['ontime'];
                }
                array_multisort($ontime, SORT_DESC,$late, SORT_ASC, $karyawan);
                $last_id_karyawan = end($karyawan); // ambil ranking terakhir
                $last_id_karyawan = $last_id_karyawan['karyawan'];
                // echo "<pre>";
                // var_dump($karyawan);
                // echo "</pre>";

                /*query untuk ranking anak magang, sama seperti karyawan */
                $datax['ranking_1_magang'] = $this->Absen_M->rawQuery("
                    SELECT 
                    DISTINCT data_ra.id_k AS me,
                    data_k.nama_k AS my,
                    (
                        SELECT count(data_ra.id_k)
                        FROM data_ra
                        INNER JOIN data_k ON data_ra.id_k = data_k.id_k
                        WHERE data_ra.detail = 'tepat waktu' AND data_k.jabatan_k = 12 AND MONTH (data_ra.tanggal) = '".$data['bulan']."' AND YEAR (data_ra.tanggal) = '".$data['tahun']."' AND data_ra.id_k = me
                        GROUP BY data_ra.id_k
                    ) AS ontime,
                    (
                        SELECT count(data_ra.id_k) FROM data_ra INNER JOIN data_k ON data_ra.id_k = data_k.id_k
                        WHERE   data_ra.detail = 'telat' AND data_k.jabatan_k = 12 AND MONTH (data_ra.tanggal) = '".$data['bulan']."' AND YEAR (data_ra.tanggal) = '".$data['tahun']."' AND data_ra.id_k = me
                        GROUP BY data_ra.id_k
                    ) AS late
                    
                    FROM data_ra 
                    INNER JOIN data_k ON data_ra.id_k = data_k.id_k
                    WHERE data_k.jabatan_k = 12
                    ")->result();

                /*masukkan ke array*/
                if ($datax['ranking_1_magang'] != array()) {
                    foreach ($datax['ranking_1_magang'] as $key => $value) {
                        $magang[] = array('magang'=> $value->me ,'nama_k' =>$value->my,'late'=> $value->late , 'ontime' => $value->ontime);
                    }
                }
                else{
                    $magang[] = array('magang'=> "-" ,'nama_k' =>"-",'late'=> "-" , 'ontime' => "-");
                }
                /*pecah kedalam ontime dan late*/
                foreach ($magang as $key => $row) {
                    $latem[$key]  = $row['late'];
                    $ontimem[$key] = $row['ontime'];
                }
                array_multisort($ontimem, SORT_DESC,$latem, SORT_ASC, $magang);
                $last_id_magang = end($magang); // ambil ranking terakhir
                $last_id_magang = $last_id_magang['magang'];

                $datax['menit_karyawan_telat'] = $this->Absen_M->rawQuery("SELECT SUM(late_minute) AS jumlah FROM data_ra WHERE id_k='".$last_id_karyawan."' AND MONTH (data_ra.tanggal) = '".$data['bulan']."' AND YEAR (data_ra.tanggal) ='".$data['tahun']."'")->result();

                $datax['menit_magang_telat'] = $this->Absen_M->rawQuery("SELECT SUM(late_minute) AS jumlah FROM data_ra WHERE id_k='".$last_id_magang."' AND MONTH (data_ra.tanggal) = '".$data['bulan']."' AND YEAR (data_ra.tanggal) ='".$data['tahun']."'")->result();

                // var_dump($datax['menit_karyawan_telat']);
                $datax['menit_karyawan_telat'] = (int)$datax['menit_karyawan_telat'][0]->jumlah;
                $datax['menit_magang_telat'] = (int)$datax['menit_magang_telat'][0]->jumlah;

                /*HITUNG TANGGAL MERAH di data_libur*/
                $jml_libur = $this->Absen_M->rawQuery("SELECT COUNT(data_libur.id_libur) AS liburs FROM data_libur WHERE MONTH (data_libur.tanggal) = '".$data['bulan']."' AND YEAR (data_libur.tanggal) = '".$data['tahun']."'")->result();
                /*ENDHITUNG TANGGAL MERAH di data_libur*/

                // var_dump($jml_libur[0]->liburs); //jumlah libur pada bulan $data['bulan']

                /*START HITUNG HARI DALAM BULAN a*/
                $number = cal_days_in_month(CAL_GREGORIAN,date($data['bulan']), date($data['tahun']));
                /*END HITUNG HARI DALAM BULAN a*/

                /*START HITUNG SABTU MINGGU*/
                $weekend = 0;
                for ($i = 1; $i <= $number; $i++) {

                    $date = date("Y-m-{$i}");
                    $dt = strtotime($date);
                    $day = date("l",$dt);

                    if ($day == 'Sunday' OR $day == 'Saturday') {
                        $weekend  = $weekend + 1;
                    }
                }
                
                $datax['jml_libur'] = (int)$jml_libur[0]->liburs;
                $datax['weekend'] = $weekend;
                $datax['days'] = $number;
                /*END HITUNG SABTU MINGGU*/
                $datax['workdays'] = ($datax['days'] - $datax['weekend'] - $datax['jml_libur']) ;
                if ($datax['menit_karyawan_telat'] == 0) {
                    $datax['menit_karyawan_telat'] = 1;
                }elseif($datax['menit_magang_telat'] == 0){
                    $datax['menit_magang_telat'] == 1;
                }

                $datax['late_avg_karyawan'] = $datax['menit_karyawan_telat'] / $datax['workdays'];
                $datax['late_avg_magang'] = $datax['menit_magang_telat'] / $datax['workdays'];
                $datax['karyawan'] = $karyawan;
                $datax['magang'] = $magang;

                $this->load->view('html/header');
                $this->load->view('html/menu');
                $this->load->view('Overview/bulanan');
                $this->load->view('Overview/bulan',$datax);
                $this->load->view('html/footer');   
            }
        }
        else {
            if ($this->input->post() != null) {
                $datar['tanggal'] = $this->input->post('l_hari');
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

                    WHERE tanggal ='".$datar['tanggal']."' ")->result();

                $datax['cari_ijin'] = $this->Absen_M->rawQuery("SELECT data_k.nama_k, data_i.perihal, data_i.end, data_i.start, data_i.tanggal, data_i.id_i FROM data_i INNER JOIN data_k ON data_i.id_k = data_k.id_k WHERE tanggal ='".$datar['tanggal']."' ")->result();

                $datax['denda_absen']=$this->Absen_M->rawQuery("SELECT (SELECT SUM(data_ra.denda) from data_ra WHERE data_ra.tanggal ='".$datar['tanggal']."') AS total_denda")->result();
                // echo "<pre>";
                // var_dump($datax);
                // echo "</pre>";
                $datax['denda_ijin']=$this->Absen_M->rawQuery("SELECT (SELECT SUM(data_i.denda) from data_i WHERE data_i.tanggal ='".$datar['tanggal']."') AS total_denda")->result();

                $datax['tanggal'] = $datar['tanggal'];
                unset($datar);
                $this->load->view('html/header');
                $this->load->view('html/menu');
                $this->load->view('Overview/harian');
                $this->load->view('Overview/hari',$datax);
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
        $this->load->view('Overview/detail_per_status',$data);
        $this->load->view('html/footer');
    }
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Playground_C extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Absen_M');
        date_default_timezone_set("Asia/Jakarta");
    }
    public function index()
    {
        	$this->load->view('html/header');
    		$this->load->view('html/menu');
    		$this->load->view('playground');
    		$this->load->view('html/footer');
    }
    public function upload()
    {
            //realpath(APPPATH);//D:\xampp\htdocs\absensi\application

            $this->load->library('upload');
        
            $configfoto['upload_path']          = FCPATH."playground/foto/";
            $configfoto['allowed_types']        = 'gif|jpg|png|jpeg|pdf|docx';

            $configkk['upload_path']          = FCPATH."playground/kk/";
            $configkk['allowed_types']        = 'gif|jpg|png|jpeg|pdf|docx';

            $configktp['upload_path']          = FCPATH."playground/ktp/";
            $configktp['allowed_types']        = 'gif|jpg|png|jpeg|pdf|docx';


            $this->upload->initialize($configfoto);


            if($this->upload->initialize($configfoto)->do_upload('foto')){
                echo "step 1<br>";
                $datafoto = $this->upload->data();
                $data['foto'] = "playground/foto/".$datafoto['file_name'];
                
                if ($this->upload->initialize($configkk)->do_upload('kk')) {
                    echo "step 11<br>";
                    $datakk = $this->upload->data();
                    $data['kk'] = "playground/kk/".$datakk['file_name'];


                    if ($this->upload->initialize($configktp)->do_upload('ktp')) {
                        echo "step 111<br>";
                        $dataktp = $this->upload->data();
                        $data['ktp'] = "playground/ktp/".$dataktp['file_name'];
                        echo "<pre>";
                        var_dump($datafoto);
                        var_dump($datakk);
                        var_dump($dataktp);
                        echo "</pre>";
                    }
                    else{
                        echo "bad 3 <br>";
                        $delete = realpath(APPPATH.'../'.$data['foto']);
                        $dilete = realpath(APPPATH.'../'.$data['kk']);
                        unlink($dilete,$delete);
                    }
                }else{
                    echo "bad 2 <br>";
                    $delete = realpath(APPPATH.'../'.$data['foto']);
                    echo $delete;
                    unlink($delete);
                }
            }
            else{
                echo "bad 1 <br>";
            }
    }
}
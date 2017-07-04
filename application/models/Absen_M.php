<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Absen_M extends CI_Model {
    public function __construct(){
        parent::__construct();
    }

    public function readS($table){
        $query = $this->db->get($table);
        return $query;
    }
    public function read($table,$dataCondition){
        $this->db->where($dataCondition);
        $query = $this->db->get($table);
        return $query;
    }
    public function create($table,$data){
        $query = $this->db->insert($table, $data);
        return $query;
        //return $this->db->set($data)->get_compiled_insert($table);
    }
    public function createId($table,$data){
        $result = $this->db->insert($table, $data);
        $insert_id = $this->db->insert_id();
        
        return $insert_id;
    }
    public function delete($table,$dataCondition){
        $this->db->where($dataCondition);
        $result = $this->db->delete($table);        
        // return $this->db->get_compiled_delete($table);
        return $result;
    }
    public function update($table,$dataCondition,$dataUpdate){
        $this->db->where($dataCondition);
        $result = $this->db->update($table,$dataUpdate);
        if (!$result) {
            return json_encode(array("status"=>false, "error_message"=>$this->db->error()));
        }else{
            return json_encode(array("status"=>true, "error_message"=>""));
        }
    }
    public function apakahSudah($data){
        $this->db->where(array('id_k' => $data['id_k'], 
                                'tanggal' => $data['tanggal']                                
        ));
        $query = $this->db->get('data_ra');
        return $query;
    }
    public function searchResult($table,$dataCondition){
        $this->db->where($dataCondition);
        //$this->db->like($like);
        // $query = $this->db->get_compiled_select($table);
        $query = $this->db->get($table);
        return $query;
    }
    public function whereLike($table,$where,$like){
        $this->db->where($where);
        $this->db->like($like);
        $query = $this->db->get($table);
        return $query->result();
    }
    public function rawQuery($query){
        $result = $this->db->query($query);
        
        return $result;
    }
    function readAbsen_perorang($param,$data){
        $parameter = date('Y-m-d');
        $parameter = substr($parameter, 0, 7);
        $this->db->select(" 
                            data_ra.id_A,
                            data_ra.id_karyawan,
                            data_s.keterangan_s,
                            data_ra.detail,
                            data_ra.tanggal,
                            data_ra.jam
                        ");
        $this->db->join('data_k','data_ra.id_karyawan = data_k.id_k');
        $this->db->join('data_s','data_ra.id_status = data_s.id_S');
        $this->db->like(array('tanggal' => $parameter));
        $this->db->where('data_k.id_k',$data);
        $this->db->order_by('id_A','DESC');
        $query = $this->db->get('data_ra');
        return $query;
    }
    function readAbsen_perstatus($param,$data){
        $parameter = date('Y-m-d');
        $parameter = substr($parameter, 0, 7);
        $this->db->select(" data_k.nama_k,
                            data_ra.detail,
                            data_ra.tanggal,
                            data_ra.jam,
                            data_s.keterangan_s
                        ");
        $this->db->join('data_k','data_ra.id_karyawan = data_k.id_k');
        $this->db->join('data_s','data_ra.id_status = data_s.id_S');
        $this->db->like(array('tanggal' => $parameter));
        $this->db->where('data_s.id_s',$data);
        $this->db->order_by('id_A','DESC');
        $query = $this->db->get('data_ra');
        return $query;
    }
    public function readAbsenBulanan($param,$data){
        $this->db->select("
                            data_ra.id_a,
                            data_ra.detail,
                            data_ra.tanggal,
                            data_ra.jam,
                            data_s.keterangan_s,
                            data_k.nama_k
        ");
        $this->db->join('data_k','data_ra.id_karyawan = data_k.id_k');
        $this->db->join('data_s','data_ra.id_status = data_s.id_s');
        $this->db->like(array($param => $data));
        $this->db->order_by('tanggal','DESC');
        $query = $this->db->get('data_ra');
        return $query->result();
    }
    public function countResult($table,$dataCondition){ //cek apkah hadir
        $this->db->where($dataCondition);
        return $this->db->count_all_results($table);
    }
    public function readIjins($bulan){
        $this->db->select(" 
                            data_k.nama_k,
                            data_i.perihal,
                            data_i.start,
                            data_i.end,
                            data_i.id_i,
                            data_i.tanggal
                        ");
        $this->db->like(array('data_i.tanggal' => $bulan));
        $this->db->join('data_i','data_i.id_k = data_k.id_k');
        $query = $this->db->get('data_k');
        return $query->result();
    }
    public function readIjin($param,$data){
        $this->db->select(" 
                            data_i.id_i,
                            data_i.id_k,
                            data_i.perihal,
                            data_i.start,
                            data_i.end,
                            data_i.tanggal
                        ");
        $this->db->join('data_i','data_i.id_k = data_k.id_k');
        $this->db->where($param,$data);
        $query = $this->db->get('data_k');
        return $query->result();
    }

}
?>
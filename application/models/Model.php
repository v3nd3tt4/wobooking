<?php
class Model extends CI_Model {

  public function __construct(){
      parent::__construct();
      $this->default = $this->load->database('default', TRUE);
    }
    function list_data_all($table){
        return $query = $this->db->get($table)->result();
    }
    public function get($table, $nama = null){
      $this->db->select('*');
      $this->db->from($table);
      return $this->db->get()->result();
    }
    function genID($id,$table,$param_id){
      $this->db->select('Right('.$param_id.',3) as kode ',false);
      $this->db->order_by($param_id, 'desc');
      $this->db->limit(1);
      $query = $this->db->get($table);
      if($query->num_rows()<>0){
          $data = $query->row();
          $kode = intval($data->kode)+1;
      }else{
          $kode = 1;
      }
      $kodemax = str_pad($kode,3,"0",STR_PAD_LEFT);
      $kodejadi  = $id.$kodemax;
      return $kodejadi;
    }
    function simpan_data($data, $table){
      $this->db->insert($table,$data);
      return true;
    }
    function ambil($param_id, $id, $table){
      return $this->db->get_where($table, array($param_id => $id));
    }
    function update($param_id, $id, $table, $data){
      $this->db->where($param_id, $id);
      $this->db->update($table, $data);
      return true;
    }
    function hapus($param_id, $id, $table){
      $this->db->delete($table, array($param_id => $id));
      return true;
    }
   
}
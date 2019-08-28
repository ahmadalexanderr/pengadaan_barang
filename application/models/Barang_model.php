<?php 
class Barang_model extends CI_Model{

    public function get_daftar()
    {
       $query = $this->db->query("SELECT * FROM submisi_barang LEFT JOIN jenis_barang ON submisi_barang.id_jenis_barang = jenis_barang.id_jenis_barang LEFT JOIN status_submisi ON submisi_barang.id_status_submisi = status_submisi.id_status_submisi LEFT JOIN status_terima ON submisi_barang.id_status_terima = status_terima.id_status_terima WHERE status_submisi.nama_status_submisi != 'pending' ")->result_array();
       return $query;
    }

   public function get_submit()
    {
       $query = $this->db->query("SELECT * FROM submisi_barang LEFT JOIN jenis_barang ON submisi_barang.id_jenis_barang = jenis_barang.id_jenis_barang LEFT JOIN status_submisi ON submisi_barang.id_status_submisi = status_submisi.id_status_submisi LEFT JOIN status_terima ON submisi_barang.id_status_terima = status_terima.id_status_terima")->result_array();
       return $query;
    }

    public function get_request(){
       $username = $this->session->userdata('username');
       $query = $this->db->query("SELECT * FROM submisi_barang LEFT JOIN jenis_barang ON submisi_barang.id_jenis_barang = jenis_barang.id_jenis_barang LEFT JOIN status_submisi ON submisi_barang.id_status_submisi = status_submisi.id_status_submisi LEFT JOIN status_terima ON submisi_barang.id_status_terima = status_terima.id_status_terima WHERE username = '$username'")->result_array();
       return $query;
    }

     public function get_submisi_pending(){
        $query = $this->db->query("SELECT * FROM status_submisi WHERE id_status_submisi = '1' ");
        return $query;
    } 

    public function get_terima_pending(){
        $query = $this->db->query("SELECT * FROM status_terima WHERE id_status_submisi = '1' ");
        return $query;
    }

    public function get_terima_declined(){
        $query = $this->db->query("SELECT * FROM status_terima WHERE id_status_submisi = '2' ");
        return $query;
    }

    public function get_terima_accepted(){
        $query = $this->db->query("SELECT * FROM status_terima WHERE id_status_submisi = '3' ");
        return $query;
    }
    
    public function get_status_submisi(){
        $query = $this->db->query("SELECT * FROM status_submisi");
        return $query;
    }

    public function get_status_terima(){
       $query = $this->db->query("SELECT * FROM status_terima");
       //$query = $this->db->select('*')->from('status_terima')->where('id_status_terima', $id)->get();
       return $query;
    }

    public function get_satu_barang($id){
        $query = array('id' => $id);
        return $this->db->get_where('submisi_barang', $query);
        //return $this->db->select('*')->from('submisi_barang')->join('status_terima', 'submisi_barang.status_submisi = status_terima.status_submisi')->where($query)->get();
    }

    public function delete_barang($id){
        $this->db->where('id', $id);
        $this->db->delete('submisi_barang');
    }
}
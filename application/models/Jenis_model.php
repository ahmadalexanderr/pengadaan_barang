<?php
class Jenis_model extends CI_Model{
    
    public function insert_jenis($nama_jenis_barang, $izin_jenis_barang)
    {
        $query = $this->db->query("INSERT INTO jenis_barang(nama_jenis_barang, izin_jenis_barang) VALUES ('$nama_jenis_barang', '$izin_jenis_barang')");
        return $query;
    }

    public function get_jenis(){
       $query = $this->db->get('jenis_barang')->result_array();
       return $query;
    }

    public function get_satu_jenis($id_jenis_barang){
        $query = array('id_jenis_barang' => $id_jenis_barang);
        return $this->db->get_where('jenis_barang', $query);
    }
    
    // public function delete_jenis($id_jenis_barang){
    //     $this->db->where('id_jenis_barang', $id_jenis_barang);
    //     $this->db->delete('jenis_barang');
    // }
    
    public function delete_jenis_all($id_jenis_barang){
        $query = "DELETE jenis_barang, submisi_barang FROM jenis_barang, submisi_barang WHERE jenis_barang.id_jenis_barang=submisi_barang.id_jenis_barang AND jenis_barang.id_jenis_barang = ?";
        return $this->db->query($query, array($id_jenis_barang));
    }

    public function get_approved_jenis(){
        $query = $this->db->select('*')->where('izin_jenis_barang','accepted')->get('jenis_barang');
        return $query;
    }

    public function get_status_jenis(){
        $query = $this->db->query("SELECT * FROM jenis_barang WHERE izin_jenis_barang != 'pending'");
        return $query;
    }

    // public function hitung_perKategori(){
    //     $id_jenis_barang = $this->input->get('id_jenis_barang');
    //     $query = $this->db->query("SELECT SUM(submisi_barang.jumlah_barang) as total FROM submisi_barang LEFT JOIN jenis_barang ON submisi_barang.id_jenis_barang = jenis_barang.id_jenis_barang WHERE jenis_barang.id_jenis_barang = '$id_jenis_barang' AND submisi_barang.id_status_submisi != 'pending' ")->row();
    //     return $query->total;
    // }
    public function hitung_perKategori(){
        $id_jenis_barang = $this->input->get('id_jenis_barang');
        $query = $this->db->query("SELECT jenis_barang.*, SUM(submisi_barang.jumlah_barang) as total FROM submisi_barang LEFT JOIN jenis_barang ON submisi_barang.id_jenis_barang = jenis_barang.id_jenis_barang group by jenis_barang.id_jenis_barang")->result_array();
        return $query;
    }

    public function hitung_perKategori1(){
        $id_jenis_barang = $this->input->get('id_jenis_barang');
        $query = $this->db->query("SELECT jenis_barang.*, SUM(submisi_barang.jumlah_barang) as total FROM submisi_barang LEFT JOIN jenis_barang ON submisi_barang.id_jenis_barang = jenis_barang.id_jenis_barang WHERE submisi_barang.id_status_submisi != 1 group by jenis_barang.id_jenis_barang")->result_array();
        return $query;
    }
}
?>
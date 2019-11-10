<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Subag extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Barang_model');
        $this->load->model('Jenis_model');
        $this->load->model('User_model');
    }

   public function index(){
        $data['title'] = 'Dashboard';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('login/logout_modal', $data);
        $this->load->view('templates/footer');  
    }

    public function profile(){
        $data['title'] = 'Edit Profile';
        $data['record'] = $this->User_model->user_logged_in()->row_array();
        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[3]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[3]|matches[new_password1]');
        $this->load->view('login/logout_modal', $data);
        if($this->form_validation->run()==false){ 
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/profile', $data);
            $this->load->view('templates/footer');
        } else {
                $old_password = $this->User_model->check_old_password()->row_array()['password'];
                $current_password = $this->input->post('current_password');
                $new_password = $this->input->post('new_password1');
                if (md5($current_password) != $old_password){
                   $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Silahkan ulangi password lama anda</div>');
                    redirect('subag/profile'); 
                }
                elseif ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Password baru tidak bisa sama dengan yang lama</div>');
                    redirect('subag/profile');
                } else {
                    // password sudah ok
                    $password_hash = md5($new_password);
                    $this->db->set('password', $password_hash);
                    $this->db->where('username', $this->session->userdata('username'));
                    $this->db->update('login_session');
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password berhasil diubah</div>');
                    redirect('subag/profile');
                }
            }
       }

    public function daftarBarang(){
        $data['title'] = "Daftar Barang";
        $data['jenis_barang'] = $this->Jenis_model->get_approved_jenis()->result_array();
        $data['submit_barang'] = $this->Barang_model->get_submit();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/daftarBarang', $data);
        $this->load->view('login/logout_modal', $data);
        $this->load->view('templates/footer'); 
    }

    public function permintaanBarang(){
        $data['title'] = 'Daftar Barang';
        $data['submit_barang'] = $this->Barang_model->getSubmit();
        $data['status_submisi']= enums('submisi_barang', 'status_submisi');
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/permintaanBarang', $data);
        $this->load->view('login/logout_modal', $data);
        $this->load->view('templates/footer');  
    }
    
    public function tambahJenisBarang(){
        $data['title'] = 'Daftar Kategori';
        $data['izin_jenis_barang']= enums('jenis_barang', 'izin_jenis_barang');
        $this->load->view('login/logout_modal', $data);
        $this->form_validation->set_rules('nama_jenis_barang', 'Nama Jenis Barang', 'trim|required|alpha_dash');
        if($this->form_validation->run()==false)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/tambahJenisBarang', $data);
            $this->load->view('templates/footer');  
        }
        else 
        {
            $this->insertJenis();
        } 
    }

     public function daftarKategori(){
        $data['title'] = "Daftar Kategori";
        $data['izin_jenis_barang']= enums('jenis_barang', 'izin_jenis_barang');
        //$data['jenis_barang'] = $this->Jenis_model->get_status_jenis()->result_array();
        $data['jenis_barang'] = $this->Jenis_model->hitung_perKategori1();
        //$data['jenis_barang'] = $this->Jenis_model->get_jenis();
        $this->load->view('login/logout_modal', $data);
         $this->form_validation->set_rules('nama_jenis_barang', 'Nama Jenis Barang', 'trim|required|is_unique[jenis_barang.nama_jenis_barang]');
        if($this->form_validation->run()==false){
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/daftarJenis', $data);
        $this->load->view('user/buatPermintaan', $data);
        $this->load->view('templates/footer');
        } else {
             $this->insertJenis();
        } 
    }

    public function pengajuanKategori(){
        $data['title'] = "Daftar Kategori";
        $data['izin_jenis_barang']= enums('jenis_barang', 'izin_jenis_barang');
        //$data['jenis_barang'] = $this->Jenis_model->get_status_jenis()->result_array();
        $data['jenis_barang'] = $this->Jenis_model->get_jenis();
        //$data['jenis_barang'] = $this->Jenis_model->get_jenis();
        $this->load->view('login/logout_modal', $data);
        $this->form_validation->set_rules('nama_jenis_barang', 'Nama Jenis Barang', 'trim|required|is_unique[jenis_barang.nama_jenis_barang]');
        if($this->form_validation->run()==false){
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/allJenis', $data);
        $this->load->view('user/buatPermintaan', $data);
        $this->load->view('templates/footer');
        } else {
             $this->insertJenis();
        } 
    }   
    
    public function editJenis($id_jenis_barang){
        $data['title'] = "Daftar Kategori";
        $data['record'] = $this->Jenis_model->get_satu_jenis($id_jenis_barang)->row_array();
        $data['izin_jenis_barang']= enums('jenis_barang', 'izin_jenis_barang');
        $data['jenis_barang'] = $this->Jenis_model->get_approved_jenis()->result_array();
        $this->load->view('login/logout_modal', $data);
        $this->form_validation->set_rules('nama_jenis_barang', 'Nama Jenis Barang', 'trim|required');
        if($this->form_validation->run()==false)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('subag/tampilkanKategori', $data);
            $this->load->view('templates/footer');  
        }
        else 
        {   
            $data = array(
                'nama_jenis_barang' => $this->input->post('nama_jenis_barang'),
                'izin_jenis_barang' => $this->input->post('izin_jenis_barang')
            );
            $this->db->where('id_jenis_barang', $id_jenis_barang);
            $this->db->update('jenis_barang', $data);
            $this->session->set_flashdata('message',  '<div class="alert alert-success" role="alert"> Kategori berhasil ditampilkan </div>');
            redirect('subag/pengajuanKategori'); 
        }
    }

    private function insertJenis(){
        $nama_jenis_barang = $this->input->post('nama_jenis_barang');
        $izin_jenis_barang = $this->input->post('izin_jenis_barang');
        $this->Jenis_model->insert_jenis($nama_jenis_barang, $izin_jenis_barang);
        $this->session->set_flashdata('message',  '<div class="alert alert-success" role="alert"> Kategori barang berhasil diajukan </div>');
        redirect('subag/daftarKategori');
    }

     public function accBarang($id){
        $data['title'] = "Edit Barang";
        $data['record'] = $this->Barang_model->get_satu_barang($id)->row_array();
        $data['submit_barang'] = $this->Barang_model->get_submit();
        $data['approved_jenis_barang'] = $this->Jenis_model->get_approved_jenis()->result_array();
        $data['dropdownItems'] = listData('status_submisi', 'id_status_submisi', 'nama_status_submisi');
       // $data['status_submisi_dropdown'] = form_dropdown('id_status_submisi', $dropdownItems, '', 'class="form-control"');
        //$data['status_terima_dropdown'] = form_dropdown('id_status_terima', [], '', 'class="form-control"');
        $this->load->view('login/logout_modal', $data);
        $this->form_validation->set_rules('nama_barang', 'Barang', 'trim|required');
        $this->form_validation->set_rules('jumlah_barang', 'Jumlah', 'trim|required|numeric');
        $this->form_validation->set_rules('satuan', 'Satuan', 'trim|required|alpha');
        if($this->form_validation->run()==false){
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/acc', $data);
            $this->load->view('user/buatPermintaan', $data);
            $this->load->view('templates/footer'); 
    } else {
         $data = array(
                'id_jenis_barang' => $this->input->post('id_jenis_barang'),
                'nama_barang' => $this->input->post('nama_barang'),
                'jumlah_barang' => $this->input->post('jumlah_barang'),
                'satuan' => $this->input->post('satuan'),
                'id_status_submisi' => $this->input->post('id_status_submisi'),
                'username' => $this->input->post('username'),
                'id_status_terima' => $this->input->post('id_status_terima')
            );
            $this->db->where('id', $id);
            $this->db->update('submisi_barang', $data);
            $this->session->set_flashdata('message',  '<div class="alert alert-success" role="alert"> Barang berhasil di-ACC </div>');
            redirect('subag/daftarBarang');
       }    
    }

    public function deleteBarang($id){
       $this->Barang_model->delete_barang($id);
       $this->session->set_flashdata('message',  '<div class="alert alert-success" role="alert"> Data terhapus </div>');
       redirect('subag/daftarBarang'); 
    }
}
?>
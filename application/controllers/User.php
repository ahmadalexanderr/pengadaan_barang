<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller {
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
        $data['approved_jenis_barang'] = $this->Jenis_model->get_approved_jenis()->result_array();
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
                $current_password = $this->input->post('current_password');
                $new_password = $this->input->post('new_password1');
               if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Password baru tidak bisa sama dengan yang lama</div>');
                    redirect('admin/profile');
                } else {
                    // password sudah ok
                    $password_hash = MD5($new_password);

                    $this->db->set('password', $password_hash);
                    $this->db->where('username', $this->session->userdata('username'));
                    $this->db->update('login_session');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password berhasil diubah</div>');
                    redirect('user/profile');
                }
            }
       }

    public function daftarBarang(){
        $data['title'] = "Daftar Barang";
        $data['approved_jenis_barang'] = $this->Jenis_model->get_approved_jenis()->result_array();
        $data['status_submisi_pending'] = $this->Barang_model->get_submisi_pending()->result_array();
        $data['status_terima_pending'] = $this->Barang_model->get_terima_pending()->result_array();
        $data['submit_barang'] = $this->Barang_model->get_daftar();
        $this->load->view('login/logout_modal', $data);
        $this->form_validation->set_rules('nama_barang', 'Barang', 'trim|required');
        $this->form_validation->set_rules('jumlah_barang', 'Jumlah', 'trim|required|numeric');
        $this->form_validation->set_rules('satuan', 'Satuan', 'trim|required|alpha');
        if($this->form_validation->run()==false)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/daftarBarang', $data);
            $this->load->view('user/buatPermintaan', $data);
            $this->load->view('templates/footer');  
        }
        else 
        {
            $this->insert();
        }
    }
  
    private function insert()
        {
            $id_jenis_barang   = $this->input->post('id_jenis_barang');
            $nama_barang    = $this->input->post('nama_barang');
            $jumlah_barang  = $this->input->post('jumlah_barang');
            $satuan         = $this->input->post('satuan');
            $id_status_submisi = $this->input->post('id_status_submisi');
            $username       = $this->session->userdata('username');
            $id_status_terima = $this->input->post('id_status_terima');
            $data = array(
                'id_jenis_barang' => $id_jenis_barang,
                'nama_barang' => $nama_barang,
                'jumlah_barang' => $jumlah_barang,
                'satuan' => $satuan,
                'id_status_submisi' => $id_status_submisi,
                'username' => $username,
                'id_status_terima' => $id_status_terima
            );
            $this->db->insert('submisi_barang', $data);
            //$this->Barang_model->insert_barang($id_jenis_barang, $nama_barang, $jumlah_barang, $satuan, $id_status_submisi, $username, $id_status_terima);
            $this->session->set_flashdata('message',  '<div class="alert alert-success" role="alert"> Barang berhasil disubmit </div>');
            redirect('user/pengajuan');
        }

    public function pengajuan(){
        $data['title'] = 'Pengajuan Saya';
        $data['submit_barang'] = $this->Barang_model->get_request();
        $data['approved_jenis_barang'] = $this->Jenis_model->get_approved_jenis()->result_array();
        $this->load->view('login/logout_modal', $data);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/pengajuanSaya', $data);
        $this->load->view('user/buatPermintaan', $data);
        $this->load->view('templates/footer'); 
    }

        public function konfirmasiBarang($id){
        $data['title'] = "Konfirmasi Barang";
        $data['record'] = $this->Barang_model->get_satu_barang($id)->row_array();
        $data['submit_barang'] = $this->Barang_model->get_submit();
        $data['approved_jenis_barang'] = $this->Jenis_model->get_approved_jenis()->result_array();
        $data['status_submisi'] = $this->Barang_model->get_status_submisi()->result_array();
        $data['status_terima'] = $this->Barang_model->get_terima_accepted()->result_array();
        //$data['dropdownItems'] = listData('status_submisi', 'id_status_submisi', 'nama_status_submisi');
        //$data['status_submisi_dropdown'] = form_dropdown('id_status_submisi', $dropdownItems, '', 'class="form-control"', 'readonly');
        //$data['status_terima_dropdown'] = form_dropdown('id_status_terima', [], '', 'class="form-control"');
        $this->load->view('login/logout_modal', $data);
        $this->form_validation->set_rules('nama_barang', 'Barang', 'trim|required');
        $this->form_validation->set_rules('jumlah_barang', 'Jumlah', 'trim|required|numeric');
        $this->form_validation->set_rules('satuan', 'Satuan', 'trim|required|alpha');
        if($this->form_validation->run()==false){
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/konfirmasi', $data);
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
            $this->session->set_flashdata('message',  '<div class="alert alert-success" role="alert"> Data berhasil diubah </div>');
            redirect('user/pengajuan');
       }    
    }

    public function deleteBarang($id){
       $this->Barang_model->delete_barang($id);
       $this->session->set_flashdata('message',  '<div class="alert alert-success" role="alert"> Data terhapus </div>');
       redirect('user/pengajuan'); 
    }

}
?>
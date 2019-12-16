<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Barang_model');
        $this->load->model('Jenis_model');
        $this->load->model('User_model');
        //$this->load->model('Login_model');
    }

    public function index(){
        $data['title'] = 'Dashboard';
        // $data['jenis_barangA'] = $this->Jenis_model->get_approved_jenis()->result_array();
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
                    redirect('admin/profile');
                }
                elseif ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Password baru tidak bisa sama dengan yang lama</div>');
                    redirect('admin/profile');
                } else {
                    // password sudah ok
                    $password_hash = md5($new_password);
                    $this->db->set('password', $password_hash);
                    $this->db->where('username', $this->session->userdata('username'));
                    $this->db->update('login_session');
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password berhasil diubah</div>');
                    redirect('admin/profile');
                }
            }
       }

    public function daftarBarang(){
        $data['title'] = "Daftar Barang";
        $data['approved_jenis_barang'] = $this->Jenis_model->get_approved_jenis()->result_array();
        $data['status_submisi_pending'] = $this->Barang_model->get_submisi_pending()->result_array();
        $data['status_terima_pending'] = $this->Barang_model->get_terima_pending()->result_array();
        $data['submit_barang'] = $this->Barang_model->get_submit();
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
            $this->session->set_flashdata('message',  '<div class="alert alert-success" role="alert"> Pengajuan berhasil </div>');
            redirect('admin/pengajuan');
        }

    public function editBarang($id){
        $data['title'] = "Daftar Barang";
        $data['record'] = $this->Barang_model->get_satu_barang($id)->row_array();
        $data['submit_barang'] = $this->Barang_model->get_submit();
        $data['approved_jenis_barang'] = $this->Jenis_model->get_approved_jenis()->result_array();
        $data['dropdownItems'] = listData('status_submisi', 'id_status_submisi', 'nama_status_submisi');
        //$data['status_submisi_dropdown'] = form_dropdown('id_status_submisi', $dropdownItems, '', 'class="form-control"');
        //$data['status_terima_dropdown'] = form_dropdown('id_status_terima', [], '', 'class="form-control"');
        $this->load->view('login/logout_modal', $data);
        $this->form_validation->set_rules('nama_barang', 'Barang', 'trim|required');
        $this->form_validation->set_rules('jumlah_barang', 'Jumlah', 'trim|required|numeric');
        $this->form_validation->set_rules('satuan', 'Satuan', 'trim|required|alpha');
        $this->form_validation->set_rules('alasan', 'alasan', 'trim');
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
                'id_status_terima' => $this->input->post('id_status_terima'),
                'alasan' => $this->input->post('alasan')
            );
            $this->db->where('id', $id);
            $this->db->update('submisi_barang', $data);
            $this->session->set_flashdata('message',  '<div class="alert alert-success" role="alert"> Barang berhasil di-ACC</div>');
            redirect('admin/daftarBarang');
       }
    }

    public function konfirmasiBarang($id){
        $data['title'] = "Pengajuan Saya";
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
        $this->form_validation->set_rules('alasan', 'alasan', 'trim');
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
                'id_status_terima' => $this->input->post('id_status_terima'),
                'alasan' => $this->input->post('alasan')
            );
            $this->db->where('id', $id);
            $this->db->update('submisi_barang', $data);
            $this->session->set_flashdata('message',  '<div class="alert alert-success" role="alert"> Pengajuan terkonfirmasi </div>');
            redirect('admin/pengajuan');
       }
    }

    public function alasan_control($id){
        $data['title'] = 'Pengajuan Saya';
        $data['record'] = $this->Barang_model->get_satu_barang($id)->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/alasan_view', $data);
        $this->load->view('login/logout_modal', $data);
        $this->load->view('templates/footer');
    }

    public function deleteBarang($id){
       $this->Barang_model->delete_barang($id);
       $this->session->set_flashdata('message',  '<div class="alert alert-success" role="alert"> Data terhapus </div>');
       redirect('admin/daftarBarang');
    }

    public function permintaanJenis(){
        $data['title'] = "Daftar Kategori";
        $data['izin_jenis_barang']= enums('jenis_barang', 'izin_jenis_barang');
        //$data['approved_jenis_barang'] = $this->Jenis_model->get_approved_jenis()->result_array();
        $data['jenis_barang'] = $this->Jenis_model->hitung_perKategori1();
        // foreach ($data['jenis_barang'] as $key => $value) {
        //     $value['total']=$this->Jenis_model->hitung_perKategori($value['id_jenis_barang']);
        // }
        //$data['num_barang'] = $this->Jenis_model->hitung_perKategori();
        $this->load->view('login/logout_modal', $data);
        $this->form_validation->set_rules('nama_jenis_barang', 'Nama Jenis Barang', 'trim|required|is_unique[jenis_barang.nama_jenis_barang]');
        if($this->form_validation->run()==false){
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/daftarJenis', $data);
        $this->load->view('templates/footer');
        } else {
             $this->insertJenis();
        }
    }

    public function accJenis(){
        $data['title'] = "Daftar Kategori";
        $data['izin_jenis_barang']= enums('jenis_barang', 'izin_jenis_barang');
        //$data['approved_jenis_barang'] = $this->Jenis_model->get_approved_jenis()->result_array();
        $data['jenis_barang'] = $this->Jenis_model->get_jenis();
        // foreach ($data['jenis_barang'] as $key => $value) {
        //     $value['total']=$this->Jenis_model->hitung_perKategori($value['id_jenis_barang']);
        // }
        //$data['num_barang'] = $this->Jenis_model->hitung_perKategori();
        $this->load->view('login/logout_modal', $data);
        $this->form_validation->set_rules('nama_jenis_barang', 'Nama Jenis Barang', 'trim|required');
        if($this->form_validation->run()==false){
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/allJenis', $data);
        $this->load->view('templates/footer');
        } else {
             $this->insertJenis();
        }
    }

    private function insertJenis(){
        $nama_jenis_barang = $this->input->post('nama_jenis_barang');
        $izin_jenis_barang = $this->input->post('izin_jenis_barang');
        $this->Jenis_model->insert_jenis($nama_jenis_barang, $izin_jenis_barang);
        $this->session->set_flashdata('message',  '<div class="alert alert-success" role="alert"> Kategori barang berhasil ditambahkan. </div>');
        redirect('admin/accJenis');
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
            $this->load->view('admin/editJenis', $data);
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
            if ($this->input->post('izin_jenis_barang') == 'accepted'){ 
            $this->session->set_flashdata('message',  '<div class="alert alert-success" role="alert"> Kategori berhasil ditampilkan </div>');
            }
            redirect('admin/accJenis');
        }
    }

    public function hapusJenis($id_jenis_barang){
        //$this->Jenis_model->delete_jenis($id_jenis_barang);
        $this->Jenis_model->delete_jenis_all($id_jenis_barang);
        $this->session->set_flashdata('message',  '<div class="alert alert-success" role="alert"> Data terhapus </div>');
        redirect('admin/permintaanJenis');
    }

    public function userManagement(){
     $data['title'] = 'User Management';
     $data['user'] = $this->User_model->get_user();
     $id = $this->uri->segment('3');
     $data['record'] = $this->User_model->get_satu_user($id)->row_array();
     $data['level_user'] = enums('login_session', 'level');
      $this->load->view('login/logout_modal', $data);
      $this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[login_session.username]|alpha');
      $this->form_validation->set_rules('password', 'Password', 'trim|required|md5|min_length[3]');
      $this->form_validation->set_rules('level', 'Level', 'trim|required');
      if($this->form_validation->run()==false){
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/manageUser', $data);
        $this->load->view('admin/addUser', $data);
        $this->load->view('templates/footer');
      } else {
         $this->insertUser();
      }
    }

    private function insertUser(){
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $level    = $this->input->post('level');
        $this->User_model->insert_user($username, $password, $level);
        $this->session->set_flashdata('message',  '<div class="alert alert-success" role="alert"> User berhasil ditambahkan</div>');
        redirect('admin/userManagement');
    }

    public function editUser($id){
        $data['title'] = 'User Management';
        $data['user'] = $this->User_model->get_user();
        $data['record'] = $this->User_model->get_satu_user($id)->row_array();
        $data['level_user'] = enums('login_session', 'level');
        $data['jenis_barang'] = $this->Jenis_model->get_approved_jenis()->result_array();
         $this->load->view('login/logout_modal', $data);
        $this->form_validation->set_rules('level', 'Level', 'trim|required');
        if($this->form_validation->run()==false)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/editUser', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            $data = array(
                'level' => $this->input->post('level'),
            );
            $this->db->where('id', $id);
            $this->db->update('login_session', $data);
            $this->session->set_flashdata('message',  '<div class="alert alert-success" role="alert"> Hak akses user berhasil diubah </div>');
            redirect('admin/userManagement');
        }
    }

    public function resetUser($id){
        $data['title'] = 'User Management';
        $data['user'] = $this->User_model->get_user();
        $data['record'] = $this->User_model->get_satu_user($id)->row_array();
        $data['level_user'] = enums('login_session', 'level');
        $data['jenis_barang'] = $this->Jenis_model->get_approved_jenis()->result_array();
        $this->load->view('login/logout_modal', $data);
        $this->form_validation->set_rules('resetpassword1', 'Reset Password', 'required|trim|min_length[3]|matches[resetpassword2]');
        $this->form_validation->set_rules('resetpassword2', 'Confirm Reset Password', 'required|trim|min_length[3]|matches[resetpassword1]');
        $this->form_validation->set_rules('level', 'Level', 'trim|required');
        if($this->form_validation->run()==false)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/reset_user', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            $data = array(
                'password' => md5($this->input->post('resetpassword1')),
                'level' => $this->input->post('level')
            );
            $this->db->where('id', $id);
            $this->db->update('login_session', $data);
            $this->session->set_flashdata('message',  '<div class="alert alert-success" role="alert"> User berhasil direset </div>');
            redirect('admin/userManagement');
        }
    }

    public function hapusUser($id){
       $this->User_model->delete_user($id);
       $this->session->set_flashdata('message',  '<div class="alert alert-success" role="alert"> User terhapus </div>');
       redirect('admin/userManagement');
    }

    public function pengajuan(){
        $data['title'] = 'Pengajuan Saya';
        $data['submit_barang'] = $this->Barang_model->get_request();
        $data['status_submisi'] = $this->Barang_model->get_status_submisi()->result_array();
        $data['status_terima'] = $this->Barang_model->get_status_terima()->result_array();
        $data['approved_jenis_barang'] = $this->Jenis_model->get_approved_jenis()->result_array();
        $this->load->view('login/logout_modal', $data);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/pengajuanSaya', $data);
        $this->load->view('user/buatPermintaan', $data);
        $this->load->view('templates/footer');
    }
}
?>

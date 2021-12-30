<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Status_terima extends CI_Controller{
    public function __construct(){
        parent::__construct();
        //is_logged_in();
		$this->load->model('Barang_model');
    }
    
     public function getStatusTerima(){
	    $id_status_submisi = $this->input->get('id_status_submisi');
        $dropdownItems = listData('status_terima','id_status_terima', 'nama_status_terima',['where' => ['id_status_submisi' => $id_status_submisi]]);
        $value = $this->input->get('nama_status_terima');
		echo $status_terima_dropdown = form_dropdown('id_status_terima', $dropdownItems, $value, 'class="form-control"');
	}
}
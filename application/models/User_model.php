<?php 
class User_model extends CI_Model{

    public function get_user()
    {
       $username = $this->session->userdata('username');
       $query = $this->db->query("SELECT * FROM login_session WHERE username != '$username' AND username != 'admin' ")->result_array();
       return $query;
    }

    public function insert_user($username, $password, $level)
    {
        $query = $this->db->query("INSERT INTO login_session(username, password, level) VALUES ('$username', '$password', '$level')");
        return $query;
    }

    public function get_satu_user($id){
        $query = array('id' => $id);
        return $this->db->get_where('login_session', $query);
    }

    public function user_logged_in(){
        $query = $this->db->get_where('login_session', array('username' => $this->session->userdata('username')));
        return $query;
    }

    public function get_profile($id){
        $username = $this->session->userdata('username');
        $this->db->where('username', $username);
        $query = $this->db->get('login_session');
        return $query->row();
    }

    public function delete_user($id){
        $this->db->where('id', $id);
        $this->db->delete('login_session');
    }
    
    public function check_old_password(){
         $username = $this->session->userdata('username');
         $query = $this->db->query("SELECT password FROM login_session WHERE username = '$username' ");
         return $query;
    }
}
?>
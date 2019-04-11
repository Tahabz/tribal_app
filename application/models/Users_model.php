<?php

class Users_model extends CI_Model{

    public function __construct(){
        $this->load->database();
    }

    public function login($username, $password){
        $this->db->where('name', $username);
        $this->db->where('password', $password);
        $result = $this->db->get('users');
        //return $result->row_array();
        if($result->num_rows() == 1){
            return $result->row(0)->id_user;
            //return $result->row(0)->id;
        } else {
            return false;
            //return false;
        }
    }

    public function get_user_role($user_id){
        $this->db->where('id_user', $user_id);
        $result = $this->db->get('users');
        return $result->row(0)->role;
    }

    public function add_leave(){
        $id = $this->session->userdata('user_id');
        $username = $this->session->userdata('username');
        $roleDegree = $this->session->userdata('role') + 1;
        $data = array(
            'id_user' => $id,
            'name_user' => $username,
            'role_degree' => $roleDegree
        );
        return $this->db->insert('conge', $data);
    }
}
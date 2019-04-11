<?php

class Manager_model extends CI_Model{



    public function __construct(){
        $this->load->database();
    }

    public function get_leave_requests(){
        $this->db->get('users');
        $this->db->join('manager', 'manager.id_user = users.id_user');
        $this->db->where('manager.id_user', $this->session->userdata('user_id'));
        $manager = $this->db->get('users');
        $sqlquery = $this->db->query('SELECT conge.* FROM team
        JOIN users ON users.team_id = team.team_id
        JOIN conge ON conge.id_user = users.id_user
        WHERE conge.role_degree = 2
            AND conge.team_chef_response = "Accepted"
            AND conge.manager_response IS NULL
            AND team.manager_id = 2
                                    ');
        return $sqlquery->result_array();
    }
    public function decline($id){
        $this->db->where('id_conge', $id);
        $data = array(
            'manager_response' => 'Declined'
        );
        return $this->db->update('conge', $data);
    }
    
    public function accept($id){
     
        $this->db->where('id_conge', $id);
        $data = array(
            'manager_response' => 'Accepted',
            'role_degree' => 3
        );
        return $this->db->update('conge', $data);
    }
    
}


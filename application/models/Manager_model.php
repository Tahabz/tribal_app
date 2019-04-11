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
        $id_manager = $manager->row()->id_manager;
        $sqlquery = $this->db->query('SELECT conge.* FROM team
        JOIN users ON users.team_id = team.team_id
        JOIN conge ON conge.id_user = users.id_user
        WHERE conge.role_degree = 2
            AND conge.team_chef_response = "Accepted"
            AND conge.manager_response IS NULL
            AND team.manager_id = '.$id_manager.'
                                    ');
        return $sqlquery->result_array();
    }
    public function decline($id_conge, $id_user){
        $this->db->get('users');
        $this->db->join('manager', 'manager.id_user = users.id_user');
        $this->db->where('manager.id_user', $this->session->userdata('user_id'));
        $manager = $this->db->get('users');
        $id_manager = $manager->row()->id_manager;

        $sqlquery = $this->db->query('SELECT DISTINCT team.manager_id FROM team
        JOIN users ON users.team_id = team.team_id
        JOIN conge ON conge.id_user = users.id_user
        WHERE conge.role_degree = 2
            AND conge.team_chef_response = "Accepted"
            AND conge.manager_response IS NULL
            AND conge.id_user = ' .$id_user. '
            ');
        
        if(empty($sqlquery->row())){
            return false;
        }
        $sqlquery = $sqlquery->row()->manager_id;

        if($id_manager != $sqlquery){
            return false;
        }
        $this->db->where('id_conge', $id_conge);  
        $data = array(
            'manager_response' => 'Declined'
        );
        $this->db->update('conge', $data);
        return true;
    }
    
    public function accept($id_conge, $id_user){
        $this->db->get('users');
        $this->db->join('manager', 'manager.id_user = users.id_user');
        $this->db->where('manager.id_user', $this->session->userdata('user_id'));
        $manager = $this->db->get('users');
        $id_manager = $manager->row()->id_manager;

        $sqlquery = $this->db->query('SELECT DISTINCT team.manager_id FROM team
        JOIN users ON users.team_id = team.team_id
        JOIN conge ON conge.id_user = users.id_user
        WHERE conge.role_degree = 2
            AND conge.team_chef_response = "Accepted"
            AND conge.manager_response IS NULL
            AND conge.id_user = ' .$id_user. '
            ');
        
        if(empty($sqlquery->row())){
            return false;
        }
        $sqlquery = $sqlquery->row()->manager_id;

        if($id_manager != $sqlquery){
            return false;
        }
        $this->db->where('id_conge', $id_conge);
        $data = array(
            'manager_response' => 'Accepted',
            'role_degree' => 3
        );
        return $this->db->update('conge', $data);
    }
    
}


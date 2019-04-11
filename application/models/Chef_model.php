<?php

class Chef_model extends CI_Model{



    public function __construct(){
        $this->load->database();
    }

    public function get_leave_requests(){

        $chef = $this->session->userdata('user_id');
        $sqlquery = $this->db->query('SELECT conge.* FROM team
                                        JOIN users ON users.team_id = team.team_id
                                        JOIN conge ON conge.id_user = users.id_user
                                        WHERE conge.role_degree = 1 
                                            AND conge.team_chef_response IS NULL
                                            AND team.chef = '.$chef.'
                                    ');
        return $sqlquery->result_array();
    }

    public function decline($id){
        $this->db->where('id_conge', $id);
        $data = array(
            'team_chef_response' => 'Declined'
        );
        return $this->db->update('conge', $data);
    }
    
    public function accept($id){
     
        $this->db->where('id_conge', $id);
        $data = array(
            'team_chef_response' => 'Accepted',
            'role_degree' => 2
        );
        return $this->db->update('conge', $data);
    }
}
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

    public function decline($id_conge, $id_user){
        $this->db->get('users');
        $this->db->join('team', 'team.chef = users.id_user');
        $this->db->where('team.chef', $this->session->userdata('user_id'));
        $chef = $this->db->get('users');
        $id_chef = $chef->row()->chef;

        $sqlquery = $this->db->query('SELECT DISTINCT team.chef FROM team
                                        JOIN users ON users.team_id = team.team_id
                                        JOIN conge ON conge.id_user = users.id_user
                                        WHERE conge.role_degree = 1 
                                            AND conge.team_chef_response IS NULL
                                            AND conge.id_user = ' .$id_user. '
                                    ');

        if(empty($sqlquery->row())){
            return false;
        }
        $sqlquery = $sqlquery->row()->chef;

        if($id_chef != $sqlquery){
            return false;
        }

        $this->db->where('id_conge', $id_conge);
        $data = array(
            'team_chef_response' => 'Declined'
        );
        return $this->db->update('conge', $data);
    }
    
    public function accept($id_conge, $id_user){
        $this->db->get('users');
        $this->db->join('team', 'team.chef = users.id_user');
        $this->db->where('team.chef', $this->session->userdata('user_id'));
        $chef = $this->db->get('users');
        $id_chef = $chef->row()->chef;

        $sqlquery = $this->db->query('SELECT DISTINCT team.chef FROM team
                                        JOIN users ON users.team_id = team.team_id
                                        JOIN conge ON conge.id_user = users.id_user
                                        WHERE conge.role_degree = 1 
                                            AND conge.team_chef_response IS NULL
                                            AND conge.id_user = ' .$id_user. '
                                    ');

        if(empty($sqlquery->row())){
            return false;
        }
        $sqlquery = $sqlquery->row()->chef;

        if($id_chef != $sqlquery){
            return false;
        }
        $this->db->where('id_conge', $id_conge);
        $data = array(
            'team_chef_response' => 'Accepted',
            'role_degree' => 2
        );
        return $this->db->update('conge', $data);
    }
}
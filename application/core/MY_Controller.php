<?php

class MY_Controller extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
    }

    public function salariedRole($user_logged, $username, $role){
        $user_data = array(
                        'user_id' => $user_logged,
                        'username' => $username,
                        'role' => $role,
                        'logged_in' => true
                    );
        
        $this->session->set_userdata($user_data);
        $this->session->set_flashdata('salaried', 'you are now logged in as salaried'); 
        redirect('salaried');
    }
    public function team_chefRole($user_logged, $username, $role){
        $user_data = array(
                        'user_id' => $user_logged,
                        'username' => $username,
                        'role' => $role,
                        'logged_in' => true
                    );       
        $this->session->set_userdata($user_data);
        $this->session->set_flashdata('chef', 'you are now logged in as salaried'); 
        redirect('chef');
    }
    public function managerRole($user_logged, $username, $role){
        $user_data = array(
                        'user_id' => $user_logged,
                        'username' => $username,
                        'role' => $role,
                        'logged_in' => true
                    );       
        $this->session->set_userdata($user_data);
        $this->session->set_flashdata('manager', 'you are now logged in as salaried'); 
        redirect('manager');
    }
}
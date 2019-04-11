<?php

class Salaried extends CI_Controller{
    function __construct()
    {
        // this is your constructor
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
    }
    public function index(){

        $role = $this->session->userdata('role');
        if($role != 0){
            if($role == 1){
                redirect('chef');
            }
            elseif($role == 2){
                redirect('manager');
            }           
        }
        else{
            redirect('conge');
            // $this->session->unset_userdata('logged_in');
            // $this->session->unset_userdata('user_id');
            // $this->session->unset_userdata('username');
        }
    }
}
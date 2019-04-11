<?php

class Team_chef extends CI_Controller{
    function __construct()
    {
        // this is your constructor
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->model('Chef_model');
    }

    public function index(){
        $role = $this->session->userdata('role');
        if(!$role == 1){
            if($role == 0){
                redirect('salaried');
            }
            elseif($role == 2){
                redirect('manager/dashboard');
            }           
        }
        else{
            redirect('chef/dashboard');
        }
    }

    public function show(){
        $role = $this->session->userdata('role');
        if(!$role == 1){
            redirect('404');
        }
        $data['leaves'] = $this->Chef_model->get_leave_requests();
        $this->load->view('templates/header');
        $this->load->view('chefEquipe/dashboard', $data);
        $this->load->view('templates/footer');
    }

    public function decline($id){
        $role = $this->session->userdata('role');
        if(!$role == 1){
            redirect('404');
        }
        $this->Chef_model->decline($id);
        $this->session->set_flashdata('demand_declined', 'leave demand declined!');
        redirect('chef/dashboard');
    }

    public function accept($id){
        $role = $this->session->userdata('role');
        if(!$role == 1){
            redirect('404');
        }
        $this->Chef_model->accept($id);
        $this->session->set_flashdata('demand_accepted', 'leave demand accepted!');
        redirect('chef/dashboard');
    }

}
<?php

class Manager extends CI_Controller{
    function __construct()
        {
            // this is your constructor
            parent::__construct();
            $this->load->helper('form');
            $this->load->helper('url');
            $this->load->model('Manager_model');
        }


    public function index(){
        $role = $this->session->userdata('role');
        if($role != 2){
            if($role == 0){
                redirect('chef');
            }
            elseif($role == 1){
                redirect('manager');
            }           
        }
        else{
            redirect('manager/dashboard');
        }
    }

    public function show(){
        $role = $this->session->userdata('role');
        if(!$role == 2){
            redirect('404');
        }
        $data['leaves'] = $this->Manager_model->get_leave_requests();
        // print_r($data);
        // die();
        $this->load->view('templates/header');
        $this->load->view('managers/dashboard', $data);
        $this->load->view('templates/footer');
    }

    public function decline($id){
        $role = $this->session->userdata('role');
        if(!$role == 2){
            redirect('404');
        }
        $this->Manager_model->decline($id);
        $this->session->set_flashdata('demand_declined', 'leave demand declined!');
        redirect('manager/dashboard');
    }

    public function accept($id){
        $role = $this->session->userdata('role');
        if(!$role == 2){
            redirect('404');
        }
        $this->Manager_model->accept($id);
        $this->session->set_flashdata('demand_accepted', 'leave demand accepted!');
        redirect('manager/dashboard');
    }
}
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

    public function decline(){
        $id_conge = $this->input->post('id_conge');
        $id_user = $this->input->post('id_user');
        $role = $this->session->userdata('role');
        if(!$role == 2){
            redirect('404');
        }
        if($this->Manager_model->decline($id_conge, $id_user)){
            $this->session->set_flashdata('demand_declined', 'leave demand declined!');
            redirect('manager/dashboard');
        }
        else{
            redirect('404');
        }
    }

    public function accept($id_conge, $id_user){
        // echo 'conge : '.$id_conge. '  user: '.$id_user;
        // die();
        $role = $this->session->userdata('role');
        if(!$role == 2){
            redirect('404');
        }
        if($this->Manager_model->accept($id_conge, $id_user)){
            $this->session->set_flashdata('demand_accepted', 'leave demand accepted!');
            redirect('manager/dashboard');
        }
        else{
            redirect('404');
        }
    }
}
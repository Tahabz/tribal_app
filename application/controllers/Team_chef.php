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

    public function decline(){
        $id_conge = $this->input->post('id_conge');
        $id_user = $this->input->post('id_user');

        // echo 'conge : '.$id_conge. '  user: '.$id_user;
        // die();

        $role = $this->session->userdata('role');
        if(!$role == 1){
            redirect('404');
        }
        if($this->Chef_model->decline($id_conge, $id_user)){
            $this->session->set_flashdata('demand_declined', 'leave demand declined!');
            redirect('chef/dashboard');
        }
        else{
            redirect('404');
        }
    }

    public function accept($id_conge, $id_user){
        $role = $this->session->userdata('role');
        if(!$role == 1){
            redirect('404');
        }
        if($this->Chef_model->accept($id_conge, $id_user)){
            $this->session->set_flashdata('demand_accepted', 'leave demand accepted!');
            redirect('chef/dashboard');
        }
        else{
            redirect('404');
        }
    }

}
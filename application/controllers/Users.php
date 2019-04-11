<?php

class Users extends MY_Controller{

    function __construct()
    {
        // this is your constructor
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
    }

    public function show(){
        $role = $this->Users_model->get_user_role($user_logged);
        if($role == 0){
            redirect('salaried');
        }
        elseif($role == 1){
            redirect('chef/dashboard');
        }
        elseif($role == 2){
            redirect('manager/dashboard');
        }
    }

    public function index(){
        if($this->session->userdata('role') !== ""){
            $this->load->view('templates/header');
            $this->load->view('sharedPages/index');
            $this->load->view('templates/footer');
        }
        else{
            redirect('login');
        }
    }
    public function login(){
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Confirm Pasword', 'required');

        if($this->form_validation->run() === FALSE){
            $this->load->view('templates/header');
            $this->load->view('users/login');
            $this->load->view('templates/footer');
        }else{
                $username = $this->input->post('username');
                $password = $this->input->post('password');

                $this->load->model('Users_model');
                $user_logged = $this->Users_model->login($username, $password);
                // print_r($user_logged);
                // die();

                if($user_logged){
                    
                    $role = $this->Users_model->get_user_role($user_logged);
                    if($role == 0){
                        $this->salariedRole($user_logged, $username, $role);
                    }
                    elseif($role == 1){
                        $this->team_chefRole($user_logged, $username, $role);
                    }
                    elseif($role == 2){
                        $this->managerRole($user_logged, $username, $role);
                    }
                }
                else{
                    $this->session->set_flashdata('login_failed', 'Login details are invalid');
                    redirect('login');
                } 
            }
    }

    public function conge(){
        $this->load->model('Users_model');
        $result = $this->Users_model->add_leave();
        if($result){
            $this->session->set_flashdata('RequestSent', 'your request is sent');
            $role = $this->session->userdata('role');
            if($role == 0){
                redirect('salaried');
            }
            elseif($role == 1){
                redirect('chef');
            }
            elseif($role == 2){
                redirect('manager');
            }
            else{
                redirect('login');
            }          
        }
        else{
            $this->session->set_flashdata('RequestNotSent', 'There was a problem with your request');
            redirect('');
        }
    }
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ramalses extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->model('User_model');
        $this->load->model('Alpha_model');
        $this->load->model('Ramal_model');
		is_logged_in();
    }
	public function index()
	{
		$data['nama'] = "Ramal Masa Depan";
		$id_user=$this->session->userdata('id_user');
        $data['user']=$this->User_model->get_user($id_user);

		$this->form_validation->set_rules('alpha', 'Alpha', 'required');
	
        $this->load->view('Templates/header.php', $data);
        $this->load->view('Templates/navbar.php', $data);
        $this->load->view('Templates/leftmenu.php', $data);
        $this->load->view('Ramal_SES/index.php', $data);
        $this->load->view('Templates/footer.php', $data);
        
    }
    public function ramal()
	{
        $bulan=(integer) $this->input->post('bulan', true);
        echo($bulan);
         $this->Ramal_model->add_ramal_des($bulan);
    
        $this->session->set_flashdata('flash', 'Sukses');
        $this->session->set_flashdata('data', 'Ramalan Masa Depan');
        redirect('hasildes');
        
    }
}
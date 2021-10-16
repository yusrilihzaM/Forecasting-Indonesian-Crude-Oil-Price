<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hasilses extends CI_Controller {


	public function __construct()
    {
        parent::__construct();
		$this->load->model('User_model');
        $this->load->model('Hasil_forecast_model');
        $this->load->model('Ramal_model');
		is_logged_in();
    }
	public function index()
	{
		$data['nama'] = "Hasil Single Exponential Smooting";
		$id_user=$this->session->userdata('id_user');
        $data['user']=$this->User_model->get_user($id_user);
        $data['at']=$this->Hasil_forecast_model->get_ses_minyak();
        $data['ft']=$this->Hasil_forecast_model->get_ses_hasil();
        $data['bulan']=$this->Hasil_forecast_model->get_label_bawah();
        $data['hitung_ses']=$this->Hasil_forecast_model->get_all_ses();
        $data['hitung_ses1']=$this->Hasil_forecast_model->get_all_ses();
        $data['MAPE']=$this->Hasil_forecast_model->get_mape_ses();
        $data['ramal_ses']=$this->Ramal_model->get_ramal_ses();
        // var_dump($data['ramal_ses']);
        // die;
        $this->load->view('Templates/header.php', $data);
        $this->load->view('Templates/navbar.php', $data);
        $this->load->view('Templates/leftmenu.php', $data);
        $this->load->view('Hasil_SES/index.php', $data);
		$this->load->view('Templates/footer.php', $data);
	
    }
   
}
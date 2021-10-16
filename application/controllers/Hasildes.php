<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hasildes extends CI_Controller {


	public function __construct()
    {
        parent::__construct();
		$this->load->model('User_model');
        $this->load->model('Hasil_forecast_model');
		is_logged_in();
    }
	public function index()
	{
		$data['nama'] = "Hasil Single Exponential Smooting";
		$id_user=$this->session->userdata('id_user');
        $data['user']=$this->User_model->get_user($id_user);
        $data['at']=$this->Hasil_forecast_model->get_des_minyak();
      
        $data['ft']=$this->Hasil_forecast_model->get_des_hasil();
        $data['bulan']=$this->Hasil_forecast_model->get_label_bawah();
        $data['hitung_des']=$this->Hasil_forecast_model->get_all_des();
        $data['hitung_des1']=$this->Hasil_forecast_model->get_all_des();
        $data['MAPE']=$this->Hasil_forecast_model->get_mape_des();
        $data['ramal_des']=$this->Hasil_forecast_model->get_masa_depan_des();
       
        $this->load->view('Templates/header.php', $data);
        $this->load->view('Templates/navbar.php', $data);
        $this->load->view('Templates/leftmenu.php', $data);
        $this->load->view('Hasil_DES/index.php', $data);
		$this->load->view('Templates/footer.php', $data);
	
	}
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Minyak extends CI_Controller {


	public function __construct()
    {
        parent::__construct();
		$this->load->model('User_model');
        $this->load->model('Alpha_model');
        $this->load->model('Data_minyak_model');
		is_logged_in();
    }
    public function index()
	{

		$data['data_minyak']=$this->Data_minyak_model->get_all_data_minyak();
		$id_user=$this->session->userdata('id_user');
        $data['user']=$this->User_model->get_user($id_user);
	
		$data['nama'] = "Data Minyak Mentah";
		
        $this->load->view('Templates/header.php',$data);
        $this->load->view('Templates/navbar.php',$data);
        $this->load->view('Templates/leftmenu.php',$data);
        $this->load->view('Minyak/index.php',$data);
        $this->load->view('Templates/footer.php',$data);
    }
    public function tambah_minyak()
	{
	
		$data['data_minyak']=$this->Data_minyak_model->get_all_data_minyak();
		$id_user=$this->session->userdata('id_user');
        $data['user']=$this->User_model->get_user($id_user);
        $data['nama'] = "Tambah Data Minyak Mentah";
        $this->form_validation->set_rules('jumlah_minyak', 'jumlah_minyak', 'required');
        $this->form_validation->set_rules('bulan_tahun', 'bulan_tahun', 'required');
		if ($this->form_validation->run() == false) {
        $this->load->view('Templates/header.php',$data);
        $this->load->view('Templates/navbar.php',$data);
        $this->load->view('Templates/leftmenu.php',$data);
        $this->load->view('Minyak/tambah_minyak.php',$data);
        $this->load->view('Templates/footer.php',$data);
        }else{
         
		 
		$bulan_tahun=date($this->input->post('bulan_tahun', true));
		$jumlah_minyak=date($this->input->post('jumlah_minyak', true));
		$bulan=(integer)date("m",strtotime($bulan_tahun));
		$tahun=date("Y",strtotime($bulan_tahun));
		$jumlah_minyak=$this->input->post('jumlah_minyak', true);
		// echo($bulan);
		// echo($tahun);
        // echo($bulan_tahun);
        // die;
		$this->Data_minyak_model->add_data_minyak($tahun,$bulan,$jumlah_minyak);
		$this->session->set_flashdata('flash', 'Ditambahkan');
		$this->session->set_flashdata('data', 'Data minyak');

		redirect('minyak');
        }
    }
    public function hapus_minyak($id)
	{
	
		$this->Data_minyak_model->hps_data_minyak($id);
		$this->session->set_flashdata('flash', 'dihapus');
        $this->session->set_flashdata('data', 'Data Minyak');
	
		redirect('minyak');
    }
    public function edit_minyak($id)
	{
	
		$data['data_minyak']=$this->Data_minyak_model->get_data_minyak_byid($id);
		$id_user=$this->session->userdata('id_user');
        $data['user']=$this->User_model->get_user($id_user);
        $data['nama'] = "Edit Minyak Mentah";
   
        $this->load->view('Templates/header.php',$data);
        $this->load->view('Templates/navbar.php',$data);
        $this->load->view('Templates/leftmenu.php',$data);
        $this->load->view('Minyak/edit_minyak.php',$data);
        $this->load->view('Templates/footer.php',$data);
       }
        public function save_edit()
        {
            $id_data_minyak=date($this->input->post('id_data_minyak', true));
            $bulan=date($this->input->post('bulan', true));
            $tahun=date($this->input->post('tahun', true));
		    $jumlah_minyak=date($this->input->post('jumlah_minyak', true));
            $this->Data_minyak_model->update_data_minyak($id_data_minyak,$jumlah_minyak,$tahun,$bulan);
            $this->session->set_flashdata('flash', 'Diupdate');
            $this->session->set_flashdata('data', 'Data Minyak');
            redirect('minyak');
        }
}
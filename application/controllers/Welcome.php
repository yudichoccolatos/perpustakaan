<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->load->view('login');
	}
	
	function login(){
		$username = $this->input->post('admin_username');
		$password =$this->input->post('admin_password');
		$this->form_validation->set_rules('admin_username','username','trim|required');
		$this->form_validation->set_rules('admin_password','password','trim|required');

		if($this->form_validation->run() != false){
			$where = array('username' => $username,'password'=> md5($password));
			$data = $this->m_perpus->edit_data($where,'admin');
			$d = $this->m_perpus->edit_data($where,'admin')->row();
			$cek = $data->num_rows();

			if($cek > 0){
				$session = array('id'=> $d->id_admin,'nama'=> $d->nama_admin,'status'=>'login');
				$this->session->set_userdata($session);
				redirect(base_url().'admin');
			}else{
				$this->session->set_flashdata('alert','Username atau Password Anda Salah !');
				redirect(base_url().'welcome?pesan=gagal');
			}
			
		}else{
			$this->session->set_flashdata('alert','anda belum mengisi username atau password.');
			$this->load->view('login');
		}
	}
}
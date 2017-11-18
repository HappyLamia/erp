<?php 	
	error_reporting(1);
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Landing extends CI_Controller
	{
		public function index()
		{
			redirect('admin-page/home');
		}
		public function login()
		{
			$data = array('username' => $this->input->post('username'),
						  'password' => md5($this->input->post('password'))
				         );
			$x = $this->Mod_Query->get_where('num_rows','user',$data);
			if ($x > 0) {
				$row = $this->Mod_Query->get_where('row','user',$data);
				$session = array('logged_in' => TRUE,
								 'username' => $row->username,
								 'level' => $row->otoritas
								);
				$this->session->set_userdata($session);
				//$this->set_log('Login');
				redirect('admin-page/');
			}
			else{
				set_alert('login_alert',4);
				redirect('admin-page/');
			}
		}
		public function logout()
		{
			if ($this->session->userdata('logged_in')) {
				$this->session->sess_destroy();
				redirect('admin-page/');
			} else {
				redirect('admin-page/');
			}
		}		
	}
?>
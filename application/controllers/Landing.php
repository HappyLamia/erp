<?php 	
	error_reporting(1);
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Landing extends CI_Controller
	{
		public function index()
		{
			redirect('admin-page/home');
		}
		public function set_alert($value)
		{
			$this->session->set_flashdata('login_alert',$value);
		}
		public function set_log($value)
		{
			$data = array('username' => $this->session->userdata('username'),
						  'aktifitas' => $value
				         );
			$this->Mod_Query->add('log',$data);
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
				$msg = "<div class='alert alert-warning alert-dismissable'>
						    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						    <strong>Warning!</strong> Invalid Account , Please Input The Correct Account
						  </div>";
				$this->set_alert($msg);
				redirect('admin-page/');
			}
		}
		public function logout()
		{
			if ($this->session->userdata('dewa_logged_in')) {
				$this->session->sess_destroy();
				redirect('admin-page/');
			} else {
				redirect('admin-page/');
			}
		}		
	}
?>
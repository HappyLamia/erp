<?php 
	/**
	* 
	*/
	class Test extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->library('session');
		}
		public function index($value='')
		{
			$this->session->set_userdata(array('flow' => 'River'));
			echo $this->session->userdata('flow');
		}
		function test_alert()
		{
			echo alert('test_msg',3);
		}
	}
?>
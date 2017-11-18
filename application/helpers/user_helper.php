<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	if ( ! function_exists('user'))
	{
		function get_user()
		{
			$CI = & get_instance();  //get instance, access the CI superobject
			$username = $CI->session->userdata('username');
			return $username;
		}

	}
?>
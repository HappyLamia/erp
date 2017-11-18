<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	if ( ! function_exists('alert'))
	{
		function set_alert($name,$type)
		{
			$CI = & get_instance();  //get instance, access the CI superobject
			if ($type==1) {
				$msg = "<div class='alert alert-info alert-dismissable'>
					    	<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					    	<strong class='fa fa-check'> Record Ditambah</strong> 
					    </div>";
			}
			elseif($type==2){
				$msg = "<div class='alert alert-warning alert-dismissable'>
					    	<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					    	<strong class='fa fa-check'> Record Diperbaharui</strong> 
					    </div>";
			}
			elseif($type==3){
				$msg = "<div class='alert alert-danger alert-dismissable'>
					    	<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
					    	<strong class='fa fa-check'> Record Dihapus</strong> 
					    </div>";
			}
			else{
				$msg = "<div class='alert alert-warning alert-dismissable'>
						    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						    <strong>Warning!</strong> Login Gagal, Inputkan Akun Yang Sudah Terdaftar
						  </div>";
			}
			$CI->session->set_flashdata($name,$msg);
			// $alert = $CI->session->flashdata($name);
			// return $alert;
		}
		function get_alert($name)
		{
			$CI = & get_instance();  //get instance, access the CI superobject
			$alert = $CI->session->flashdata($name);
			return $alert;
		}

	}
?>
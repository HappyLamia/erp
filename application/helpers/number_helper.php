<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	if ( ! function_exists('number'))
	{
		function numb1($char,$value)
		{
			$counts = $value;
			$no = $counts + 1;
			if ($counts < 9) {
				$concat = $char.'-'.'0000'.$no;
			}
			elseif ($counts < 99) {
				$concat = $char.'-'.'000'.$no;
			}
			elseif ($counts < 999) {
				$concat = $char.'-'.'00'.$no;
			}
			elseif ($counts < 9999) {
				$concat = $char.'-'.'0'.$no;
			}
			elseif ($counts < 99999) {
				$concat = $char.'-'.$no;
			}
			return $concat;
			// $alert = $CI->session->flashdata($name);
			// return $alert;
		}
		function numb2($char,$value,$value2)
		{
			$tgl = $value2;
			$counts = $value;
			$no = $counts + 1;
			if ($counts < 9) {
				$concat = $char.'-'.$tgl.'-0000'.$no;
			}
			elseif ($counts < 99) {
				$concat = $char.'-'.$tgl.'-000'.$no;
			}
			elseif ($counts < 999) {
				$concat = $char.'-'.$tgl.'-00'.$no;
			}
			elseif ($counts < 9999) {
				$concat = $char.'-'.$tgl.'-0'.$no;
			}
			elseif ($counts < 99999) {
				$concat = $char.'-'.$tgl.'-'.$no;
			}
			return $concat;
		}

	}
?>
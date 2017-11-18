<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_Number extends CI_Model
	{
		public function get_kode1($table)
		{
			$cmd = "SELECT COUNT(*) AS counts FROM $table";
			$query = $this->db->query($cmd);
			return $query->row();
		}
		public function get_kode2($table,$field)
		{
			$cmd = "SELECT COUNT(*) AS counts, DATE(NOW()) AS tgl FROM $table WHERE DATE($field) = DATE(NOW())";
			$query = $this->db->query($cmd);
			return $query->row();
		}
		public function set_log($user,$action,$host,$target='')
		{
			$data = array('user' => $user,
						  'action' => $action,
						  'target_host' => $host,
						  'target' => $target
						 );
			$query = $this->db->insert('log',$data);
			return $query;
		}
		public function check($user,$action)
		{
			$data = array('user' => $user,
						  'action' => $action
						 );
			$query = $this->db->insert('log',$data);
			return $query;
		}
	}
?>
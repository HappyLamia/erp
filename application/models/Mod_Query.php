<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_Query extends CI_Model
	{
		
		public function add($table_name,$data)
		{
			$query = $this->db->insert($table_name,$data);
			return $query;
		}
		public function clear_by($table_name,$data)
		{
			$query = $this->db->delete($table_name,$data);
			return $query;
		}
		public function clear_all($table_name)
		{
			$query = $this->db->empty_table($table_name);
			return $query;
		}
		public function renew($table_name,$data,$by)
		{
			$query = $this->db->update($table_name,$data,$by);
			return $query;
		}
		public function get_where($ctrl,$table_name,$data,$limit='',$field='',$direct='')
		{
			$query = $this->db->limit($limit)->order_by($field,$direct)->get_where($table_name,$data);
			switch ($ctrl) {
				case 'row':
					return $query->row();
					break;
				case 'num_rows':
					return $query->num_rows();
					break;
				case 'result':
					return $query->result();
					break;
				default:
					echo "Undefined Function";
					break;
			}
		}
		public function get($ctrl,$table_name,$limit='',$field='',$direct='')
		{
			$query = $this->db->limit($limit)->order_by($field,$direct)->get($table_name);
			switch ($ctrl) {
				case 'row':
					return $query->row();
					break;
				case 'num_rows':
					return $query->num_rows();
					break;
				case 'result':
					return $query->result();
					break;
				default:
					echo "Undefined Function";
					break;
			}
		}
		public function get_query($ctrl,$cmd)
		{
			$query = $this->db->query($cmd);
			switch ($ctrl) {
				case 'row':
					return $query->row();
					break;
				case 'num_rows':
					return $query->num_rows();
					break;
				case 'result':
					return $query->result();
					break;
				case 'this':
					return $query;
					break;
				default:
					echo "Undefined Function";
					break;
			}
		}
	}
?>
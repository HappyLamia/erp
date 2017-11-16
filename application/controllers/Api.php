<?php 
	error_reporting(1);
	class Api extends CI_Controller
	{
		public function get_api_user()
		{
			$username = 'admin'; //$this->input->post('username')
			$password = md5('admin'); //md5($this->input->post('password'))
			$data = array('username' => $username ,
						  'password' => $password
				         );
			$x = $this->Mod_Query->get_where('num_rows','user',$data);
			if ($x > 0) {
				$row = $this->Mod_Query->get_where('row','user',$data);
				$list = array();
				$data = array('logged_in' => TRUE,
							 'username' => $row->username,
							 'name' => $row->name,
							 'email' => $row->email,
							 'kontak' => $row->kontak,
							 'level' => $row->otoritas
							);
				array_push($list, $data);
				echo json_encode($list);
				//$this->set_log('Login');
				//redirect('admin-page/');
			}
			else{
				redirect('admin-page/');
			}
		}
		public function get_api_salesman()
		{
				$list = array();
				//$data = array('status' => 'Aktif');
				$x= $this->Mod_Query->get('result','v_tracker');
				foreach ($x as $key) {
					$arr = array('kode_sales' => $key->kode_sales,
							 	  'nama_sales' => $key->nama_sales,
							 	  'tujuan' => $key->nama,
								  'alamat' => $key->alamat,
								  'nama' => $key->nama,
							);
					array_push($list, $arr);
				}
				
				echo json_encode($list);
		}
		// public function get_api_customer($value='')
		// {
		// 	# code...
		// }
		// public function get_api_piutang($value='')
		// {
		// 	# code...
		// }
	}
?>
<?php 
	error_reporting(1);
	class Salesman extends CI_Controller
	{
		public function set_log($value)
		{
			$data_log = array('id_user' => $this->session->userdata('id_user'),
								 'aktifitas' => $value
								);
			$this->Mod_Query->add('log',$data_log);
		}
		public function set_alert($value)
		{
			$this->session->set_flashdata('salesman_alert', $value);
		}
		function add(){
			if ($this->session->userdata('logged_in')) {
				$data = array('kode_sales' => $this->input->post('kode_sales'),
							  'nama_sales' => $this->input->post('nama_sales'),
							  'kontak' => $this->input->post('kontak'),
							  'alamat' => $this->input->post('alamat')
							);
				$x = $this->Mod_Query->add('salesman',$data);
				if ($x > 0) {
					//$this->set_log('Menambah Data Salesman');
					$this->set_alert("<div class='alert alert-info alert-dismissable'>
										    	<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
										    	<strong class='fa fa-check'> Data Telah Ditambah </strong> 
										    </div>");
					redirect('admin-page/master/salesman');
				}
				else{
					redirect('admin-page/master/salesman');
				}
			}
		}
		function delete($value){
			if ($this->session->userdata('logged_in')) {
				$by = array('kode_sales' => $value);
				$data = array('status' => 'Tidak Aktif');
				$x = $this->Mod_Query->renew('salesman',$data,$by);
				if ($x > 0) {
					$this->set_log('Menghapus Data salesman');
					$this->set_alert("<div class='alert alert-success alert-dismissable'>
										    	<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
										    	<strong class='fa fa-check'> Data Telah Dihapus </strong> 
										    </div>");
					redirect('main/index/penjualan/');
				}
				else{
					redirect('main/index/penjualan/');
				}
			}
		}
		function ubah_salesman(){
			if ($this->session->userdata('logged_in')) {
				$by = array('id_salesman' => $this->input->post('kode_salesman'));
				$data = array('nama' => $this->input->post('nama_salesman'),
							  'tgl_lhr' => $this->input->post('tgl_lahir'),
							  'alamat' => $this->input->post('alamat'),
							  'asal_daerah' => $this->input->post('asal_daerah')
							);
				$x = $this->Mod_Query->renew('salesman',$data,$by);
				if ($x > 0) {
					$this->set_log('Mengatur Diskon');
					$this->set_alert("<div class='alert alert-success alert-dismissable'>
										    	<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
										    	<strong class='fa fa-check'> Data Telah Diperbaharui </strong> 
										    </div>");
					redirect('main/index/penjualan/');
				}
				else{
					redirect('main/index/penjualan/');
				}
			}
		}
	}
?>
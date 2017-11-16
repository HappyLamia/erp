<?php 
	error_reporting(1);
	class Gudang extends CI_Controller
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
			$this->session->set_flashdata('customer_alert', $value);
		}
		function tambah_customer(){
			if ($this->session->userdata('logged_in')) {
				$data = array('id_customer' => $this->input->post('kode_customer'),
							  'nama' => $this->input->post('nama_customer'),
							  'tgl_lhr' => $this->input->post('tgl_lahir'),
							  'alamat' => $this->input->post('alamat'),
							  'asal_daerah' => $this->input->post('asal_daerah')
							);
				$x = $this->Mod_Query->add('customer',$data);
				if ($x > 0) {
					$this->set_log('Menambah Data Customer');
					$this->set_alert("<div class='alert alert-info alert-dismissable'>
										    	<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
										    	<strong class='fa fa-check'> Data Telah Ditambah </strong> 
										    </div>");
					redirect('main/index/penjualan/');
				}
				else{
					redirect('main/index/penjualan/');
				}
			}
		}
		function hapus_customer($value){
			if ($this->session->userdata('logged_in')) {
				$by = array('id_customer' => $value);
				$data = array('status' => 'Tidak Aktif');
				$x = $this->Mod_Query->renew('customer',$data,$by);
				if ($x > 0) {
					$this->set_log('Menghapus Data Customer');
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
		function ubah_customer(){
			if ($this->session->userdata('logged_in')) {
				$by = array('id_customer' => $this->input->post('kode_customer'));
				$data = array('nama' => $this->input->post('nama_customer'),
							  'tgl_lhr' => $this->input->post('tgl_lahir'),
							  'alamat' => $this->input->post('alamat'),
							  'asal_daerah' => $this->input->post('asal_daerah')
							);
				$x = $this->Mod_Query->renew('customer',$data,$by);
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
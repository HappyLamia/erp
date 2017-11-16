<?php 
	error_reporting(1);
	/**
	* 
	*/
	class Supplier extends CI_Controller
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
			$this->session->set_flashdata('supplier_alert', $value);
		}
		function tambah_supplier(){
			if ($this->session->userdata('logged_in')) {
				$data = array('id_supplier' => $this->input->post('kode_supplier'),
							  'nama' => $this->input->post('nama_supplier'),
							  'alamat' => $this->input->post('alamat'),
							  'asal_daerah' => $this->input->post('asal_daerah'),
							  'kontak_supplier' => $this->input->post('kontak_supplier')
							);
				$x = $this->Mod_Query->add('supplier',$data);
				try {
					if ($x) {
						$this->set_log('Menambah Supplier');
						$this->set_alert("<div class='alert alert-info alert-dismissable'>
										    	<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
										    	<strong class='fa fa-check'> Supplier Telah Ditambah</strong> 
										    </div>");
						redirect('main/index/supplier/');
					}
					else{
						redirect('main/index/supplier/');
					}
				} catch (Exception $e) {
					echo $this->db->error();
				}
				
			}
		}
		function ubah_supplier(){
			if ($this->session->userdata('logged_in')) {
				$by = array('id_supplier' => $this->input->post('kode_supplier'));
				$data = array('nama' => $this->input->post('nama_supplier'),
							  'alamat' => $this->input->post('alamat'),
							  'asal_daerah' => $this->input->post('asal_daerah'),
							  'kontak_supplier' => $this->input->post('kontak_supplier')
							);
				$x = $this->Mod_Query->renew('supplier',$data,$by);
				try {
					if ($x) {
						$this->set_log('Mengubah Supplier');
						$this->set_alert("<div class='alert alert-info alert-dismissable'>
										    	<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
										    	<strong class='fa fa-check'> Supplier Telah Diubah</strong> 
										    </div>");
						redirect('main/index/supplier/');
					}
					else{
						redirect('main/index/supplier/gagal');
					}
				} catch (Exception $e) {
					echo $this->db->error();
				}
				
			}
		}
		function hapus_supplier($value){
			if ($this->session->userdata('logged_in')) {
				$data = array('id_supplier' => $value);
				$x = $this->Mod_Query->clear_by('supplier',$data);
				if ($x > 0) {
					$this->set_log('Menghapus Supplier');
					$this->set_alert("<div class='alert alert-info alert-dismissable'>
									    	<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									    	<strong class='fa fa-check'> Supplier Telah Dihapus</strong> 
									    </div>");
					redirect('main/index/supplier/');
				}
				else{
					redirect('main/index/supplier/');
				}
			}
		}
	}
?>
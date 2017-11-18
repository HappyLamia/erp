<?php 
	error_reporting(1);
	/**
	* 
	*/
	class Supplier extends CI_Controller
	{	
		function add(){
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
						set_alert('supplier_alert',1);
						$this->Mod_Number->set_log(get_user(),'Tambah Supplier','Supplier',$data['id_supplier']);
						redirect('admin-page/master/supplier');
					}
					else{
						redirect('admin-page/master/supplier');
					}
				} catch (Exception $e) {
					echo $this->db->error();
				}
				
			}
		}
		function renew(){
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
						set_alert('supplier_alert',2);
						$this->Mod_Number->set_log(get_user(),'Perbaharui Supplier ','Supplier',$by['id_supplier']);
						redirect('admin-page/master/supplier');
					}
					else{
						redirect('main/index/supplier/gagal');
					}
				} catch (Exception $e) {
					echo $this->db->error();
				}
				
			}
		}
		function delete($value){
			if ($this->session->userdata('logged_in')) {
				$data = array('id_supplier' => $value);
				$x = $this->Mod_Query->clear_by('supplier',$data);
				if ($x > 0) {
					set_alert('supplier_alert',3);
					$this->Mod_Number->set_log(get_user(),'Hapus Supplier ','Supplier',$data['id_supplier']);
					redirect('admin-page/master/supplier');
				}
				else{
					redirect('main/index/supplier/');
				}
			}
		}
	}
?>
<?php 
	error_reporting(1);
	class Gudang extends CI_Controller
	{
		function add(){
			if ($this->session->userdata('logged_in')) {
				$data = array('kode_gudang' => $this->input->post('kode_gudang'),
							  'nama_gudang' => $this->input->post('nama_gudang'),
							  'alamat' => $this->input->post('alamat'),
							  'kontak' => $this->input->post('kontak'),
							  'cabang_id' => $this->input->post('cabang')
							);
				$x = $this->Mod_Query->add('gudang',$data);
				if ($x > 0) {
					set_alert('gudang_alert',1);
					$this->Mod_Number->set_log(get_user(),'Tambah Gudang','Gudang',$data['kode_gudang']);
					redirect('admin-page/master/gudang');
				}
				else{
					redirect('admin-page/master/gudang');
				}
			}
		}
		function delete($value){
			if ($this->session->userdata('logged_in')) {
				$by = array('kode_gudang' => $value);
				$data = array('status' => 'Tidak Aktif');
				$x = $this->Mod_Query->renew('gudang',$data,$by);
				if ($x > 0) {
					set_alert('gudang_alert',3);
					$this->Mod_Number->set_log(get_user(),'Hapus Gudang','Gudang',$by['kode_gudang']);
					redirect('admin-page/master/gudang');
				}
				else{
					redirect('admin-page/master/gudang');;
				}
			}
		}
		function renew(){
			if ($this->session->userdata('logged_in')) {
				$by = array('kode_gudang' => $this->input->post('kode_gudang'));
				$data = array('nama_gudang' => $this->input->post('nama_gudang'),
							  'alamat' => $this->input->post('alamat'),
							  'kontak' => $this->input->post('kontak'),
							  'cabang_id' => $this->input->post('cabang')
							);
				$x = $this->Mod_Query->renew('gudang',$data,$by);
				if ($x > 0) {
					set_alert('customer_alert',2);
					$this->Mod_Number->set_log(get_user(),'Perbaharui Gudang','Gudang',$by['kode_gudang']);
					redirect('admin-page/master/gudang');
				}
				else{
					redirect('admin-page/master/gudang');
				}
			}
		}
	}
?>
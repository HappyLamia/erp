<?php 
	error_reporting(1);
	/**
	* 
	*/
	class Satuan extends CI_Controller
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
			$this->session->set_flashdata('satuan_alert', $value);
		}
		public function tambah_satuan()
		{
			$data = array('nama_satuan' => $this->input->post('nama_satuan'), 
						   'level_satuan' => $this->input->post('level_satuan')
				          );
			$x = $this->Mod_Query->add('satuan',$data);
			if ($x > 0) {
				$this->set_log('Menambah Satuan');
				redirect('main/index/pembelian');
			}
			else{
				redirect('main/index/pembelian');
			}
		}
		public function hapus_satuan($value)
		{
			$data = array('nama_satuan' => $value);
			$x = $this->Mod_Query->clear_by('satuan',$data);
			if ($x > 0) {
				$this->set_log('Menghapus Satuan');
				redirect('main/index/pembelian');
			}
			else{
				redirect('main/index/pembelian');
			}
		}
	}
?>
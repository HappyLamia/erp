<?php 
	/**
	* 
	*/
	class Diskon extends CI_Controller
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
			$this->session->set_flashdata('diskon_alert', $value);
		}
		public function atur_diskon($value)
		{
			if ($value=='coupon') {
				$by = array('id_diskon' => 1);
				$data = array('jumlah_diskon' => $this->input->post('jumlah_diskon'));
				$x = $this->Mod_Query->renew('diskon_coupon',$data,$by);
			} elseif ($value=='pembelian') {
				$by = array('id_diskon' => 1);
				$data = array('minimal_pembelian' => $this->input->post('mt'),
							  'jumlah_diskon' => $this->input->post('jumlah_diskon'));
				$x = $this->Mod_Query->renew('diskon_pembelian',$data,$by);
			} elseif ($value=='barang') {
				$data = array('id_barang' => $this->input->post('id_barang'),
							  'jumlah_diskon' => $this->input->post('jumlah_diskon'));
				$x = $this->Mod_Query->add('diskon_barang',$data);
			} elseif ($value=='ubah_barang') {
				$by = array('id_barang' => $this->input->post('id_barang'));
				$data = array('jumlah_diskon' => $this->input->post('jumlah_diskon'));
				$x = $this->Mod_Query->renew('diskon_barang',$data,$by);
			}
			$this->set_log('Mengatur Diskon');
			$this->set_alert("<div class='alert alert-info alert-dismissable'>
								    	<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
								    	<strong class='fa fa-check'> Diskon Telah Diatur </strong> 
								    </div>");
			redirect('main/index/diskon');
		}
		public function hapus_diskon($value)
		{
			$data = array('id_barang' => $value);
			$x = $this->Mod_Query->clear_by('diskon_barang',$data);
			$this->set_log('Menghapus Diskon');
			$this->set_alert("<div class='alert alert-warning alert-dismissable'>
								    	<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
								    	<strong class='fa fa-check'> Diskon Telah Dihapus </strong> 
								    </div>");
			redirect('main/index/diskon');
		}
	}
?>
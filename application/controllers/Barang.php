<?php 
	error_reporting(1);
	class Barang extends CI_Controller
	{
		public function dt_barang($value='')
		{
			$data  = array('id_barang' => $value);
			$x = $this->Mod_Query->get_where('row','barang',$data);
			if (!isset($x)) {
				$dt = array('name' => '', 
							'harga_beli' => '',
							'harga_jual' => '',
							'stok' => '',
						   );
				echo json_encode($dt);
			} else {
				$dt = array('name' => $x->nama_barang, 
							'harga_beli' => $x->harga_beli,
							'harga_jual' => $x->harga_retail,
							'stok' =>$x->stok
						   );
				echo json_encode($dt);
			}
		}
		public function atur_harga()
		{
			$by = array('id_barang' => $this->input->post('id_barang'));
			$data = array('harga_retail' => $this->input->post('hr'));
			$x = $this->Mod_Query->renew('harga',$data,$by);
			redirect('main/index/barang');
		}
		public function atur_satuan()
		{
			$by = array('id_barang' => $this->input->post('id_barang'));
			$data1 = array('dt_qty' => $this->input->post('ms'));
			$data2 = array('dt_qty' => $this->input->post('ls'));
			$this->Mod_Query->renew('satuan_barang_mid',$data1,$by);
			$this->Mod_Query->renew('satuan_barang_low',$data2,$by);
			redirect('main/index/barang');
		}
	}
?>
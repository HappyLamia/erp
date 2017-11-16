<?php 
	/**
	* 
	*/
	class Penerimaan extends CI_Controller
	{
		public function index($value='')
		{
			echo "Forbid";
		}
		public function set_list()
		{
			$val_date = $this->input->post('tgl_bpb');
			$tgl_bpb = date('Y-m-d',strtotime($val_date));
			$val_date2 = $this->input->post('tgl_terima');
			$tgl_terima = date('Y-m-d',strtotime($val_date2));
			$session = array('listed' => TRUE,
							 'tgl_bpb' => $tgl_bpb,
							 'tgl_terima' => $tgl_terima,
							 'kode_supplier' => $this->input->post('kode_supplier'),
							 'pemeriksa' => $this->input->post('pemeriksa'),
							 'penyetuju' => $this->input->post('penyetuju'),
							 'gudang' => $this->input->post('kode_gudang'),
							 'no_sj' => $this->input->post('no_sj'),
							 'no_po' => $this->input->post('no_po'),
							 'catatan' => $this->input->post('catatan')
							);
			$this->session->set_userdata($session);
			redirect('admin-page/gudang/penerimaan-barang');
		}
		public function cancel_order()
		{
			$this->cart->destroy();
			redirect('admin-page/gudang/penerimaan-barang');
		}
		public function remove_cart($value)
		{
			$this->cart->remove($value);
			redirect('admin-page/gudang/penerimaan-barang');
		}
		public function add_cart()
		{
			$data = array(
			        'id'      => $this->input->post('kode_barang'),
			        'qty'     => $this->input->post('qty'),
			        'price'   => 0,
			        'name'    => $this->input->post('nama_barang'),
			        'options' => array('deskripsi' => $this->input->post('deskripsi'),
			        				   'satuan' => $this->input->post('satuan'),
			        				   'qty_ctrl'=>$this->input->post('qty_ctrl'),
			        				   'unit_ctrl'=>$this->input->post('unit_ctrl'),
			        				   'sn'=>$this->input->post('sn'),
			        				  )
			);
			// $data = array(
			//         'id'      => 125,
			//         'qty'     => 2,
			//         'price'   => 19999,
			//         'name'    =>'HAHAHA'
			// );
			$this->cart->insert($data);
			redirect('admin-page/gudang/penerimaan-barang');
		}
		public function save()
		{
			foreach ($this->cart->contents() as $items){
				$i=0;
				foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value){
					$i++;
					if ($i==2) {
						$data = array('id_penjualan' => $this->session->userdata('id_penjualan'),
							   'id_barang' => $items['id'],
							   'jumlah_jual' => $items['qty'],
							   'diskon_barang' => $option_value
							  );
        				echo $option_value;
					}
        			
            	}
			}
		}
	}
?>
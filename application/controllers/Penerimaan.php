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
							 'no_bpb' => $this->input->post('kode_bpb'),
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
			print_r($session);
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
			$main = array('kode_bpb' => $this->session->userdata('no_bpb'),
						  'tgl_bpb' => $this->session->userdata('tgl_bpb'),
						  'tgl_terima' => $this->session->userdata('tgl_terima'),
						  'kode_supplier' => $this->session->userdata('kode_supplier'),
						  'pemeriksa' => $this->session->userdata('pemeriksa'),
						  'penyetuju' => $this->session->userdata('penyetuju'),
						  'kode_gudang' => $this->session->userdata('gudang'),
						  'no_sj' => $this->session->userdata('no_sj'),
						  'no_po' => $this->session->userdata('no_po')
						 );
			$y = $this->Mod_Query->add('penerimaan_barang',$main);
			if ($y > 0) {
				foreach ($this->cart->contents() as $items){
					$i=0;
					$foo = $this->cart->product_options($items['rowid']);
					foreach ($foo as $option_name => $option_value){
						$i++;
						if ($i==2) {
							$data = array('kode_bpb' => $this->session->userdata('no_bpb'),
								   'kode_barang' => $items['id'],
								   'nama_barang' => $items['name'],
								   'uraian' => $foo['deskripsi'],
								   'qty' => $items['qty'],
								   'satuan' => $foo['satuan'],
								   'qty_ctrl' => $foo['qty_ctrl'],
								   'unit_ctrl' => $foo['unit_ctrl'],
								   'sn' => $foo['sn'],
								  );
							$x = $this->Mod_Query->add('penerimaan_barang_dt',$data);
						}
	            	}
				}
			}
			redirect('admin-page/master/barang');
		}
	}
?>
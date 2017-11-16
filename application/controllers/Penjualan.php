<?php 
	error_reporting(1);
	/**
	* 
	*/
	class Penjualan extends CI_Controller
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
			$this->session->set_flashdata('penjualan_alert', $value);
		}
		public function set_treatment()
		{
			$data = array('id_treatment' => $this->input->post('id_treatment'));
			$row = $this->Mod_Query->get_where('row','treatment',$data);
			$data_tr = array(
			        'id'      => $row->id_treatment,
			        'qty'     => 1,
			        'price'   => $row->harga,
			        'name'    => $row->nama_treatment,
			        'options' => array('diskon'=>0,'type'=>'Jasa')
			);
			$this->cart->insert($data_tr);
			redirect('main/index/penjualan/');
		}
		public function unset_treatment()
		{
			$this->session->unset_userdata('id_treatment','nama_treatment','harga_treatment');
			redirect('main/index/penjualan/');
		}
		function set_penjualan($value){
			if ($this->session->userdata('logged_in')) {
				$data = array('id_penjualan' => $this->input->post('id_penjualan'),
							  'id_customer' => $this->input->post('id_customer')
							);
				if ($value=='non') {
					$this->session->set_userdata($data);
				} elseif($value=='member') {
					$this->session->set_userdata($data);
					$x = array('id_member' => $this->session->userdata('id_customer'));
					$row = $this->Mod_Query->get_where('row','birthday',$x);
					$this->session->set_userdata(array('no_coupon' => $row->coupon));
				}
				else{
					redirect('main/index/penjualan/');
				}
				redirect('main/index/penjualan/');
			}
		}
		public function use_coupon()
		{
			$data = array('id_coupon' => $this->session->userdata('id_penjualan'),
						  'id_customer' => $this->session->userdata('id_customer'),
						  'coupon' => $this->input->post('coupon')
						);
			$x = $this->Mod_Query->add('coupon',$data);
			$this->set_log('Menggunakan Coupon');
			redirect('main/index/penjualan/');
		}
		public function add_cart()
		{
			// $x  = array('id_barang' => $this->input->post('kode_barang'));
			// $row = $this->Mod_Query->get_where('row','barang',$x);
			// // $val = $this->cek_dis_barang($this->input->post('id_barang'));
			// // $diskon = $row->harga_retail * $val;
			// $harga = $row->harga_retail;
			// $data = array(
			//         'id'      => $this->input->post('kode_barang'),
			//         'qty'     => $this->input->post('qty'),
			//         'price'   => $harga,
			//         'name'    => $row->nama_barang
			// );
			$data = array(
			        'id'      => 123,
			        'qty'     => 2,
			        'price'   => 19999,
			        'name'    =>'HAHAHA'
			);
			$this->cart->insert($data);
			redirect('admin-page/penjualan/add-order');
		}
		public function cek_dis_barang($value='')
		{
			$data  = array('id_barang' => $value);
			$cek = $this->Mod_Query->get_where('num_rows','diskon_barang',$data);
			if ($cek > 0) {
				$row = $this->Mod_Query->get_where('row','diskon_barang',$data);
				return $row->jumlah_diskon / 100;
			} else {
				return 0;
			}
			
		}
		public function update_cart($value)
		{
			if ($value=="plus") {
				$qty = $this->input->post('nqty') + 1;
			} else {
				$qty = $this->input->post('nqty') - 1;
			}
			$data = array(
			        'rowid'  => $this->input->post('rowid'),
			        'qty'    => $qty
			);
			$this->cart->update($data);
			redirect('main/index/penjualan/');
		}
		public function remove_cart($value)
		{
			$this->cart->remove($value);
			redirect('admin-page/penjualan/order-barang');
		}
		public function off()
		{
			$userdata = array('id_penjualan','id_customer','no_coupon','id_treatment','harga_treatment','nama_treatment');
			$this->session->unset_userdata($userdata);
			$this->cart->destroy();
			redirect('main/index/penjualan/');
		}
		public function checkout($value)
		{
			$data = array('id_penjualan' => $this->session->userdata('id_penjualan'),
						  'id_customer' => $this->session->userdata('id_customer')
						);
			$x = $this->Mod_Query->add('penjualan',$data);
			if ($x > 0) {
		    	foreach ($this->cart->contents() as $items){
		    		if ($items['options']['type']=='Barang') {
		    			$i=0;
                    	foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value){
                    		$i++;
                    		if ($i==1) {
                    			$data1 = array('id_penjualan' => $this->session->userdata('id_penjualan'),
										   'id_barang' => $items['id'],
										   'jumlah_jual' => $items['qty'],
										   'diskon_barang' => $option_value
										  );
                    			$x1 = $this->Mod_Query->add('dt_penjualan',$data1);
                    		}					                                         
                        }
                    }
                }
                foreach ($this->cart->contents() as $items){
		    		if ($items['options']['type']=='Jasa') {
		    			$n=0;
                    	foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value){
                    		$n++;
                    		if ($n==1) {
                    			$data1 = array('id_penjualan' => $this->session->userdata('id_penjualan'),
										       'id_treatment' => $items['id']
										  	);
                    			$x1 = $this->Mod_Query->add('dt_treatment',$data1);
                    		}					                                         
                        }
                    }
                }
				/*foreach ($this->cart->contents() as $items){ 
					if ($this->cart->has_options($items['rowid']) == TRUE){ 
						foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value) 
						{
							echo $this->cart->format_number($option_value);
							$data1 = array('id_penjualan' => $this->session->userdata('id_penjualan'),
										   'id_barang' => $items['id'],
										   'jumlah_jual' => $items['qty'],
										   'diskon_barang' => $option_value
										  );
						}
					}
					$x1 = $this->Mod_Query->add('dt_penjualan',$data1);
				}*/
				$diskon_p = array('id_penjualan' => $this->session->userdata('id_penjualan'),
						  		  'id_customer' => $this->session->userdata('id_customer'),
						  		  'jumlah_diskon' => $value
						  		  );
				$this->Mod_Query->add('diskon_p',$diskon_p);
				$this->set_log('Melakukan Transaksi Penjualan');
				$this->off();
			}
		}
		/*function hapus_supplier($value){
			if ($this->session->userdata('logged_in')) {
				$data = array('id_supplier' => $value);
				$x = $this->Mod_Query->clear_by('supplier',$data);
				if ($x > 0) {
					redirect('main/index/supplier/');
				}
				else{
					redirect('main/index/supplier/');
				}
			}
		}*/
		public function updatePenjualan()
		{
			if ($this->session->userdata('logged_in')) {
				$by = array('id_penjualan' => $this->input->post('id_penjualan'),
							'id_barang' => $this->input->post('id_barang')
						   );
				$data = array('jumlah_jual' => $this->input->post('qty'));
				$x = $this->Mod_Query->renew('dt_penjualan',$data,$by);
				if ($x > 0) {
					$this->set_log('Memperbaharui Data Belanja');
					$this->set_alert("<div class='alert alert-success alert-dismissable'>
									    	<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									    	<strong class='fa fa-check'> Data Telah Diubah</strong> 
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
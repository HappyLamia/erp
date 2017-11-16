<?php 
	error_reporting(1);
	class Pembelian extends CI_Controller
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
			$this->session->set_flashdata('pembelian_alert', $value);
		}
		function set_pembelian(){
			if ($this->session->userdata('logged_in')) {
				$data = array('id_pembelian' => $this->input->post('id_pembelian'),
							  'id_supplier' => $this->input->post('id_supplier'),
							  'invoice' => $this->input->post('invoice')
							);
				$this->session->set_userdata($data);
				redirect('main/index/pembelian/');
			}
		}
		public function checkout()
		{
			$data_log = array('id_user' => $this->session->userdata('id_user'),
							  'aktifitas' => 'Transaksi Pembelian'
							);
			$this->Mod_Query->add('log',$data_log);
			$this->session->unset_userdata('id_pembelian','id_supplier');
			redirect('main/index/pembelian/');
		}
		function uploads()
		{
			$nama_album = 'barang';
			$this->cek_dir($nama_album);
			$namafile = $this->input->post('id_barang');
        	$config['upload_path']          = './warehouse/'.$nama_album;
            $config['allowed_types']        = 'jpg|png|jpeg|GIF|';
            $config['max_size']             = 2000000;
            $config['max_width']            = 20000;
            $config['max_height']           = 20000;
            $config['file_name'] = $namafile;
            $config['overwrite'] = TRUE;
            $this->load->library('upload', $config);
            if ( !$this->upload->do_upload('userfile'))
            {
                $error = array('error' => $this->upload->display_errors());
                foreach ($error as $key => $value) {
                	echo "<script>window.alert('$value');window.location=('http://indieshu.net/main/index/intro')</script>";
                }
            }
            else
            {     
            	$upload_data = $this->upload->data();
        		$config2['image_library'] = 'gd2';
				$config2['source_image'] = 'warehouse/'.$nama_album.'/'.$upload_data['file_name'];
				$config2['create_thumb'] = FALSE;
				$config2['maintain_ratio'] = TRUE;  	 		
				$config2['width']    = 400;
				$config2['height']   = 200;
        	 	$this->load->library('image_lib', $config2);
				$this->image_lib->resize();
            	$array = array('depend' =>$upload_data['file_name'],
							  'jenis' => 'barang',
							 );
				$a = $this->Mod_Query->add('files',$array);
				$this->add_cart();
            	redirect('main/index/pembelian');
            }
		}
		public function cek_dir($value='')
		{
			$path = 'warehouse/'.$value;
			if (!is_dir($path)) {
				mkdir('warehouse/'.$value);
			}
		}
		public function add_cart()
		{	
			$data = array('id_pembelian' => $this->session->userdata('id_pembelian'),
						  'id_supplier' => $this->session->userdata('id_supplier'),
						  'invoice' => $this->session->userdata('invoice')
						);
			$x = $this->Mod_Query->get_where('num_rows','pembelian',$data);
			if ($x > 0) {
				$data1 = array('id_pembelian' => $this->session->userdata('id_pembelian'),
							   'id_barang' => $this->input->post('id_barang'),
							   'kategori' => $this->input->post('kategori'),
							   'nama_barang' => $this->input->post('nama_barang'),
							   'ppn' => $this->input->post('ppn'),
							   'mfg_date' => $this->input->post('mfg_date'),
							   'exp_date' => $this->input->post('exp_date'),
							   'jumlah_beli' => $this->input->post('qty_1'),
							   'satuan' => $this->input->post('h_satuan')
							  );
				$a = $this->Mod_Query->add('dt_pembelian',$data1);
				$this->check_satuan_barang('mid','satuan_barang_mid');
				$this->check_satuan_barang('low','satuan_barang_low');
				$this->check_harga();
				redirect('main/index/pembelian/');
			}
			else{
				$this->Mod_Query->add('pembelian',$data);
				$data1 = array('id_pembelian' => $this->session->userdata('id_pembelian'),
							   'id_barang' => $this->input->post('id_barang'),
							   'kategori' => $this->input->post('kategori'),
							   'nama_barang' => $this->input->post('nama_barang'),
							   'ppn' => $this->input->post('ppn'),
							   'mfg_date' => $this->input->post('mfg_date'),
							   'exp_date' => $this->input->post('exp_date'),
							   'jumlah_beli' => $this->input->post('qty_1'),
							   'satuan' => $this->input->post('h_satuan')
							  );
				$a = $this->Mod_Query->add('dt_pembelian',$data1);
				$this->check_satuan_barang('mid','satuan_barang_mid');
				$this->check_satuan_barang('low','satuan_barang_low');
				$this->check_harga();
				redirect('main/index/pembelian/');
			}
		}
		public function remove_cart($value,$value2)
		{
			$data = array('id_pembelian' => $value,
						  'id_barang' => $value2
						 );
			$this->Mod_Query->clear_by('dt_pembelian',$data);
			redirect('main/index/pembelian');

		}
		public function update_cart()
		{
			$by = array('id_pembelian' => $value,
						'id_barang' => $value2
					   );
			$data = array('jumlah_beli' => $this->input->post('jumlah_beli'));
			$this->Mod_Query->renew('dt_pembelian',$data,$by);
			redirect('main/index/pembelian');

		}
		public function check_harga()
		{
			$data = array('id_barang' =>$this->input->post('id_barang'));
			$x = $this->Mod_Query->get_where('num_rows','harga',$data);
			if ($x > 0) {
				redirect('main/index/pembelian/');
			} else {
				$data1 = array('id_barang' => $this->input->post('id_barang'),
							   'harga_beli' => $this->input->post('harga_beli'),
							   'harga_retail' => $this->input->post('harga_retail')
							  );
				$a = $this->Mod_Query->add('harga',$data1);
			}	
		}
		public function check_satuan_barang($type,$value)
		{
			$data = array('id_barang' =>$this->input->post('id_barang'));
			$x = $this->Mod_Query->get_where('num_rows',$value,$data);
			if ($x > 0) {
				redirect('main/index/pembelian/');
			} else {
				$this->set_satuan($type);
			}	
		}
		public function set_satuan($value)
		{
			if ($value=='mid') {
				$data = array('id_barang' => $this->input->post('id_barang'),
							  'nama_satuan' => $this->input->post('m_satuan'),
							  'dt_qty' => $this->input->post('qty_2')
							 );
				$x = $this->Mod_Query->add('satuan_barang_mid',$data);
			} else {
				$data = array('id_barang' => $this->input->post('id_barang'),
							  'nama_satuan' => $this->input->post('l_satuan'),
							  'dt_qty' => $this->input->post('qty_3')
							 );
				$x = $this->Mod_Query->add('satuan_barang_low',$data);
			}
			
		}
		function hapus_supplier($value){
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
		}
		function remove($value){
			if ($this->session->userdata('logged_in')) {
				$data = array('id_pembelian' => $value);
				$x = $this->Mod_Query->clear_by('pembelian',$data);
				if ($x > 0) {
					redirect('main/index/pembelian/');
				}
				else{
					redirect('main/index/pembelian/');
				}
			}
		}
	}
?>
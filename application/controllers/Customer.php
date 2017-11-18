<?php 
	error_reporting(1);
	class Customer extends CI_Controller
	{
		function add(){
			if ($this->session->userdata('logged_in')) {
				$val_date = $this->input->post('tgl_lahir');
				$tgl_lhr = date('Y-m-d',strtotime($val_date));
				$data = array('id_customer' => $this->input->post('kode_customer'),
							  'nama' => $this->input->post('nama_customer'),
							  'tgl_lhr' => $tgl_lhr,
							  'alamat' => $this->input->post('alamat'),
							  'asal_daerah' => $this->input->post('asal_daerah')
							);
				$x = $this->Mod_Query->add('customer',$data);
				if ($x > 0) {
					set_alert('customer_alert',1);
					$this->Mod_Number->set_log(get_user(),'Tambah Customer','Customer',$data['id_customer']);
					redirect('admin-page/master/customer');
				}
				else{
					redirect('admin-page/master/customer');
				}
			}
		}
		function delete($value){
			if ($this->session->userdata('logged_in')) {
				$by = array('id_customer' => $value);
				$data = array('status' => 'Tidak Aktif');
				$x = $this->Mod_Query->renew('customer',$data,$by);
				if ($x > 0) {
					set_alert('customer_alert',3);
					$this->Mod_Number->set_log(get_user(),'Hapus Customer','Customer',$by['id_customer']);
					redirect('admin-page/master/customer');
				}
				else{
					redirect('admin-page/master/customer');;
				}
			}
		}
		function renew(){
			if ($this->session->userdata('logged_in')) {
				$by = array('id_customer' => $this->input->post('kode_customer'));
				$data = array('nama' => $this->input->post('nama_customer'),
							  'tgl_lhr' => $this->input->post('tgl_lahir'),
							  'alamat' => $this->input->post('alamat'),
							  'asal_daerah' => $this->input->post('asal_daerah')
							);
				$x = $this->Mod_Query->renew('customer',$data,$by);
				if ($x > 0) {
					set_alert('customer_alert',2);
					$this->Mod_Number->set_log(get_user(),'Perbaharui Customer','Customer',$by['id_customer']);
					redirect('admin-page/master/customer');
				}
				else{
					redirect('admin-page/master/customer');
				}
			}
		}
	}
?>
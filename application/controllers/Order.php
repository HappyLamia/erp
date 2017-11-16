<?php 
	/**
	* 
	*/
	class Order extends CI_Controller
	{
		public function index($value='')
		{
			echo "Forbid";
		}
		public function set_order()
		{
			$x = $this->Mod_Query->get_where('row','v_tracker',array('kode_sales' => $this->input->post('kode_sales')));
			$val_date = $this->input->post('del_date');
			$tgl_kirim = date('Y-m-d',strtotime($val_date));
			$session = array('no_order' => $this->input->post('no_order'),
							 'no_salesman' => $this->input->post('kode_sales'),
							 'no_customer' => $x->id_customer,
							 'date_delivery' => $tgl_kirim
							);
			$this->session->set_userdata($session);
			redirect('admin-page/penjualan/add-order');
		}
		public function cancel_order()
		{
			$this->cart->destroy();
			redirect('admin-page/penjualan/order-barang');
		}
	}
?>
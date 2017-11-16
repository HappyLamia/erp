<?php 
	/**
	* 
	*/
	class Install extends CI_Controller
	{
		public function index()
		{
			$this->tracker();
			$this->barang();
			$this->member();
			$this->served_queue();
			$this->v_log();
			$this->v_pembelian();
			$this->v_penjualan();
			$this->list_rm();
			//$this->bd_time();
			$this->v_diskon_barang();
			$this->v_rpt_pembelian();
			$this->total_penjualan();
			$this->v_rpt_penjualan();
			$this->v_struk();
			$this->v_total();
			$this->v_stok();
			$this->v_gaji();
			$this->total_pendapatan();
			$this->total_pendapatan_2();
			//$this->v_poli();
			//$this->birthday();
			$this->v_treatment();
			$this->v_diskon_pembelian();
			redirect('main/');
		}
		public function tracker()
		{
			$query = "CREATE VIEW v_tracker AS SELECT a.kode_track, c.nama_sales, b.nama , b.alamat , b.asal_daerah FROM track a, customer b, salesman c WHERE a.kode_customer = b.id_customer AND a.kode_salesman = c.kode_sales";
			$x = $this->Mod_Query->get_query('this',$query);
			return $x;
		}
		public function v_diskon_pembelian()
		{
			$query = "CREATE VIEW `v_diskon_pembelian`  AS  select `a`.`id_penjualan` AS `id_penjualan`,`a`.`id_customer` AS `id_customer`,`a`.`tgl_penjualan` AS `tgl_penjualan`,`b`.`jumlah_diskon` AS `jumlah_diskon` from (`penjualan` `a` join `diskon_p` `b`) where (`a`.`id_penjualan` = convert(`b`.`id_penjualan` using utf8)) ;";
			$x = $this->Mod_Query->get_query('this',$query);
			return $x;
		}
		public function v_treatment()
		{
			$query = "CREATE VIEW `v_treatment`  AS  select `a`.`id_penjualan` AS `id_penjualan`,`b`.`id_treatment` AS `id_treatment`,`b`.`nama_treatment` AS `nama_treatment`,`b`.`harga` AS `harga` from ((`penjualan` `a` join `treatment` `b`) join `dt_treatment` `c`) where ((`a`.`id_penjualan` = convert(`c`.`id_penjualan` using utf8)) and (`c`.`id_treatment` = `b`.`id_treatment`)) order by `a`.`id_penjualan` ;";
			$x = $this->Mod_Query->get_query('this',$query);
			return $x;
		}
		public function barang()
		{
			$query = "CREATE VIEW `barang`  AS  select `a`.`id_barang` AS `id_barang`,`a`.`nama_barang` AS `nama_barang`,`a`.`kategori` AS `kategori`,`d`.`harga_beli` AS `harga_beli`,`d`.`harga_retail` AS `harga_retail`,`b`.`dt_qty` AS `mid_rc`,`c`.`dt_qty` AS `low_rc`,((sum(`a`.`jumlah_beli`) * `b`.`dt_qty`) * `c`.`dt_qty`) AS `stok` from (((`dt_pembelian` `a` join `satuan_barang_mid` `b`) join `satuan_barang_low` `c`) join `harga` `d`) where ((`a`.`id_barang` = convert(`b`.`id_barang` using utf8)) and (`a`.`id_barang` = convert(`c`.`id_barang` using utf8)) and (`a`.`id_barang` = convert(`d`.`id_barang` using utf8))) group by `a`.`id_barang` ;";
			$x = $this->Mod_Query->get_query('this',$query);
			return $x;
		}
		public function member()
		{
			$query = "CREATE VIEW `member`  AS  select `pasien`.`id_pasien` AS `id_member`,`pasien`.`nama_pasien` AS `nama_member`,`pasien`.`tgl_lahir` AS `tgl_lahir`,`pasien`.`status` AS `status` from `pasien` where (`pasien`.`status` = 'Aktif') union select `customer`.`id_customer` AS `id_customer`,`customer`.`nama` AS `nama`,`customer`.`tgl_lhr` AS `tgl_lhr`,`customer`.`status` AS `status` from `customer` where (`customer`.`status` = 'Aktif') ;";
			$x = $this->Mod_Query->get_query('this',$query);
			return $x;
		}
		public function served_queue()
		{
			$query = "CREATE VIEW `served_queue`  AS  select `queue`.`id_queue` AS `id_queue`,`queue`.`id_poli` AS `id_poli`,`queue`.`nama_ruang` AS `nama_ruang`,`queue`.`no_queue` AS `no_queue`,`queue`.`waktu` AS `waktu`,`queue`.`status` AS `status` from `queue` where ((cast(`queue`.`waktu` as date) = cast(now() as date)) and (`queue`.`status` = 'Dilayani')) ;";
			$x = $this->Mod_Query->get_query('this',$query);
			return $x;
		}
		public function v_poli()
		{
			$query = "CREATE VIEW `v_poli`  AS  select `a`.`id_poli` AS `id_poli`,`a`.`nama_poli` AS `nama_poli`,concat(`a`.`id_poli`,'-',0,0,convert(`getPoli`(left(`a`.`id_poli`,1)) using utf8)) AS `nomor`,`b`.`nama_ruang` AS `nama_ruang` from (`poli` `a` join `ruang` `b`) where (convert(`b`.`kode_ruang` using utf8) = `a`.`kode_ruang`) ;";
			$x = $this->Mod_Query->get_query('this',$query);
			return $x;
		}
		public function v_log()
		{
			$query = "CREATE VIEW `v_log`  AS  select `b`.`username` AS `username`,`b`.`name` AS `name`,`a`.`aktifitas` AS `aktifitas`,`a`.`waktu` AS `waktu` from (`log` `a` join `user` `b`) where ((`a`.`id_user` = `b`.`id_user`) and (`b`.`username` <> 'Admin System')) ;";
			$x = $this->Mod_Query->get_query('this',$query);
			return $x;
		}
		public function v_pembelian()
		{
			$query = "CREATE VIEW `v_pembelian`  AS  select `a`.`id_pembelian` AS `id_pembelian`,`b`.`id_barang` AS `id_barang`,`g`.`id_supplier` AS `id_supplier`,`g`.`nama` AS `nama_supplier`,`b`.`nama_barang` AS `nama_barang`,`b`.`jumlah_beli` AS `jumlah_beli`,`c`.`harga_beli` AS `harga_beli`,(`b`.`jumlah_beli` * `c`.`harga_beli`) AS `sub_total`,`a`.`tgl_pembelian` AS `tgl_pembelian`,cast(`a`.`tgl_pembelian` as date) AS `tgl`,month(`a`.`tgl_pembelian`) AS `bln`,year(`a`.`tgl_pembelian`) AS `thn`,`d`.`nama_satuan` AS `lv2_satuan`,`e`.`nama_satuan` AS `lv3_satuan` from ((((((`pembelian` `a` join `dt_pembelian` `b`) join `harga` `c`) join `satuan_barang_mid` `d`) join `satuan_barang_low` `e`) join `barang` `f`) join `supplier` `g`) where ((`a`.`id_pembelian` = `b`.`id_pembelian`) and (`b`.`id_barang` = convert(`c`.`id_barang` using utf8)) and (`b`.`id_barang` = convert(`d`.`id_barang` using utf8)) and (`b`.`id_barang` = convert(`e`.`id_barang` using utf8)) and (`b`.`id_barang` = convert(`f`.`id_barang` using utf8)) and (`a`.`id_supplier` = convert(`g`.`id_supplier` using utf8))) group by `b`.`id_barang`,`a`.`id_pembelian` ;";
			$x = $this->Mod_Query->get_query('this',$query);
			return $x;
		}
		public function list_rm()
		{
			$query = "CREATE VIEW `list_rm`  AS  select `rm_skin`.`id_rm` AS `id_rm`,`rm_skin`.`id_pasien` AS `id_pasien` from `rm_skin` union select `rm_umum`.`id_rm` AS `id_rm`,`rm_umum`.`id_pasien` AS `id_pasien` from `rm_umum` union select `rm_slim`.`id_rm` AS `id_rm`,`rm_slim`.`id_pasien` AS `id_pasien` from `rm_slim` ;";
			$x = $this->Mod_Query->get_query('this',$query);
			return $x;
		}
		public function total_penjualan()
		{
			$query = "CREATE VIEW `total_penjualan`  AS  select `dt_penjualan`.`id_penjualan` AS `id_penjualan`,`dt_penjualan`.`id_barang` AS `id_barang`,sum(`dt_penjualan`.`jumlah_jual`) AS `jumlah_jual` from `dt_penjualan` group by `dt_penjualan`.`id_barang` ;";
			$x = $this->Mod_Query->get_query('this',$query);
			return $x;
		}
		public function v_stok()
		{
			$query = "CREATE VIEW `v_stok`  AS  select `barang`.`id_barang` AS `id_barang`,`barang`.`kategori` AS `kategori`,`barang`.`nama_barang` AS `nama_barang`,`barang`.`harga_beli` AS `harga_beli`,`barang`.`harga_retail` AS `harga_retail`,`barang`.`stok` AS `stok_awal`,ifnull(`total_penjualan`.`jumlah_jual`,0) AS `jumlah_jual`,(`barang`.`stok` - ifnull(`total_penjualan`.`jumlah_jual`,0)) AS `stok` from (`barang` left join `total_penjualan` on((`barang`.`id_barang` = `total_penjualan`.`id_barang`))) order by `barang`.`nama_barang` ;";
			$x = $this->Mod_Query->get_query('this',$query);
			return $x;
		}
		public function v_diskon_barang()
		{
			$query = "CREATE VIEW `v_diskon_barang`  AS  select `a`.`id_diskon` AS `id_diskon`,`a`.`id_barang` AS `id_barang`,`b`.`nama_barang` AS `nama_barang`,`a`.`jumlah_diskon` AS `jumlah_diskon` from (`diskon_barang` `a` join `barang` `b`) where (convert(`a`.`id_barang` using utf8) = `b`.`id_barang`) ;";
			$x = $this->Mod_Query->get_query('this',$query);
			return $x;
		}
		public function v_rpt_pembelian()
		{
			$query = "CREATE VIEW `v_rpt_pembelian`  AS  select `a`.`id_pembelian` AS `id_pembelian`,cast(`a`.`tgl_pembelian` as date) AS `tgl`,month(`a`.`tgl_pembelian`) AS `bln`,year(`a`.`tgl_pembelian`) AS `thn`,`b`.`id_barang` AS `id_barang`,`d`.`nama_barang` AS `nama_barang`,`c`.`harga_beli` AS `harga_beli` from (((`pembelian` `a` join `dt_pembelian` `b`) join `harga` `c`) join `barang` `d`) where ((`a`.`id_pembelian` = `b`.`id_pembelian`) and (`b`.`id_barang` = convert(`c`.`id_barang` using utf8)) and (`b`.`id_barang` = `d`.`id_barang`)) group by `a`.`id_pembelian`,`b`.`id_barang` ;";
			$x = $this->Mod_Query->get_query('this',$query);
			return $x;
		}
		public function v_rpt_penjualan()
		{
			$query = "CREATE VIEW `v_rpt_penjualan`  AS  select `a`.`id_penjualan` AS `id_penjualan`,`a`.`id_customer` AS `id_customer`,cast(`a`.`tgl_penjualan` as date) AS `tgl`,month(`a`.`tgl_penjualan`) AS `bln`,year(`a`.`tgl_penjualan`) AS `thn`,`b`.`id_barang` AS `id_barang`,`d`.`nama_barang` AS `nama_barang`,sum(`b`.`jumlah_jual`) AS `qty_terjual`,`c`.`harga_retail` AS `harga_retail`,(sum(`b`.`jumlah_jual`) * `c`.`harga_retail`) AS `sub_total` from (((`penjualan` `a` join `dt_penjualan` `b`) join `harga` `c`) join `barang` `d`) where ((`a`.`id_penjualan` = `b`.`id_penjualan`) and (`b`.`id_barang` = convert(`c`.`id_barang` using utf8)) and (`b`.`id_barang` = `d`.`id_barang`)) group by `a`.`id_penjualan`,`b`.`id_barang` ;";
			$x = $this->Mod_Query->get_query('this',$query);
			return $x;
		}
		public function v_struk()
		{
			$query = "CREATE VIEW `v_struk`  AS  select `a`.`id_penjualan` AS `id_penjualan`,`a`.`id_customer` AS `id_customer`,`a`.`tgl` AS `tgl`,`a`.`bln` AS `bln`,`a`.`thn` AS `thn`,`a`.`id_barang` AS `id_barang`,`a`.`nama_barang` AS `nama_barang`,`a`.`qty_terjual` AS `qty_terjual`,`a`.`harga_retail` AS `harga_retail`,(`b`.`diskon_barang` * `a`.`qty_terjual`) AS `total_diskon`,(`a`.`sub_total` - ifnull((`b`.`diskon_barang` * `a`.`qty_terjual`),0)) AS `sub_total` from (`v_rpt_penjualan` `a` join `dt_penjualan` `b`) where ((`a`.`id_penjualan` = `b`.`id_penjualan`) and (`a`.`id_barang` = `b`.`id_barang`)) ;";
			$x = $this->Mod_Query->get_query('this',$query);
			return $x;
		}
		public function v_total()
		{
			$query = "CREATE VIEW `v_total`  AS  select `v_rpt_penjualan`.`id_penjualan` AS `id_penjualan`,sum(`v_rpt_penjualan`.`sub_total`) AS `SUM(sub_total)` from `v_rpt_penjualan` group by `v_rpt_penjualan`.`id_penjualan` ;";
			$x = $this->Mod_Query->get_query('this',$query);
			return $x;
		}
		public function total_pendapatan_2()
		{
			$query = "CREATE VIEW `total_pendapatan_2`  AS  select `a`.`id_penjualan` AS `id_penjualan`,`a`.`id_customer` AS `id_customer`,`a`.`tgl` AS `tgl`,`a`.`bln` AS `bln`,`a`.`thn` AS `thn`,`a`.`total` AS `total`,`b`.`jumlah_diskon` AS `jumlah_diskon`,(`a`.`total` - ifnull(`b`.`jumlah_diskon`,0)) AS `total_diskon` from (`total_pendapatan` `a` left join `diskon_p` `b` on((`a`.`id_penjualan` = convert(`b`.`id_penjualan` using utf8)))) ;";
			$x = $this->Mod_Query->get_query('this',$query);
			return $x;
		}
		public function total_pendapatan()
		{
			$query = "CREATE VIEW `total_pendapatan`  AS  select `a`.`id_penjualan` AS `id_penjualan`,`a`.`id_customer` AS `id_customer`,`a`.`tgl` AS `tgl`,`a`.`bln` AS `bln`,`a`.`thn` AS `thn`,sum(`a`.`sub_total`) AS `total` from `v_struk` `a` group by `a`.`id_penjualan` ;";
			$x = $this->Mod_Query->get_query('this',$query);
			return $x;
		}
		public function bd_time()
		{
			$query = "CREATE VIEW `bd_time`  AS  select `member`.`id_member` AS `id_member`,`member`.`nama_member` AS `nama_member`,`member`.`tgl_lahir` AS `tgl_lahir`,if((date_format(`member`.`tgl_lahir`,'%m-%d') = date_format((cast(now() as date) + interval 1 day),'%m-%d')),'TOMORROW',if((date_format(`member`.`tgl_lahir`,'%m-%d') = date_format((cast(now() as date) - interval 1 day),'%m-%d')),'YESTERDAY',if((date_format(`member`.`tgl_lahir`,'%m-%d') = date_format(cast(now() as date),'%m-%d')),'TODAY',if((date_format(`member`.`tgl_lahir`,'%m-%d') > date_format(cast(now() as date),'%m-%d')),'LATER','PASSED')))) AS `bd` from `member` group by `member`.`tgl_lahir` ;";
			$x = $this->Mod_Query->get_query('this',$query);
			return $x;
		}
		public function birthday()
		{
			$query = "CREATE VIEW `birthday`  AS  select `a`.`id_member` AS `id_member`,`a`.`nama_member` AS `nama_member`,`a`.`tgl_lahir` AS `tgl_lahir`,`b`.`bd` AS `bd`,if((`b`.`bd` = 'TODAY'),concat('bd-',convert(date_format(now(),'%m-%d') using utf8),'-',convert(right(sha(cast(now() as date)),5) using utf8),'-',0,0,convert(`bd_id`() using utf8)),'') AS `coupon` from (`member` `a` join `bd_time` `b`) where (`a`.`id_member` = `b`.`id_member`) ;";
			$x = $this->Mod_Query->get_query('this',$query);
			return $x;
		}
		public function v_gaji()
		{
			$query = "CREATE VIEW `v_gaji`  AS  select `gaji`.`nip` AS `nip`,`gaji`.`nama_karyawan` AS `nama_karyawan`,sum(`gaji`.`masuk`) AS `Hadir`,sum(`gaji`.`tidak`) AS `Tidak_Hadir`,(sum(`gaji`.`masuk`) * 50000) AS `honor`,month(`gaji`.`tgl`) AS `Bulan` from `gaji` group by `gaji`.`nip` ;";
			$x = $this->Mod_Query->get_query('this',$query);
			return $x;
		}
		public function v_penjualan()
		{
			$query = "CREATE VIEW `v_penjualan`  AS  select `dt_penjualan`.`id_barang` AS `id_barang`,sum(`dt_penjualan`.`jumlah_jual`) AS `jumlah_jual` from `dt_penjualan` group by `dt_penjualan`.`id_barang` ;";
			$x = $this->Mod_Query->get_query('this',$query);
			return $x;
		}

	}
?>
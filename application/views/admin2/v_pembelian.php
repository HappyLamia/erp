<div class="col-lg-5">
	<div class="content-top-1">
		<div class="panel panel-primary">
			<div class="panel-heading">
				Form Pendataan Pembelian Barang
			</div>
			<div class="panel-body">
				<?php 
					if ($this->session->userdata('id_pembelian')) {
				?>
						<button type="button" data-toggle="modal" data-target="#m_satuan" class="btn btn-block btn-warning">Tambah Satuan</button>
						<hr>
						<form enctype="multipart/form-data" method="POST" action="<?php echo base_url('pembelian/add_cart'); ?>">
							<div class="form-group">
								<label class="label label-primary">ID Transaksi</label>
								<input readonly class="form-control" type="text" name="id_pembelian" value="<?php echo $this->session->userdata('id_pembelian'); ?>">
							</div>
							<div class="form-group">
								<label class="label label-primary">ID Supplier</label>
								<input readonly class="form-control" type="text" name="id_supplier" value="<?php echo $this->session->userdata('id_supplier'); ?>">
							</div>
							<div class="form-group">
								<label class="label label-primary">Kode Barang</label>
								<div class="input-group">
									<input required="" id="id_barang" onkeyup="setDtBarang()" onchange="setDtBarang()" class="col-sm-6 input-sm" type="text" name="id_barang">
									<button onclick="setDtBarang()" type="button" class="btn btn-primary">Cek</button>
								</div>
							</div>
							<div class="form-group">
								<label class="label label-primary">Kategori</label>
								<select class="form-control" name="kategori" required>
									<option value="">Pilih Kategori</option>
									<option value="Umum">Umum</option>
									<option value="Skin Care">Skin Care</option>
								</select>
							</div>
							<div class="form-group">
								<label class="label label-primary">Nama Barang</label>
								<input required id="nama_barang" class="form-control" type="text" name="nama_barang">
							</div>
							<div class="form-group">
								<table class="table table-stripped">
									<tr>
										<td>
											<label class="label label-primary">Harga Beli / Box</label>
											<input onkeyup="hargaBeli()" required id="harga_beli" class="form-control" type="number" name="harga_beli">
										</td>
										<td>
											<label class="label label-primary">PPN </label>
											<input onkeyup="hitungppn()" required id="ppn" class="form-control" type="number" name="ppn" placeholder="Ex : 10%">
										</td>
										<td>
											<label class="label label-primary">Jumlah PPN </label>
											<input readonly required id="jumlah_ppn" class="form-control" type="number" name="jumlah_ppn">
										</td>
									</tr>
								</table>
								
							</div>
							<div class="form-group">
								<label class="label label-primary">Harga Retail / Pcs</label>
								<input required id="harga_retail" class="form-control" type="text" name="harga_retail">
							</div>
							<div class="form-group">
								<label class="label label-primary">MFG Date</label>
								<input class="form-control" type="date" name="mfg_date">
							</div>
							<div class="form-group">
								<label class="label label-primary">EXP Date</label>
								<input class="form-control" type="date" name="exp_date">
							</div>
							<div class="form-group">
								<label class="label label-primary">Qty</label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-dropbox"></i>
									</span>
									<input value="1" class="col-xs-3" type="number" name="qty_1">
								</div>
								<select required name="h_satuan">
									<option value="">- Satuan Lv 1 -</option>
									<?php 
										foreach ($h_satuan as $key) {
									?>
											<option value="<?php echo $key->nama_satuan ?>"><?php echo $key->nama_satuan ?></option>
									<?php 
										}
									?>
								</select>
							</div>
							<hr>
							<div class="form-group">
								<label class="badge badge-warning">Detail Satuan / *optional</label>
								<div class="row">
									<div class="col-sm-6">
										<label class="label label-primary">Qty</label>
										<div class="input-group">
											<span class="input-group-addon">
												<i class="fa fa-dropbox"></i>
											</span>
											<input onkeyup="hargaBeli()" value="1" class="col-xs-8" type="number" id="mqty" name="qty_2">
										</div>
										<select name="m_satuan">
											<option value="NULL">- Satuan Lv 2 -</option>
											<?php 
												foreach ($m_satuan as $key) {
											?>
													<option value="<?php echo $key->nama_satuan ?>"><?php echo $key->nama_satuan ?></option>
											<?php 
												}
											?>
										</select>
									</div>
									<div class="col-sm-6">
										<label class="label label-primary">Qty</label>
										<div class="input-group">
											<span class="input-group-addon">
												<i class="fa fa-dropbox"></i>
											</span>
											<input onkeyup="hargaBeli()" value="1" class="col-xs-8" type="number" id="lqty" name="qty_3">
										</div>
										<select name="l_satuan">
											<option value="NULL">- Satuan Lv 3 -</option>
											<?php 
												foreach ($l_satuan as $key) {
											?>
													<option value="<?php echo $key->nama_satuan ?>"><?php echo $key->nama_satuan ?></option>
											<?php 
												}
											?>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<button class="btn btn-block btn-primary"><i class="fa fa-shopping-cart"></i> Tambah Ke Keranjang</button>
								<a href="<?php echo base_url('pembelian/checkout') ?>" class="btn btn-block btn-danger"><i class="fa fa-remove"></i> Batalkan</a>
							</div>
						</form>	
						<div class="modal fade" id="m_satuan" role="dialog">
						    <div class="modal-dialog">
						        <div class="modal-content">
						            <div class="modal-header bg-primary">
						                <button type="button" class="close" data-dismiss="modal">&times;</button>
						                <h4>Tambah Satuan</h4>
						            </div>
						            <div class="modal-body">
						                <form onsubmit="return confirm('Anda Akan Menyimpan Data Ini , Lanjutkan ?')" method="POST" action="<?php echo base_url('satuan/tambah_satuan') ?>">
											<div class="form-group">
												<label class="text-primary">Nama Satuan</label>
												<input required class="form-control" type="text" name="nama_satuan" />
											</div>
											<div class="form-group">
												<label class="text-primary">Level Satuan</label>
												<select name="level_satuan" class="form-control">
													<option value="">- Satuan -</option>
													<option value="Level 1">Level 1</option>
													<option value="Level 2">Level 2</option>
													<option value="Level 3">Level 3</option>
												</select>
											</div>
											<div class="form-group">
												<button class="btn btn-primary btn-block">Tambah</button>
											</div>
										</form>
										<div class="table-responsive">
											<table id="dt_satuan" class="table table-bordered">
												<thead>
													<tr>
														<th>Nama Satuan</th><th>Level Satuan</th><th>Aksi</th>
													</tr>
												</thead>
												<tbody>
													<?php 
														foreach ($satuan as $key) {
													?>
															<tr>
																<td><?php echo $key->nama_satuan ?></td>
																<td><?php echo $key->level_satuan ?></td>
																<td><a href=""><i class="fa fa-trash"></i></a></td>
															</tr>
													<?php 
														}
													?>
												</tbody>
											</table>
										</div>
						            </div>
						        </div>
						    </div>
						</div>
				<?php 	
					}
					else{
				?>
						<ul class="nav nav-tabs padding-12 tab-color-blue background-blue" id="myTab4">
							<li class="active">
								<a data-toggle="tab" href="#pb">Pembelian Barang</a>
							</li>
						</ul>

						<div class="tab-content col-lg-8">
							<div id="pb" class="tab-pane in active">
								<form method="POST" action="<?php echo base_url('pembelian/set_pembelian'); ?>">
									<div class="form-group">
										<input readonly class="form-control" type="text" name="id_pembelian" value="<?php echo $pb; ?>">
									</div>
									<div class="form-group">
										<select required class="form-control" name="id_supplier">
											<option value="">Pilih Supplier</option>
											<?php 
												foreach ($supplier as $key) {
											?>
													<option value="<?php echo $key->id_supplier ?>"><?php echo $key->nama; ?></option>
											<?php 
												}
											?>
										</select>
									</div>
									<div class="form-group">
										<label class="badge badge-primary">NO INVOICE</label>
										<input class="form-control" type="text" name="invoice" value="">
									</div>
									<div class="form-group">
										<button class="btn btn-block btn-primary">OK</button>
									</div>
								</form>	
							</div>
						</div>
				<?php 
					}
				?>
				
			</div>
		</div>
		<div class="clearfix"> </div>
	</div>
</div>
<div class="col-lg-7 table-responsive">
	<div class="content-top-1">
	<?php 
		if ($this->session->userdata('id_pembelian')) {
	?>
			<strong>ID Transaksi</strong> : <?php echo $this->session->userdata('id_pembelian'); ?>
			<hr>
			<table class="table table-bordered">
				<thead>
					<tr class="bg-primary">
						<th>Kode Barang</th>
						<th>Nama Barang</th>
						<th>Qty</th>
						<th>Harga</th>
						<th>Sub Total</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$total = 0;
						foreach ($sc as $key) 
						{
					?>
						<tr>
								<td><?php echo $key->id_barang ?></td>
								<td><?php echo $key->nama_barang; ?></td>
								<td><?php echo $key->jumlah_beli; ?></td>
								<td><?php echo $this->cart->format_number($key->harga_beli); ?></td>
								<td><?php echo $this->cart->format_number($key->sub_total); ?></td>
								<td><a href=""><i class="fa fa-plus"></i></a></td>
						</tr>
					<?php 
							$total = $total + $key->sub_total;
						}
					?>
				</tbody>
			</table>
			<table class="table table-stripped">
				<tr>
					<td><strong>Total</strong></td>
					<td>Rp.<?php echo $this->cart->format_number($total); ?></td>
					<td><a class="btn-sm btn btn-primary" href="<?php echo base_url('pembelian/checkout') ?>">Checkout</a></td>
				</tr>
			</table>
	<?php 
		}
		else{
	?>
		
			<table id="dt_pembelian" class="table table-bordered">
				<thead>
					<tr>
						<th>ID Pembelian</th>
						<th>ID Supplier</th>
						<th>Tanggal Pembelian</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						foreach ($pembelian as $key) {
					?>
							<tr>
								<td><?php echo $key->id_pembelian; ?></td>
								<td><?php echo $key->id_supplier; ?></td>
								<td><?php echo $key->tgl_pembelian; ?></td>
								<td>
									<!--a href="<?php //echo base_url('main/index/pembelian/detail/').$key->id_pembelian.'/'.$key->id_supplier ?>">Lihat Detail</a> | --> 
									<a onclick="return confirm('Anda Akan Menghapus Data Ini , Lanjutkan ?')" href="<?php echo base_url('pembelian/remove/').$key->id_pembelian ?>"><i class="fa fa-trash"></i></a>
								</td>
							</tr>
					<?php 
						}
					?>
				</tbody>
			</table>
	<?php 
		}
	?>
		<div class="clearfix"> </div>
	</div>
</div>
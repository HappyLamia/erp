<div class="col-lg-12">
	<div class="content-top-1 table-responsive">
	<form class="form-horizontal" action="<?php echo base_url('admin-page/penjualan/add-to-cart') ?>" method="POST">
		<div class="row">
			<div class="col-sm-6">
				<table class="table table-bordered">
					<tr>
						<td><label class="label label-primary">No Order</label></td>
						<td>:</td>
						<td><input readonly="" type="text" class="form-control" id="inputEmail3" value="<?php echo $this->session->userdata('no_order') ?>"></td>
					</tr>
					<tr>
						<td><label class="label label-primary">No Salesman</label></td>
						<td>:</td>
						<td><input readonly="" type="text" class="form-control" id="inputEmail3" value="<?php echo $this->session->userdata('no_salesman') ?>"></td>
					</tr>
					<tr>
						<td><label class="label label-primary">No Customer</label></td>
						<td>:</td>
						<td><input readonly="" type="text" class="form-control" id="inputEmail3" value="<?php echo $this->session->userdata('no_customer') ?>"></td>
					</tr>
					<tr>
						<td><label class="label label-primary">Delivery Date</label></td>
						<td>:</td>
						<td><input readonly="" type="text" class="form-control" id="inputEmail3" value="<?php echo $this->session->userdata('date_delivery') ?>"></td>
					</tr>
				</table>	
			</div>
			<div class="col-sm-6">
				<table class="table table-bordered">
					<tr>
						<td><label class="label label-primary">No Product</label></td>
						<td>:</td>
						<td>
							<select required name="kode_barang" class="form-control" onchange="showStok(this.value)">
								<option value="_blank_">Pilih Barang</option>
							<?php 
								foreach ($barang as $key) {
							?>
									<option value="<?php echo $key->id_barang ?>"><?php echo $key->nama_barang ?></option>
							<?php 
								}
							?>
						</select>
						</td>
					</tr>
					<tr class="hidden"> 
						<td><label class="label label-primary">Nama Product<label></td>
						<td>:</td>
						<td><input name="nama_barang" readonly type="text" class="form-control" id="nama_barang"></td>
					</tr>
					<tr>
						<td><label class="label label-primary">Stock<label></td>
						<td>:</td>
						<td><input readonly type="text" class="form-control" id="stok"></td>
					</tr>
					<tr>
						<td><label class="label label-primary">Harga<label></td>
						<td>:</td>
						<td><input name="harga" readonly type="text" class="form-control" id="harga"></td>
					</tr>
					<tr class="hidden"> 
						<td><label class="label label-primary">Temp Stock<label></td>
						<td>:</td>
						<td><input readonly type="text" class="form-control" id="temp"></td>
					</tr>
					<tr>
						<td><label class="label label-primary">Qty</label></td>
						<td>:</td>
						<td><input required onkeyup="minus_stock()" type="number" class="form-control" id="qty" name="qty" value="0"></td>
					</tr>
				</table>
			</div>	
		</div>
		<div class="row">
			<div class="col-lg-6 col-lg-offset-6">
				<table class="table table-stripped">
					<tr>
						<td>
							<button id="add-to-cart" type="submit" class="btn btn-primary btn-block">Add</button>
						</td>
						<td>
							<a href="<?php echo base_url('admin-page/penjualan/remove-cart') ?>" class="btn btn-danger btn-block">Cancel</a>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</form>
	<hr>
	<div class="col-lg-12 table-responsive">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>No</th><th>No Product</th><th>Name</th><th>Qty</th><th>Price</th><th>Sub Total</th><th colspan="2">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
			    	$no = 0;
			    	foreach ($this->cart->contents() as $items){
			    		$no++;
			    ?>
				            <tr>
				            	<td><?php echo $no; ?></td>
			            		<td><?php echo $items['id']; ?></td>
								<td><?php echo $items['name']; ?></td>
								<td><?php echo $items['qty']; ?></td>
								<td><?php echo "Rp. ".$this->cart->format_number($items['price']); ?></td>
			                    <td><?php echo "Rp. ".$this->cart->format_number($items['subtotal']); ?></td>
			                    <td class="text-center">
									<form class="form-inline" method="POST" action="<?php echo base_url('penjualan/update_cart/plus') ?>">
										<div class="form-group">
											<input type="hidden" name="rowid" value="<?php echo $items['rowid']; ?>">
											<input type="hidden" name="nqty" value="<?php echo $items['qty']; ?>">
										</div>
										<div class="form-group">
											<button class="btn btn-sm btn-primary"><i class="fa fa-plus"></i></button>
										</div>
									</form>
									<form class="form-inline" method="POST" action="<?php echo base_url('penjualan/update_cart/minus') ?>">
										<div class="form-group">
											<input type="hidden" name="rowid" value="<?php echo $items['rowid']; ?>">
											<input type="hidden" name="nqty" value="<?php echo $items['qty']; ?>">
										</div>
										<div class="form-group">
											<button class="btn btn-sm btn-warning"><i class="fa fa-minus"></i></button>
										</div>
									</form>
								</td>
								<td  class="text-center"><a class="btn btn-danger" href="<?php echo base_url('penjualan/remove_cart/'). $items['rowid']?>"><i class="fa fa-trash"></i></a>
								</td>
				            </tr>
			    <?php 
			    	}
			    ?>
			</tbody>
		</table>
	</div>
	<div class="clearfix"></div>
	</div>
</div>
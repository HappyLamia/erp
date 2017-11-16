<div class="col-lg-12">
	<div class="content-top-1">
	<form action="<?php echo base_url('admin-page/penjualan/set-order') ?>" method="POST">
		<div class="col-lg-8">
			<table class="table table-stripped">
				<tr>
					<td>No Order</td>
					<td>:</td>
					<td><input type="text" class="form-control" readonly="" name="no_order" value="<?php echo $kode; ?>"></td>
					<td>Delivery Date</td>
					<td>:</td>
					<td><input required type="date" name="del_date" class="form-control"></td>
				</tr>
				<tr>
					<td>Salesman</td>
					<td>:</td>
					<td>
						<select required name="kode_sales" class="form-control">
							<?php 
								foreach ($salesman as $key) {
							?>
									<option value="<?php echo $key->kode_sales ?>"><?php echo $key->nama_sales ?></option>
							<?php 
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="2"><button class="btn btn-primary">Add Order</button></td>
					<td></td>
				</tr>
			</table>
		</div>
	</form>
	<table class="table table-stripped">
		<thead>
			<tr>
				<th>No Orders</th><th>Customer</th><th>Sales</th><th>Total Amount</th><th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			
		</tbody>
		<tfoot>
			<tr>
				<td colspan="5"></td>
			</tr>
		</tfoot>
	</table>
	<div class="clearfix"> </div>
	</div>
</div>
<div class="col-lg-4">
	<div class="content-top-1">
		<div class="panel panel-primary">
			<div class="panel-heading"><i class="fa fa-building-o"></i> Add Tracker </div>
			<div class="panel-body">
				<p>
					<?php echo $alert; ?>
				</p>
				<form method="POST" role="form" action="<?php echo base_url('admin-page/master/tracker/add') ?>">
					<div class="form-group">
						<input type="hidden" name="kode_sales" class="form-control" readonly=""  value="<?php echo $sales->kode_sales ?>" />
					</div>

					<div class="form-group">
						<label class="text-primary"> Nama Salesman </label>
						<input required="" type="text" name="nama_sales" class="form-control" readonly="" value="<?php echo $sales->nama_sales ?>" />
					</div>

					<div class="form-group">
						<label class="text-primary">  Customer </label>
						<select name="kode_customer" class="form-control">
							<?php 
								foreach ($customer as $key) {
							?>
									<option value="<?php echo $key->id_customer ?>"><?php echo $key->nama ?></option>
							<?php 
								}
							?>
						</select>
					</div>

					<div class="form-group">
						<button class="btn btn-block btn-success"><i class="fa fa-plus"></i> Save</button>
					</div>
				</form>
			</div>
		</div>
		<div class="clearfix"> </div>
	</div>
</div>
<div class="col-lg-8">
	<div class="content-top-1">
		<table id="dt_supplier" class="table table-bordered">
			<thead>
				<tr>
					<th>Tracker</th><th>Alamat</th><th>Asal Daerah</th><th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach ($tracker as $key) {
				?>
						<tr>
							<td><?php echo $key->nama ?></td>
							<td><?php echo $key->alamat ?></td>
							<td><?php echo $key->asal_daerah ?></td>
							<td> 
								<a onclick="return confirm('Apa Anda Ingin Menghapus Data Ini ?')" href="<?php echo base_url('supplier/hapus_supplier/').$key->id_supplier ?>"><i class="fa fa-times"></i></a>
							</td>
						</tr>
				<?php 
					}
				?>
			</tbody>
		</table>
		<div class="clearfix"> </div>
	</div>
</div>
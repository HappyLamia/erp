<div class="col-lg-4">
	<div class="content-top-1">
		<div class="panel panel-primary">
			<div class="panel-heading"><i class="fa fa-building-o"></i> Form Customer </div>
			<div class="panel-body">
				<p>
					<?php echo $alert; ?>
				</p>
				<form method="POST" role="form" action="<?php echo base_url('admin-page/customer/add') ?>">
					<div class="form-group">
						<label class="text-primary"> Kode Customer</label>
						<input readonly type="text" name="kode_customer" class="form-control" value="<?php echo $kode; ?>"/>
					</div>

					<div class="form-group">
						<label class="text-primary"> Nama Customer </label>
						<input type="text" name="nama_customer" class="form-control" />
					</div>

					<div class="form-group">
						<label class="text-primary"> Tanggal Lahir </label>
						<input type="date" name="tgl_lahir" class="form-control" />
					</div>

					<div class="form-group">
						<label class="text-primary">  Alamat </label>
						<textarea class="form-control" name="alamat" ></textarea>
					</div>

					<div class="form-group">
						<label class="text-primary"> Asal Daerah </label>
						<select required="" name="asal_daerah" class="form-control">
							<option value="">- -</option>
						<?php 
							foreach ($daerah as $key) {
						?>
								<option value="<?php echo $key->Nama ?>"><?php echo $key->Nama ?></option>
						<?php 	
							}
						?>
						</select>
					</div>

					<div class="form-group">
						<button class="btn btn-block btn-success"><i class="fa fa-plus"></i> Tambah Customer</button>
					</div>
				</form>
			</div>
		</div>
		<div class="clearfix"> </div>
	</div>
</div>
<div class="col-lg-8">
	<div class="content-top-1">
		<table id="myTable" class="table table-bordered">
			<thead>
				<tr>
					<th>Kode Customer</th><th>Nama Customer</th><th>Asal Daerah</th><th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach ($customer as $key) {
				?>
						<tr>
							<td><?php echo $key->id_customer ?></td>
							<td><?php echo $key->nama ?></td>
							<td><?php echo $key->alamat ?></td>
							<td>
								<a data-toggle="modal" class="btn btn-warning" href="#<?php echo $key->id_customer ?>"><i class="fa fa-edit"></i></a> | 
								<a onclick="return confirm('Apa Anda Ingin Menghapus Data Ini ?')" class="btn btn-danger" href="<?php echo base_url('supplier/hapus_supplier/').$key->id_customer ?>"><i class="fa fa-trash"></i></a>
							</td>
						</tr>
						<div class="modal fade" id="<?php echo $key->id_customer ?>" role="dialog">
						    <div class="modal-dialog">
						        <div class="modal-content">
						            <div class="modal-header bg-primary">
						                <button type="button" class="close" data-dismiss="modal">&times;</button>
						                <h4>Edit Supplier</h4>
						            </div>
						            <div class="modal-body">
						            </div>
						        </div>
						    </div>
						</div>
				<?php 
					}
				?>
			</tbody>
		</table>
		<div class="clearfix"> </div>
	</div>
</div>
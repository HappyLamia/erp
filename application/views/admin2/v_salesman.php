<div class="col-lg-4">
	<div class="content-top-1">
		<div class="panel panel-primary">
			<div class="panel-heading"><i class="fa fa-building-o"></i> Form Salesman </div>
			<div class="panel-body">
				<p>
					<?php echo $alert; ?>
				</p>
				<form method="POST" role="form" action="<?php echo base_url('admin-page/sales/add') ?>">
					<div class="form-group">
						<label class="text-primary"> Kode Salesman</label>
						<input type="text" name="kode_sales" class="form-control" readonly=""  value="<?php echo $kode ?>" />
					</div>

					<div class="form-group">
						<label class="text-primary"> Nama Salesman </label>
						<input required="" type="text" name="nama_sales" class="form-control" />
					</div>

					<div class="form-group">
						<label class="text-primary">  Alamat </label>
						<textarea required="" class="form-control" name="alamat" ></textarea>
					</div>

					<div class="form-group">
						<label class="text-primary"> Kontak </label>
						<input required="" type="text" name="kontak" class="form-control" />
					</div>

					<div class="form-group">
						<button class="btn btn-block btn-success"><i class="fa fa-plus"></i> Tambah Salesman</button>
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
					<th>Kode Salesman</th><th>Nama Salesman</th><th>Kontak</th><th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach ($salesman as $key) {
				?>
						<tr>
							<td><?php echo $key->kode_sales ?></td>
							<td><?php echo $key->nama_sales ?></td>
							<td><?php echo $key->kontak ?></td>
							<td>
								<a class="btn btn-success" href="<?php echo base_url('admin-page/master/salesman/add-tracker/').$key->kode_sales ?>">Add Tracker</a>
								<a data-toggle="modal" class="btn btn-warning" href="#<?php echo $key->kode_sales ?>"><i class="fa fa-edit"></i></a> | 
								<a onclick="return confirm('Apa Anda Ingin Menghapus Data Ini ?')" class="btn btn-danger" href=""><i class="fa fa-trash"></i></a>
							</td>
						</tr>
						<div class="modal fade" id="<?php echo $key->id_customer ?>" role="dialog">
						    <div class="modal-dialog">
						        <div class="modal-content">
						            <div class="modal-header bg-primary">
						                <button type="button" class="close" data-dismiss="modal">&times;</button>
						                <h4>Edit Salesman</h4>
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
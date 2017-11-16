<div class="col-lg-4">
	<div class="content-top-1">
		<div class="panel panel-primary">
			<div class="panel-heading"><i class="fa fa-building-o"></i> Form Supplier </div>
			<div class="panel-body">
				<h4><?php echo $msg; ?></h4>
				<hr>
				<form method="POST" role="form" onsubmit="return confirm('Anda Akan Menyimpan Data Ini , Lanjutkan ?')" method="POST" action="<?php echo base_url('supplier/tambah_supplier') ?>">
					<div class="form-group">
						<label class="text-primary"> Kode Supplier</label>
						<input type="text" name="kode_supplier" class="form-control"/>
					</div>

					<div class="form-group">
						<label class="text-primary"> Nama Supplier </label>
						<input type="text" name="nama_supplier" class="form-control" />
					</div>

					<div class="form-group">
						<label class="text-primary">  Alamat </label>
						<textarea class="form-control" name="alamat"></textarea>
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
						<label class="text-primary"> Kontak Supplier </label>
						<input type="text" name="kontak_supplier" class="form-control" />
					</div>

					<div class="form-group">
						<button class="btn btn-block btn-success"><i class="fa fa-plus"></i> Tambah Supplier</button>
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
					<th>Kode Supplier</th><th>Nama Supplier</th><th>Alamat Supplier</th><th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach ($supplier as $key) {
				?>
						<tr>
							<td><?php echo $key->id_supplier ?></td>
							<td><?php echo $key->nama ?></td>
							<td><?php echo $key->alamat ?></td>
							<td>
								<a data-toggle="modal" class="btn btn-warning" href="#<?php echo $key->id_supplier ?>"><i class="fa fa-edit"></i></a> | 
								<a onclick="return confirm('Apa Anda Ingin Menghapus Data Ini ?')" class="btn btn-danger" href="<?php echo base_url('supplier/hapus_supplier/').$key->id_supplier ?>"><i class="fa fa-trash"></i></a>
							</td>
						</tr>
						<div class="modal fade" id="<?php echo $key->id_supplier ?>" role="dialog">
						    <div class="modal-dialog">
						        <div class="modal-content">
						            <div class="modal-header bg-primary">
						                <button type="button" class="close" data-dismiss="modal">&times;</button>
						                <h4>Edit Supplier</h4>
						            </div>
						            <div class="modal-body">
						            	<form method="POST" role="form" onsubmit="return confirm('Anda Akan Mengubah Data Ini , Lanjutkan ?')" method="POST" action="<?php echo base_url('supplier/ubah_supplier') ?>">
						            		<div class="form-group">
												<label class="text-primary"> Kode Supplier</label>
												<input type="text" name="kode_supplier" class="form-control"  value="<?php echo $key->id_supplier ?>" />
											</div>

											<div class="form-group">
												<label class="text-primary"> Nama Supplier </label>
												<input type="text" name="nama_supplier" class="form-control"  value="<?php echo $key->nama ?>" />
											</div>

											<div class="form-group">
												<label class="text-primary">  Alamat </label>
												<textarea class="form-control" name="alamat"><?php echo $key->alamat ?></textarea>
											</div>

											<div class="form-group">
												<label class="text-primary"> Asal Daerah </label>
												<input type="text" name="asal_daerah" class="form-control" value="<?php echo $key->asal_daerah ?>"/>
											</div>

											<div class="form-group">
												<label class="text-primary"> Kontak Supplier </label>
												<input type="text" name="kontak_supplier" class="form-control" value="<?php echo $key->kontak_supplier ?>"/>
											</div>

											<div class="form-group">
												<button class="btn btn-block btn-info"><i class="fa fa-edit"></i> edit Supplier</button>
											</div>
										</form>
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
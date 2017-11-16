<div class="col-lg-4">
	<div class="content-top-1">
		<div class="panel panel-primary">
			<div class="panel-heading"><i class="fa fa-building-o"></i> Form Gudang </div>
			<div class="panel-body">
				<form method="POST" role="form">
					<div class="form-group">
						<label class="text-primary"> Kode Gudang</label>
						<input type="text" name="kode_supplier" class="form-control" />
					</div>

					<div class="form-group">
						<label class="text-primary"> Nama Gudang</label>
						<input type="text" name="nama_supplier" class="form-control" />
					</div>

					<div class="form-group">
						<label class="text-primary">  Jenis Gudang </label>
						<input type="text" name="nama_supplier" class="form-control" />
					</div>

					<div class="form-group">
						<label class="text-primary"> Status Gudang </label><br>
						<input type="radio" name="nama_supplier" value="Aktif" checked="" /> Aktif
						<input type="radio" name="nama_supplier" value="Tidak Aktif" /> Tidak Aktif
					</div>

					<div class="form-group">
						<button class="btn btn-block btn-success"><i class="fa fa-plus"></i> Tambah Gudang</button>
					</div>
				</form>
			</div>
		</div>
		<div class="clearfix"> </div>
	</div>
</div>
<div class="col-lg-8">
	<div class="content-top-1">
		<div class="table-responsive">
			<div class="panel panel-primary">
				<div class="panel-heading"><i class="fa fa-building-o"></i> Data Gudang </div>
				<div class="panel-body">
					<table id="myTable" class="table table-bordered">
						<thead>
							<tr>
								<th>Kode Gudang</th><th>Nama Gudang</th><th>Jenis</th><th>Status</th><th>Aksi</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="clearfix"> </div>
	</div>
</div>
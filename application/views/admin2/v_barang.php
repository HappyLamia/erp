<div class="col-lg-12">
	<div class="content-top-1">
		<div class="table-responsive">
			<div class="panel panel-primary">
				<div class="panel-heading"><i class="fa fa-building-o"></i> Data Barang </div>
				<div class="panel-body">
					<table id="myTable" class="table table-bordered">
						<thead>
							<tr>
								<th>Kode Barang</th>
								<th>Nama Barang</th>
								<th>Nama Gudang</th>
								<th>Harga Retail</th>
								<th>SN</th>
								<th>Stok</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								foreach ($barang as $key) {
							?>
									<tr>
										<td><?php echo $key->kode_barang ?></td>
										<td><?php echo $key->nama_barang ?></td>
										<td><?php echo $key->nama_gudang ?></td>
										<td><?php echo "Rp. ".$this->cart->format_number($key->harga_retail) ?></td>
										<td><?php 
												if ($key->sn=="Null") {
													echo "---";
												} 
												else{
													echo $key->sn;
												}
											?>
										</td>
										<td><?php echo $key->stok_awal ?></td>
									</tr>
							<?php 
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="clearfix"> </div>
	</div>
</div>
<style>
.button-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.button-container a {
    margin-right: 10px; 
}
</style>
<div class="col-12">
	<div class="card">
		<div class="card-body">
			<div class="table-responsive">
				<div class="container mt-4">
				    <div class="d-flex justify-content-between align-items-center mb-3">
				        <h1></h1>
				        <button type="button" class="btn btn-success mb-2" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg">
				            <i class="fa-solid fa-plus"></i> Tambah
				        </button>

				        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
				            <div class="modal-dialog modal-xl">
				                <div class="modal-content">
				                    <div class="modal-header">
				                        <h4 class="modal-title">Apakah anda yakin ingin menambah data barang masuk?</h4>
				                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				                    </div>
				                    <form id="imageForm" class="form-horizontal form-label-left" action="<?= base_url('POS/tambah_barang_masuk')?>" method="post">
				                        <div class="modal-body">
				                            <div class="row">
				                                <div class="mb-3 col-md-12">
				                                    <label class="form-label">Nama Barang<span style="color: black;"> :</span></label>
				                                    <select name="id_barang" class="form-control text-uppercase" id="id_barang" required autocomplete="on">
						                                <option disabled selected>Pilih Nama Barang</option>
						                                <?php foreach ($p as $brg) {?>
						                                    <option class="text-uppercase" value="<?php echo $brg->id_barang ?>"><?php echo $brg->kode_barang ?> - <?php echo $brg->nama_barang ?></option>
						                                <?php } ?>
						                            </select>
				                                </div>
												<div class="mb-3 col-md-6">
												    <label class="form-label">Stok Masuk<span style="color: black;"> :</span></label>
												    <input type="text" id="stok" name="stok" class="form-control text-capitalize" placeholder="Stok Masuk" autocomplete="on">
												</div>
												<script>
												    document.addEventListener('DOMContentLoaded', function () {
												        var stokInput = document.getElementById('stok');

												        stokInput.addEventListener('input', function () {
												            this.value = this.value.replace(/[^0-9]/g, '');
												        });
												    });
												</script>
				                                <div class="mb-3 col-md-6">
				                                    <label class="form-label">Nama Supplier<span style="color: black;"> :</span></label>
				                                    <input type="text" id="nama_supplier" name="nama_supplier" class="form-control text-capitalize" placeholder="Nama Supplier" autocomplete="on">
				                                </div>
			                        	</div>
				                        <div class="modal-footer">
				                            <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Kembali</button>
				                            <button type="submit" class="btn btn-success">Iya, Tambah</button>
				                        </div>
				                    </form>
				                </div>
				            </div>
				        </div>
				    </div>
				</div>

				<table id="example" class="table items-table table table-bordered table-striped verticle-middle table-responsive-sm" style="min-width: 100%">
					<thead>
						<tr>
							<th style="text-align: center;">Kode Barang</th>
							<th style="text-align: center;">Nama Barang</th>
							<th style="text-align: center;">Stok Masuk</th>
							<th style="text-align: center;">Nama Supplier</th>
							<th style="text-align: center;">Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
                    $no=1;
                    foreach ($data as $dataa){?>
						<tr>
							<td style="text-align: center;" class="text-uppercase"><?php echo $dataa->kode_barang?></td>
							<td style="text-align: center;" class="text-capitalize"><?php echo $dataa->nama_barang?></td>
							<td style="text-align: center;" class="text-capitalize text-info">+ <?php echo $dataa->stok?> Stok Masuk</td>
							<td style="text-align: center;" class="text-capitalize"><?php echo $dataa->nama_supplier?></td>
							<td style="text-align: center;">
                                <a onclick="openDeleteModal('<?= base_url('/POS/hapus_barang_masuk/'.$dataa->id_barang_masuk )?>')">
								    <button type="button" class="btn btn-danger">
								        <i class="fa-solid fa-trash"></i>
								    </button>
								</a>
                            </td>
                            <div class="modal fade" id="delete_barang_masuk" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
							    <div class="modal-dialog modal-dialog-centered" role="document">
							        <div class="modal-content">
							            <div class="modal-header">
							                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
							            </div>
							            <div class="modal-body text-center">
							                <i class="fa-solid fa-triangle-exclamation" style="font-size: 80px; color: #FFA500;"></i>
							                <h1></h1><br>
							                <h5>Apakah anda yakin ingin menghapus data ini?</h5>
							            </div>
							            <div class="modal-footer">
							                <button type="button" class="btn btn-secondary light" data-bs-dismiss="modal">Kembali</button>
							                <a id="deleteLinkBarangMasuk" href="#">
							                    <button type="button" class="btn btn-danger">Iya, Hapus</button>
							                </a>
							            </div>
							        </div>
							    </div>
							</div>
							<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
							<script>
							    function openDeleteModal(deleteLink) {
							        document.getElementById('deleteLinkBarangMasuk').href = deleteLink;
							        $('#delete_barang_masuk').modal('show');
							    }
							</script>
                            <style>
							@keyframes blink {
			                    0% { opacity: 1; }
			                    50% { opacity: 0; }
			                    100% { opacity: 1; }
			                }

			                .blinking-icon {
			                    animation: blink 1s infinite; 
			                }

			                @keyframes blink-green {
			                    0% { opacity: 1; }
			                    50% { opacity: 0; }
			                    100% { opacity: 1; }
			                }

			                @keyframes blink-orange {
			                    0% { opacity: 1; }
			                    50% { opacity: 0; }
			                    100% { opacity: 1; }
			                }

			                .blinking-icon {
			                    animation-duration: 1s; 
			                    animation-iteration-count: infinite; 
			                }

			                .text-success .blinking-icon {
			                    animation-name: blink-green;
			                }

			                .text-warning .blinking-icon {
			                    animation-name: blink-orange; 
			                }
                            </style>
						</tr>
                    <?php }?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

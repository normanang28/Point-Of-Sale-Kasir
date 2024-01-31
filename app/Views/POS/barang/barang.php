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
				                        <h4 class="modal-title">Apakah anda yakin ingin menambah data barang?</h4>
				                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				                    </div>
				                    <form id="imageForm" class="form-horizontal form-label-left" action="<?= base_url('POS/tambah_barang')?>" method="post">
				                        <div class="modal-body">
				                            <div class="row">
				                                <div class="mb-3 col-md-6">
				                                    <label class="form-label">Kode Barang<span style="color: black;"> :</span></label>
				                                    <input type="text" id="kode_barang" name="kode_barang" class="form-control text-uppercase" placeholder="Kode Barang" autocomplete="on" maxlength="7">
				                                </div>
				                                <div class="mb-3 col-md-6">
				                                    <label class="form-label">Nama Barang<span style="color: black;"> :</span></label>
				                                    <input type="text" id="nama_barang" name="nama_barang" class="form-control text-capitalize" placeholder="Nama Barang" autocomplete="on">
				                                </div>
				                                <label class="form-label">Harga Barang<span style="color: black;">:</span></label>    
							                    <div class="input-group mb-3 input-basic">
							                        <span class="input-group-text">$</span>
							                        <input type="text" id="harga_barang" name="harga_barang" class="form-control text-capitalize" placeholder="Harga Barang"  autocomplete="on">
							                        <span class="input-group-text">.00</span>
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
							<th style="text-align: center;">Jumlah Tersedia</th>
							<th style="text-align: center;">Harga Barang</th>
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
							<td style="text-align: center;" class="text-capitalize <?php echo ($dataa->jumlah <= 0) ? 'text-danger' : ''; ?>">Tersedia <?php echo $dataa->jumlah; ?></td>
							<td style="text-align: center;" class="text-capitalize">Rp <?php echo number_format($dataa->harga_barang, 2, ',', '.'); ?>/BRG</td>
							<td class="button-container">
                                <a href="<?= base_url('/POS/edit_barang/'.$dataa->id_barang )?>"><button class="btn btn-warning"><i class="fa-regular fa-pen-to-square"></i></button></a>
                                <a onclick="openDeleteModal('<?= base_url('/POS/hapus_barang/'.$dataa->id_barang )?>')">
								    <button type="button" class="btn btn-danger">
								        <i class="fa-solid fa-trash"></i>
								    </button>
								</a>
                            </td>
                            <div class="modal fade" id="delete_barang" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
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
							                <a id="deleteLinkBarang" href="#">
							                    <button type="button" class="btn btn-danger">Iya, Hapus</button>
							                </a>
							            </div>
							        </div>
							    </div>
							</div>
							<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
							<script>
							    function openDeleteModal(deleteLink) {
							        document.getElementById('deleteLinkBarang').href = deleteLink;
							        $('#delete_barang').modal('show');
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

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
				                        <h4 class="modal-title">Apakah anda yakin ingin menambah data petugas?</h4>
				                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				                    </div>
				                    <form id="imageForm" class="form-horizontal form-label-left" action="<?= base_url('Data_Master/tambah_petugas')?>" method="post">
				                        <div class="modal-body">
				                            <div class="row">
				                                <div class="mb-3 col-md-6">
				                                    <label class="form-label">Nama Petugas<span style="color: black;"> :</span></label>
				                                    <input type="text" id="nama_petugas" name="nama_petugas" class="form-control text-capitalize" placeholder="Nama Petugas" autocomplete="on">
				                                </div>
				                                <div class="mb-3 col-md-6">
				                                    <label class="form-label">No Telepon<span style="color: black;"> :</span></label>
				                                    <input type="text" id="no_telp" name="no_telp" class="form-control text-capitalize" placeholder="No Telepon" oninput="validateNumberInput(this)" autocomplete="on">
				                                </div>
				                                <script>
						                        function validateNumberInput(input) {
						                            input.value = input.value.replace(/\D/g, '');

						                            if (input.value.length > 14) {
						                                input.value = input.value.slice(0, 14);
						                            }
						                        }
							                    </script>
				                                <div class="mb-3 col-md-6">
				                                    <label class="form-label">Username<span style="color: black;"> :</span></label>
				                                    <input type="text" id="username" name="username" class="form-control text-capitalize" placeholder="Username" autocomplete="on">
				                                </div>
				                                <div class="mb-3 col-md-6">
				                                    <label class="form-label">Level<span style="color: black;"> :</span></label>
				                                    <select id="level" class="form-control col-12" data-validate-length-range="6" data-validate-words="2" name="level" required="required">
					                                  <option>Pilih Level</option>
					                                  <option value="1">Super Admin</option>
					                                  <option value="2">Admin</option>
					                                  <option value="3">Kasir</option>
					                              	</select>
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
							<th style="text-align: center;">Nama Petugas</th>
							<th style="text-align: center;">No Telepon</th>
							<th style="text-align: center;">Status</th>
							<th style="text-align: center;">Maker</th>
							<th style="text-align: center;">Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
                    $no=1;
                    foreach ($data as $dataa){?>
						<tr>
							<td style="text-align: center;" class="text-capitalize"><?php echo $dataa->nama_petugas?></td>
							<td style="text-align: center;" class="text-capitalize"><?php echo $dataa->no_telp ?></td>
							<td style="text-align: center;" class="text-capitalize text-dark">
                                <?php if ($dataa->status == '1'){ ?>
                                    <i class="fas fa-circle text-success blinking-icon"></i> Aktif
                                <?php } else { ?>
                                    <i class="fas fa-circle text-warning blinking-icon"></i> Tidak Aktif
                                <?php } ?>
                            </td>
							<td style="text-align: center;" class="text-capitalize"><?php echo $dataa->username?> / <?php echo $dataa->tanggal_petugas?></td>
							<td class="d-flex justify-content-between">
                                <?php if($dataa->status == '1'): ?>
                                    <a href="<?= base_url('/Data_Master/tidak_aktif/'.$dataa->id_user_petugas)?>">
                                        <button class="btn btn-warning"><i class="fa-solid fa-user-xmark"></i></button>
                                    </a>
                                <?php elseif($dataa->status == '0'): ?>
                                    <a href="<?= base_url('/Data_Master/aktif/'.$dataa->id_user_petugas)?>">
                                        <button class="btn btn-success"><i class="fa-solid fa-user-check"></i></button>
                                    </a>
                                <?php endif; ?>

                                <a href="<?= base_url('/Data_Master/edit_petugas/'.$dataa->id_user_petugas)?>"><button class="btn btn-warning"><i class="fa-regular fa-pen-to-square"></i></button></a>
                                <a href="<?= base_url('/Data_Master/hapus_petugas/'.$dataa->id_user_petugas)?>"><button class="btn btn-danger"><i class="fa-solid fa-trash"></i></button></a>
                            </td>
                            <style>
							.btn {
							    margin-right: 5px; 
							}

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

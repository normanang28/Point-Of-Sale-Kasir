<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="card-body">
            <div class="basic-form">
                <form id="userForm" class="form-horizontal form-label-left" novalidate  action="<?= base_url('Data_Master/aksi_edit_petugas')?>" method="post">
                 <input type="hidden" name="id" value="<?= $data->id_user ?>">

                 <div class="row">
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Nama Petugas<span style="color: black;">:</span></label>
                        <input type="text" id="nama_petugas" name="nama_petugas" 
                        class="form-control text-capitalize" placeholder="Nama Petugas" value="<?= $data->nama_petugas?>" autocomplete="on">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">No Telepon<span style="color: black;">:</span></label>
                        <input type="text" id="no_telp" name="no_telp" 
                        class="form-control text-capitalize" placeholder="No Telepon" value="<?= $data->no_telp?>" oninput="validateNumberInput(this)" autocomplete="on">
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
                        <label class="form-label">Username<span style="color: black;">:</span></label>
                        <input type="text" id="username" name="username" 
                        class="form-control text-capitalize" placeholder="Username" value="<?= $data->username?>">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Level<span style="color: black;"> :</span></label>
                        <select id="level" class="form-control col-12" data-validate-length-range="6" data-validate-words="2" name="level" required="required">
                          <option value="<?= $data->level?>"><?= $data->level; ?></option>
                          <option value="1">Super Admin</option>
                          <option value="2">Admin</option>
                          <option value="3">Kasir</option>
                      </select>
                  </div>
              </div>
              <a href="<?= base_url('/Data_Master/petugas')?>"><button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Kembali</button></a>
              <button type="submit" id="updateButton" class="btn btn-success">Iya, Edit</button>
          </form>
      </div>
  </div>
</div>
</div>
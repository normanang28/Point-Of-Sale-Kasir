<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="card-body">
            <div class="basic-form">
                <form id="userForm" class="form-horizontal form-label-left" novalidate  action="<?= base_url('POS/aksi_edit_barang')?>" method="post">
                 <input type="hidden" name="id" value="<?= $data->id_barang ?>">

                 <div class="row">
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Kode Barang<span style="color: black;">:</span></label>
                        <input type="text" id="kode_barang" name="kode_barang" 
                        class="form-control text-uppercase" placeholder="Kode Barang" value="<?= $data->kode_barang?>" autocomplete="on" maxlength="7">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Nama Barang<span style="color: black;">:</span></label>
                        <input type="text" id="nama_barang" name="nama_barang" 
                        class="form-control text-capitalize" placeholder="Nama Barang" value="<?= $data->nama_barang?>" autocomplete="on">
                    </div>

                    <label class="form-label">Harga Barang<span style="color: black;">:</span></label>    
                    <div class="input-group mb-3 input-basic">
                        <span class="input-group-text">$</span>
                        <input type="text" id="harga_barang" name="harga_barang" class="form-control text-capitalize" placeholder="Harga Barang" value="<?= $data->harga_barang?>" autocomplete="on">
                        <span class="input-group-text">,00</span>
                    </div>
              </div>
              <a href="<?= base_url('/POS/barang')?>"><button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Kembali</button></a>
              <button type="submit" id="updateButton" class="btn btn-success">Iya, Edit</button>
          </form>
      </div>
  </div>
</div>
</div>
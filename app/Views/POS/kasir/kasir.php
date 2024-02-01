<div class="col-md-5 col-sm-5 col-xs-5">
    <div class="card">
        <div class="card-body">
            <div class="basic-form">
                <form id="userForm" class="form-horizontal form-label-left" novalidate  action="<?= base_url('POS/tambah_kasir')?>" method="post">

                <h3 class="text-center">N - Point Of Sale</h3><br>
                <div class="mb-3 col-md-12">
                    <label class="form-label">Nama Barang<span style="color: black;">:</span></label>
                    <input type="text" id="nama_barang" name="nama_barang" 
                    class="form-control text-capitalize" placeholder="Nama Barang" autocomplete="on">
                </div>
                <div class="mb-3 col-md-12">
                    <label class="form-label">Stok<span style="color: black;">:</span></label>
                    <input type="text" id="stok" name="stok" 
                    class="form-control text-capitalize" placeholder="Stok" autocomplete="on">
                </div>
                <div class="mb-3 col-md-12">
                    <label class="form-label">Total<span style="color: black;">:</span></label>
                    <input type="text" id="stok" name="stok" 
                    class="form-control text-capitalize" placeholder="Stok" autocomplete="on">
                </div>

              <a href="<?= base_url('/POS/kasir')?>"><button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Kembali</button></a>
              <button type="submit" id="updateButton" class="btn btn-success">Iya, Tambah</button>
          </form>
      </div>
  </div>
</div>
</div>
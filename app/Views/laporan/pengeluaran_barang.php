<!DOCTYPE html>
<html>
<head>
  <style>
    body {
      font-family: Arial, sans-serif;
      text-transform: capitalize;
    }

    .container {
      max-width: 8000px;
      margin: 0 auto;
      padding: 20px;
    }

    .header {
      text-align: center;
      margin-bottom: 20px;
    }

    .header img {
      width: 100%;
      height: auto;
    }

    .table-container {
      margin-top: 20px;
    }

    table {
      width: 100%; 
      border-collapse: collapse;
    }

    th, td {
      border: 1px solid #000;
      padding: 8px;
      text-align: center;
    }

    th {
      background-color: #f2f2f2;
    }

    td:nth-child(2) {
      text-align: center;
      text-transform: uppercase;
    }

    td:nth-child(4) {
      text-align: center;
      text-transform: capitalize;
      color: blue;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <h1>Laporan Pengeluaran Barang</h1>
    </div>

    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th class="text-center">Tanggal</th>
            <th class="text-center">Kode Barang</th>
            <th class="text-center">Nama Barang</th>
            <th class="text-center">Stok Penjualan</th>
            <th class="text-center">Total Penjualan</th>
            <th class="text-center">Dibayar</th>
            <th class="text-center">Kembalian</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          foreach ($data as $dataa) {
            ?>
            <tr>
              <td class="text-capitalize text-center"><?php echo $dataa->tgl_bk?></td>
              <td class="text-uppercase text-center"><?php echo $dataa->kode_barang?></td>
              <td class="text-capitalize text-center"><?php echo $dataa->nama_barang?></td>
              <td class="text-center text-capitalize text-dark text-success"><?php echo $dataa->stok?></td>
              <td class="text-capitalize text-center">Rp <?php echo number_format($dataa->total, 2, ',', '.'); ?></td>
              <td class="text-capitalize text-center">Rp <?php echo number_format($dataa->cash, 2, ',', '.'); ?></td>
              <td class="text-capitalize text-center">Rp <?php echo number_format($dataa->kembalian, 2, ',', '.'); ?></td>
            </tr>
          <?php }?>
        </tbody>
      </table>
    </div>
  </div>

  <script>
    window.print();
  </script>
</body>
</html>

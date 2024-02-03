<div class="row">
<div class="col-md-5 col-sm-5 col-xs-5">
    <div class="card">
        <div class="card-body">
            <div class="basic-form">
                <form id="userForm" class="form-horizontal form-label-left" novalidate action="<?= base_url('POS/tambah_kasir') ?>" method="post">

                    <h3 class="text-center"><b>N - Point Of Sale</b></h3><br>
                    <div style="display: flex; justify-content: space-between;">
                        <span class="text-capitalize">Kasir : <?= session()->get('nama_petugas') ?></span>
                        <span id="tanggalSpan"></span>
                    </div>
                    <script>
                        var currentDate = new Date();
                        currentDate.toLocaleString('en-ID', { timeZone: 'Asia/Jakarta' });
                        var formattedDate = currentDate.toLocaleDateString('en-ID', { day: 'numeric', month: 'long', year: 'numeric' });
                        document.getElementById('tanggalSpan').innerText = "Tanggal : " + formattedDate;
                    </script>

                    <hr>
                    <div class="mb-3 col-md-12">
                        <label class="form-label">Nama Barang<span style="color: black;"> :</span></label>
                        <select name="id_barang" class="form-control text-capitalize" id="id_barang" required autocomplete="on">
                            <option disabled selected>Pilih Nama Barang</option>
                            <?php foreach ($p as $brg) { ?>
                                <?php
                                    $stokColor = ($brg->jumlah <= 0) ? 'color: red;' : '';             ?>
                                <option class="text-capitalize" value="<?php echo $brg->id_barang ?>" style="<?php echo $stokColor; ?>">
                                    <?php echo $brg->nama_barang ?>, Tersedia <?php echo $brg->jumlah ?> - (Rp <?php echo number_format($brg->harga_barang, 2, ',', '.') ?>/BRG)
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3 col-md-12">
                        <label class="form-label">QTY<span style="color: black;"> :</span></label>
                        <input type="text" id="stok" name="stok" class="form-control text-capitalize" placeholder="QTY" oninput="validateNumberInput(this)" autocomplete="on">
                    </div>
                    <script>
                        function validateNumberInput(input) {
                            input.value = input.value.replace(/\D/g, '');
                        }
                    </script>
                    <div class="mb-3 col-md-12">
                        <label class="form-label">Dibayar<span style="color: black;"> :</span></label>
                        <input type="text" id="cash" name="cash" class="form-control text-capitalize" placeholder="Dibayar" oninput="validateDibayarInput(this)" autocomplete="on">
                    </div>
                    <script>
                        function validateDibayarInput(input) {
                            input.value = input.value.replace(/\D/g, '');
                        }
                    </script>
                    <div class="mb-3 col-md-12">
                        <label class="form-label">Kembalian<span style="color: black;"> :</span></label>
                        <input type="text" id="kembalian" name="kembalian" class="form-control text-capitalize" placeholder="Total Kembalian Rp 0,00" autocomplete="on" readonly style="background-color: #dddddd;">
                    </div>

                    <button type="submit" id="updateButton" class="btn btn-success">Total Pembayaran Rp 0,00</button>
                    <style>
                        #updateButton {
                            width: 100%;
                            text-align: center;
                            margin: 0 auto;
                        }
                    </style>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        function updateTotalPayment() {
            var selectedItemId = document.getElementById('id_barang').value;
            var selectedQty = document.getElementById('stok').value;
            var selectedPrice = getPriceById(selectedItemId);
            var totalPayment = selectedQty * selectedPrice;
            var cashInput = document.getElementById('cash').value;
            var kembalian = cashInput - totalPayment;

            document.getElementById('updateButton').innerHTML = 'Total Pembayaran Rp ' + totalPayment.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
            
            var kembalianField = document.getElementById('kembalian');
            kembalianField.value = kembalian.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, '');
            
            if (kembalian < 0) {
                kembalianField.classList.add('text-danger');
            } else {
                kembalianField.classList.remove('text-danger');
            }
        }

        function getPriceById(itemId) {
            var items = <?php echo json_encode($p); ?>;
            var selectedPrice = 0;

            items.forEach(function (item) {
                if (item.id_barang == itemId) {
                    selectedPrice = item.harga_barang;
                }
            });

            return selectedPrice;
        }

        document.getElementById('id_barang').addEventListener('change', updateTotalPayment);
        document.getElementById('stok').addEventListener('input', updateTotalPayment);
        document.getElementById('cash').addEventListener('input', updateTotalPayment);

        updateTotalPayment();
    });
</script>

<div class="col-md-7 col-sm-7 col-xs-7">
    <button type="button" class="btn btn-info mb-2" data-bs-toggle="modal" data-bs-target="#calculatorModal">
        <i class="fa-solid fa-calculator"></i> Kalkulator
    </button><h1></h1>

    <div class="modal fade-up" id="calculatorModal" tabindex="-1" aria-labelledby="calculatorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-end">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="calculatorModalLabel">Kalkulator</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="calculator">
                    <input type="text" id="display" class="form-control mb-2" disabled>
                    <div class="calculator-buttons">
                        <button class="btn btn-secondary" onclick="clearDisplay()">C</button>
                        <button class="btn btn-secondary" onclick="appendToDisplay('/')">&#247;</button>
                        <button class="btn btn-secondary" onclick="appendToDisplay('*')">&#215;</button>
                        <button class="btn btn-secondary" onclick="appendToDisplay('7')">7</button>
                        <button class="btn btn-secondary" onclick="appendToDisplay('8')">8</button>
                        <button class="btn btn-secondary" onclick="appendToDisplay('9')">9</button>
                        <button class="btn btn-secondary" onclick="appendToDisplay('-')">-</button>
                        <button class="btn btn-secondary" onclick="appendToDisplay('4')">4</button>
                        <button class="btn btn-secondary" onclick="appendToDisplay('5')">5</button>
                        <button class="btn btn-secondary" onclick="appendToDisplay('6')">6</button>
                        <button class="btn btn-secondary" onclick="appendToDisplay('+')">+</button>
                        <button class="btn btn-secondary" onclick="appendToDisplay('1')">1</button>
                        <button class="btn btn-secondary" onclick="appendToDisplay('2')">2</button>
                        <button class="btn btn-secondary" onclick="appendToDisplay('3')">3</button>
                        <button class="btn btn-secondary btn-clear" onclick="clearDisplay()">C</button>
                        <button class="btn btn-secondary" onclick="appendToDisplay('0')">0</button>
                        <button class="btn btn-secondary" onclick="appendToDisplay('.')">.</button>
                        <button class="btn btn-secondary btn-equal" onclick="calculate()">=</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function appendToDisplay(value) {
        document.getElementById('display').value += value;
    }

    function clearDisplay() {
        document.getElementById('display').value = '';
    }

    function calculate() {
        try {
            document.getElementById('display').value = eval(document.getElementById('display').value);
        } catch (error) {
            document.getElementById('display').value = 'Error';
        }
    }

    document.addEventListener('keydown', function (event) {
        const key = event.key;

        if (/[\d\+\-\*\/\.]/.test(key)) {
            appendToDisplay(key);
        } else if (key === 'Enter') {
            calculate();
        } else if (key === 'Escape') {
            clearDisplay();
        }
    });
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/your-fontawesome-kit.js"></script>

    <style>
    .modal.fade-up .modal-dialog {
        position: fixed;
        bottom: 0; 
        right: 0;
        margin: 0;
    }

    @keyframes fadeInLeft {
        from {
            opacity: 0;
            transform: translateX(100%);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .modal.fade-up .modal-dialog {
        animation: fadeInLeft 0.5s ease-out; 
    }

    body {
        background-color: #f8f9fa;
    }

    .calculator {
        text-align: center;
    }

    #display {
        width: 100%;
        margin-bottom: 10px;
        padding: 10px;
        font-size: 1.5em;
        border: 1px solid #ced4da;
        border-radius: 5px;
        background-color: #ffffff;
    }

    .calculator-buttons {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 10px;
        justify-content: center;
    }

    .btn-secondary {
        font-size: 1.5em;
        padding: 15px;
    }

    .btn-clear {
        grid-column: span 2;
    }

    .btn-equal {
        grid-column: span 2;
        background-color: #007bff;
        color: #ffffff;
    }
    </style>

    <div class="row" id="tableBody">
        <?php foreach ($p as $dataa): ?>       
            <div class="col-7 col-sm-7 col-md-7 col-lg-3 mb-5 mb-lg-0" data-aos="fade-left" data-aos-delay="100">
                <div class="media-1 position-relative">
                    <img src="/barang/default_brg.jpg" alt="Image" class="img-fluid"><h1></h1>
                    <div class="d-flex align-items-center">
                        <div>
                            <h4 class="text-uppercase"><?php echo $dataa->kode_barang ?></h4>
                            <span class="text-uppercase">Rp <?php echo number_format($dataa->harga_barang, 2, ',', '.') ?></span>
                            <span class="text-capitalize" style="color: <?php echo ($dataa->jumlah < 0) ? 'red' : (($dataa->jumlah == 0) ? 'red' : 'inherit'); ?>">
                                Tersedia <?php echo $dataa->jumlah; ?>
                            </span>
                        </div>
                    </div>
                </div><br>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="d-flex justify-content-end gap-2">
        <div class="pagination">
            <nav>
                <ul class="pagination pagination-sm">
                    <li class="page-item page-indicator" id="previousPageButton">
                        <a class="page-link" href="javascript:void(0)">
                            <i class="la la-angle-left"></i></a>
                    </li>
                    <li class="page-item" id="currentPageNumber">1</li>
                    <li class="page-item page-indicator" id="nextPageButton">
                        <a class="page-link" href="javascript:void(0)">
                            <i class="la la-angle-right"></i></a>
                    </li>
                </ul>
            </nav>
        </div>
        <style>
            .pagination {
                display: flex;
                justify-content: flex-end; 
                align-items: center; 
            }

            .page-numbers button {
                margin-left: 5px; 
                font-size: 14px; 
                padding: 5px 10px;
            }

            .center-column {
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .center-column .btn {
                margin-top: 5px; 
            }

            .button-container {
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .media-1 img {
                border-radius: 10px; 
            }
            .img-fluid {
                box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.4); 
            }
        </style>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const tableBody = document.getElementById('tableBody');
                const currentPageNumber = document.getElementById('currentPageNumber');
                const previousPageButton = document.getElementById('previousPageButton');
                const nextPageButton = document.getElementById('nextPageButton');

                const data = <?= json_encode($p) ?>; 
                const itemsPerPage = 8;
                let currentPage = 1;
                const totalPages = Math.ceil(data.length / itemsPerPage);

                function displayDataOnPage(page) {
                    tableBody.innerHTML = '';

                    const startIndex = (page - 1) * itemsPerPage;
                    const endIndex = startIndex + itemsPerPage;

                    for (let i = startIndex; i < endIndex && i < data.length; i++) {
                        const gas = data[i];
                        const row = `
                            <div class="col-7 col-sm-7 col-md-7 col-lg-3 mb-5 mb-lg-0" data-aos="fade-left" data-aos-delay="100">
                                <div class="media-1 position-relative">
                                    <img src="/barang/default_brg.jpg" alt="Image" class="img-fluid">
                                    <h1></h1>
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <h4 class="text-uppercase"><?php echo $dataa->kode_barang ?></h4>
                                            <span class="text-uppercase">Rp <?php echo number_format($dataa->harga_barang, 2, ',', '.') ?></span>
                                            <span class="text-capitalize" style="color: <?php echo ($dataa->jumlah < 0) ? 'red' : (($dataa->jumlah == 0) ? 'red' : 'inherit'); ?>">
                                                Tersedia <?php echo $dataa->jumlah; ?>
                                            </span>
                                        </div>
                                    </div>
                                </div><br>
                            </div>
                        `;
                        tableBody.innerHTML += row;
                    }
                }

                function updatePageNumbers() {
                    currentPageNumber.textContent = currentPage;
                }

                previousPageButton.addEventListener('click', function () {
                    if (currentPage > 1) {
                        currentPage--;
                        displayDataOnPage(currentPage);
                        updatePageNumbers();
                    }
                });

                nextPageButton.addEventListener('click', function () {
                    if (currentPage < totalPages) {
                        currentPage++;
                        displayDataOnPage(currentPage);
                        updatePageNumbers();
                    }
                });

                displayDataOnPage(currentPage);
                updatePageNumbers();
            });
        </script>
    </div>
</div>
</div><br>


<div class="col-md-12 col-sm-12 col-xs-12" data-aos="fade-up" data-aos-delay="50">
    <div class="card">
        <div class="card-body">

            <div class="alert alert-info" role="alert" data-aos="fade-down" data-aos-delay="100">
                <i class="fa-solid fa-triangle-exclamation"></i>
                Untuk menghapus list barang, silakan pilih data yang ingin dihapus dan klik tombol merah.
            </div>
            <style>
            @keyframes blink {
              0% { opacity: 1; }
              50% { opacity: 0; }
              100% { opacity: 1; }
            }

            .alert-info i.fa-triangle-exclamation {
              animation: blink 1s infinite;
            }
            </style>

            <div class="d-flex justify-content-end gap-2">
                <a href="<?= base_url('POS/print_invoice')?>"><button type="button" class="btn btn-info mb-2">
                    <i class="fa-solid fa-print"></i> Print Invoice
                </button></a>

                <button type="button" class="btn btn-danger mb-2" id="deleteSelected">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </div><br>

            <div class="modal fade" id="delete_barang_keluar" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
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
                            <button type="button" class="btn btn-secondary light" data-bs-dismiss="modal" style="height: 56px; width: 26%; font-size: 16px">Kembali</button>
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
                    $('#delete_barang_keluar').modal('show');
                }
            </script>
            <script>
                $(document).ready(function() {
                    $('#deleteSelected').on('click', function() {
                        var checkedItems = $('.delete-checkbox:checked');
                        if (checkedItems.length > 0) {
                            var deleteLinks = [];
                            checkedItems.each(function() {
                                var deleteLink = $(this).data('id');
                                deleteLinks.push(deleteLink);
                            });

                            console.log(deleteLinks); 

                            var deleteLink = '<?= base_url('/POS/hapus_barang_keluar/') ?>' + '/' + deleteLinks.join('/');
                            console.log(deleteLink);
                            openDeleteModal(deleteLink);
                        }
                    });
                });
            </script>

            <div class="table-responsive">
                <table id="example" class="display" style="min-width: 100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th style="text-align: center;">Kode</th>
                            <th style="text-align: center;">Nama Barang</th>
                            <th style="text-align: center;">QTY</th>
                            <th style="text-align: center;">Dibayar</th>
                            <th style="text-align: center;">Kembalian</th>
                            <th style="text-align: center;">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $no=1;
                    foreach ($data as $dataa){?>
                        <tr>
                            <td>
                                <input type="checkbox" class="checkbox__input delete-checkbox" value="<?= $dataa->id_barang_keluar ?>" name="kasir[]" id="kasir_<?= $dataa->id_barang_keluar ?>" data-id="<?= $dataa->id_barang_keluar ?>"/>
                            </td>
                            <td style="text-align: center;" class="text-uppercase"><?php echo $dataa->kode_barang?></td>
                            <td style="text-align: center;" class="text-capitalize"><?php echo $dataa->nama_barang?></td>
                            <td style="text-align: center;" class="text-capitalize"><?php echo $dataa->stok?></td>
                            <td style="text-align: center;" class="text-capitalize">Rp <?php echo number_format($dataa->cash, 2, ',', '.'); ?></td>
                            <td style="text-align: center;" class="text-capitalize">Rp <?php echo number_format($dataa->kembalian, 2, ',', '.'); ?></td>
                            <td style="text-align: center;" class="text-capitalize">Rp <?php echo number_format($dataa->total, 2, ',', '.'); ?></td>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="deznav">
    <div class="deznav-scroll">
        <ul class="metismenu" id="menu">
<?php  if(session()->get('id')>0) { ?>
        <li><a href="<?= base_url('/Dashboard')?>" class="ai-icon" aria-expanded="false">
                <i class="fa-solid fa-house-lock" title="Dashboard"></i>
                <span  class="nav-text">Dashboard</span>
            </a>
        </li>
<?php }else{} ?>
<?php  if(session()->get('level')== 1) { ?>
        <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
            <i class="fa-solid fa-chalkboard-user" title="User"></i>
            <span class="nav-text">User</span>
        </a>
        <ul aria-expanded="false">
            <li><a href="<?= base_url('/Data_Master/petugas')?>">Data Petugas</a></li>
        </ul>
        </li>
<?php }else{} ?>
<?php  if(session()->get('level')== 1 || session()->get('level')== 2) { ?>
        <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
            <i class="fa-solid fa-hand-holding-dollar" title="Point Of Sale"></i>
            <span class="nav-text">Point Of Sale</span>
        </a>
        <ul aria-expanded="false">
            <li><a href="<?= base_url('/POS/barang')?>">Barang</a></li>
            <li><a href="<?= base_url('/POS/pendataan_barang')?>">Pendataan Barang</a></li>
        </ul>
        </li>
<?php }else{} ?>
<?php  if(session()->get('level')== 1 || session()->get('level')== 3) { ?>
        <li><a href="<?= base_url('/POS/kasir')?>" class="ai-icon" aria-expanded="false">
                <i class="fa-solid fa-cash-register" title="Kasir"></i>
                <span  class="nav-text">Kasir</span>
            </a>
        </li>
<?php }else{} ?>
<?php  if(session()->get('level')== 1 || session()->get('level')== 2) { ?>
        <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
            <i class="fa-solid fa-file-invoice-dollar" title="Laporan Point Of Sale"></i>
            <span class="nav-text">Laporan POS</span>
        </a>
        <ul aria-expanded="false">
            <li><a href="<?= base_url('/Laporan/pendataan_barang')?>">Pendataan Barang</a></li>
            <li><a href="<?= base_url('/Laporan/pengeluaran_barang')?>">Pengeluaran Barang</a></li>
        </ul>
        </li>
<?php }else{} ?>
        <hr class="sidebar-divider">
<?php  if(session()->get('id')>0) { ?>
        <li><a href="<?= base_url('/My_Account')?>" class="ai-icon" aria-expanded="false">
            <i class="fa-solid fa-user-secret" title="My Account"></i>
                <span  class="nav-text">My Account</span>
            </a>
        </li>
<?php }else{} ?>
        <li><a href="<?= base_url('/Home/logout')?>" class="ai-icon" aria-expanded="false">
            <i class="fa-solid fa-right-from-bracket" title="Log Out"></i>
            <span class="nav-text">Log Out</span>
        </a>
        </li>
        </ul>
    </div>
</div>

<div class="content-body">
    <div class="container-fluid">
        <div class="form-head d-flex mb-3 align-items-start">
        <div class="me-auto d-none d-lg-block">
            <?php
            $level = session()->get('level'); 
            $nama_petugas = session()->get('nama_petugas');

            $userLevelText = "";

            if ($level == 1) {
                $userLevelText = "Super Admin";
            } elseif ($level == 2) {
                $userLevelText = "Admin";
            } elseif ($level == 3) {
                $userLevelText = "Kasir";
            } else {
                $userLevelText = "";
            }

            $namaToShow = $nama_petugas ? $nama_petugas : "";

            echo "<p class='mb-0 text-capitalize'>Welcome <b>$namaToShow - $userLevelText</b> to N Point Of Sale" . session()->get('nama_website') . "!</p>";
            ?>
        </div>
        <b><span id="currentDateTime"></span></b>
    </div>


    <script>
        function updateDateTime() {
            const dateTimeElement = document.getElementById('currentDateTime');
            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: 'numeric',
                minute: '2-digit',
                second: '2-digit',
                hour12: true, 
            };

            const currentDateTime = new Date().toLocaleString(undefined, options);
            dateTimeElement.textContent = currentDateTime.replace(',', ' at');
        }

        setInterval(updateDateTime, 1000);

        updateDateTime();
    </script>



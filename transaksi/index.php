<?php 
include '../helper/function.php';

include '../helper/Siswa.php';
include '../helper/Transaksi.php';

khusus_back_office();



$siswaObjek = new Siswa();
$semua_siswa = $siswaObjek->semua();

?>
<?php include('../sparepart/header.php');?>
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Daftar siswa</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nominal</th>
                            <th>Tahun Ajaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($semua_siswa as $siswa):?>
                        <tr>    
                            <td><?= $siswa['nama']?></td>
                            <td><?= $siswa['telepon']?></td>
                            <td>
                                <a href="tambah.php?id=<?= $siswa['id']?>" class="btn btn-warning"> Tambah </a>
                                <a href="history.php?id=<?= $siswa['id']?>" class="btn btn-info"> History </a>
                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php include('../sparepart/footer.php');?>       
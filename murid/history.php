<?php 
include '../helper/function.php';
include '../helper/Transaksi.php';

khusus_siswa();

$id = $_SESSION['user']['id']; // ini adalah id siswa
$transaksiObjek = new Transaksi();
$semua_transaksi = $transaksiObjek->semua($id);
?>


<?php include('../sparepart/header.php');?>
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Daftar transaksi Anda</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Transaksi</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Bulan Dibayar</th>
                            <th>Tahun Dibayar</th>
                            <th>Tanggal Bayar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($semua_transaksi as $transaksi):?>
                        <tr>    
                            <td><?= cetakNamaBulan($transaksi['bulan_dibayar'])?></td>
                            <td><?= $transaksi['tahun_dibayar']?></td>
                            <td><?= $transaksi['tanggal_bayar']?></td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php include('../sparepart/footer.php');
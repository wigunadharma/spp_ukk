<?php 
include '../helper/function.php';

include '../helper/Siswa.php';
include '../helper/Transaksi.php';
include '../helper/Pembayaran.php';

khusus_back_office();


$id_siswa = $_GET['id'];    

$siswaObjek = new Siswa();
$siswa = $siswaObjek->cari($id_siswa);

$pembayaranObjek = new Pembayaran();
$transaksiObjek = new Transaksi();

$tahun_ajaran = $pembayaranObjek->ambil_tahun_berdasarkan_idsiswa($id_siswa);
$semua_bulan = [1,2,3,4,5,6,7,8,9,10,11,12];
$bulan_dibayar = $transaksiObjek->ambil_bulan_sudah_dibayar($id_siswa, $tahun_ajaran);
$informasi_bulan = [];

foreach ($semua_bulan as $angka_bulan) {
    $informasi = [
        'nama_bulan' => cetakNamaBulan($angka_bulan),
        'angka_bulan' => $angka_bulan,
    ];
    if (in_array($angka_bulan, $bulan_dibayar)) {
        $informasi['sudah_dibayar'] = true;
    } else {
        $informasi['sudah_dibayar'] = false;
    }
    $informasi_bulan[] = $informasi;
}

if (isset($_POST['submit'])) {
    $data = $_POST;
    $data['tanggal_bayar'] = date('Y-m-d H:i:s');
    $data['id'] = $_SESSION['user']['id']; //ini adalah id_petugas
    $transaksiObjek->tambah($data);
    
    // refresh halaman dengan javascript
    echo '<script>window.location.href = ""</script>';
}
?>
<?php include('../sparepart/header.php');?>
<div class="container-fluid">
    <h4>Entry Transaksi <?= $siswa['nama']?></h4>
    <a href="history.php?id=<?= $id_siswa?>" class="btn btn-warning">History</a>
    <div class="row">

        <?php foreach($informasi_bulan as $bulan) :?>
        <form class="col-4 p-2" method="post">
            <div class="card p-3">
                <p>Bulan <?=($bulan['nama_bulan'])?></p>
                <input type="hidden" name="bulan_dibayar" value="<?= $bulan['angka_bulan']?>">
                <input type="hidden" name="tahun_dibayar" value="<?= $tahun_ajaran?>">
                <input type="hidden" name="siswa_id" value="<?= $id_siswa?>">
                <input type="hidden" name="pembayaran_id" value="<?= $siswa['pembayaran_id']?>">
                <button name="submit" class="btn btn-primary" <?php if($bulan['sudah_dibayar']):?> disabled <?php endif;?>   >
                    <?php if($bulan['sudah_dibayar']):?>
                        Telah lunas
                    <?php else:?>
                        Lunaskan
                    <?php endif;?>
                </button>
            </div>
        </form>
        <?php endforeach;?>
    </div>
</div>
<?php include('../sparepart/footer.php');?>
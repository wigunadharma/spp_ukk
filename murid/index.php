<?php 
include '../helper/function.php';
khusus_siswa();
?>

<?php include('../sparepart/header.php');?>
    <div class="container-fluid">
        <h4>Selamat Datang <?= $_SESSION['user']['nama']?></h4>
    </div>
<?php include('../sparepart/footer.php');?>
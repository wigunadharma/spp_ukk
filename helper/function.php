<?php
 
$servername= "localhost";
$username= "root";
$password= "";
$dbname= "sppsekolah";

$koneksi = mysqli_connect($servername, $username, $password, $dbname);

if (! session_id()) {
    session_start();
}

function cetakNamaBulan($angka_bulan) {
    switch($angka_bulan) {
        case 1: return 'Januari';
        case 2: return 'Februari';
        case 3: return 'Maret';
        case 4: return 'April';
        case 5: return 'Mei';
        case 6: return 'Juni';
        case 7: return 'Juli';
        case 8: return 'Agustus';
        case 9: return 'September';
        case 10: return 'Oktober';
        case 11: return 'November';
        case 12: return 'Desember';
    }
}

function wajib_login()
{
    if (!isset($_SESSION['user'])) {
        // saya mengalihkannya ke halaman login jika orang yang tidak login mencoba mengakses halaman admin misalnya
        header('location: ../index.php');
        die;
    }
}

function khusus_siswa()
{
    wajib_login();
    if ($_SESSION['user']['role'] != 'Siswa') {
        header('Location: ../admin/index.php');
        die;
    }
}

function khusus_admin()
{
    wajib_login();
    khusus_back_office();
    
    if ($_SESSION['user']['role'] != 'Admin') {
        header('Location: ../admin/index.php');
        die;
    }
}

function khusus_back_office()
{
    wajib_login();
    if ($_SESSION['user']['role'] == 'Siswa') {
        header('Location: ../murid/index.php');
        die;
    }
}
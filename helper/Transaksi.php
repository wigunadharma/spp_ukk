<?php

class Transaksi
{
    // digunakan untuk history
    public function semua($siswa_id)
    {
        global $koneksi;
        $sql = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE siswa_id = '$siswa_id'");
        $semua_transaksi = mysqli_fetch_all($sql, MYSQLI_ASSOC);
        return $semua_transaksi;
    }

   public function ambil_bulan_sudah_dibayar($id_siswa, $tahun_ajaran)
   {
        global $koneksi;
        $sql = mysqli_query($koneksi, "SELECT bulan_dibayar FROM transaksi INNER JOIN pembayaran ON pembayaran.id = transaksi.pembayaran_id WHERE siswa_id = '$id_siswa' AND tahun_ajaran = '$tahun_ajaran'");
        $bulan_dibayar = mysqli_fetch_all($sql, MYSQLI_ASSOC);
        $result = array_map(function($item) {
            return $item['bulan_dibayar'];
        }, $bulan_dibayar);

        if ($result == null) {
            return [];
        } else {
            return $result;
        }
   }

   public function tambah($data)
   {
        global $koneksi;
        $tanggal_bayar = $data['tanggal_bayar'];
        $bulan_dibayar = $data['bulan_dibayar'];
        $tahun_dibayar = $data['tahun_dibayar'];
        $siswa_id = $data['siswa_id'];
        $petugas_id = $data['id'];
        $pembayaran_id = $data['pembayaran_id'];
        $sql = mysqli_query($koneksi, "INSERT INTO transaksi VALUES (NULL, '$tanggal_bayar', '$bulan_dibayar', '$tahun_dibayar','$siswa_id','$petugas_id','$pembayaran_id')");
   }

   public function total_pemasukan_bulan($angka_bulan, $tahun_ajaran)
   {
       global $koneksi;
       $sql = mysqli_query($koneksi, 
       "SELECT SUM(nominal) FROM transaksi INNER JOIN pembayaran 
          ON transaksi.pembayaran_id = pembayaran.id 
          WHERE bulan_dibayar = '$angka_bulan' 
          AND tahun_ajaran = '$tahun_ajaran'
       ");
          
       $total_pemasukan = mysqli_fetch_array($sql, MYSQLI_NUM);
       return $total_pemasukan[0];
   }
}
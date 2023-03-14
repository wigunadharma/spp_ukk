<?php 
class Pembayaran
{
    public function semua()
    {
        global $koneksi;
        $sql = mysqli_query($koneksi, "SELECT * FROM pembayaran");
        $semua_kelas = mysqli_fetch_all($sql, MYSQLI_ASSOC);
        return $semua_kelas;
    }

    public function tambah($data)
    {
        global $koneksi;
        $nominal = $data['nominal'];
        $tahun_ajaran = $data['tahun_ajaran'];

        $sql = mysqli_query($koneksi,  "INSERT INTO pembayaran VALUES (NULL, '$nominal', '$tahun_ajaran')");
    }

    public function cari($id)
    {
        global $koneksi;
        $sql = mysqli_query($koneksi, "SELECT * FROM pembayaran WHERE id = '$id'");
        $pembayaran = mysqli_fetch_assoc($sql);
        return $pembayaran;
    }
    public function update($id, $data)
    {
        global $koneksi;
        $nominal= $data['nominal'];
        $tahun_ajaran = $data['tahun_ajaran'];

        $sql = mysqli_query($koneksi, "UPDATE pembayaran SET nominal = '$nominal', tahun_ajaran = '$tahun_ajaran' WHERE id = '$id'");
    }

    public function hapus($id)
    {
        global $koneksi;
        $sql = mysqli_query($koneksi, "DELETE FROM pembayaran WHERE id = '$id'");
    }

    public function ambil_tahun_berdasarkan_idsiswa($idsiswa)
    {
        global $koneksi;
        $sql = mysqli_query($koneksi,"SELECT tahun_ajaran FROM pembayaran 
            INNER JOIN siswa ON pembayaran.id = siswa.pembayaran_id
            WHERE siswa.id = '$idsiswa'");
        $pembayaran = mysqli_fetch_assoc($sql);
        return $pembayaran['tahun_ajaran'];
    }
}
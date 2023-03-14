<?php 
class Kelas
{
    public function semua()
    {
        global $koneksi;
        $sql = mysqli_query($koneksi, "SELECT * FROM kelas");
        $semua_kelas = mysqli_fetch_all($sql, MYSQLI_ASSOC);
        return $semua_kelas;
    }

    public function tambah($data)
    {
        global $koneksi;
        $nama = $data['nama'];
        $jurusan = $data['jurusan'];

        $sql = mysqli_query($koneksi,  "INSERT INTO kelas VALUES (NULL, '$nama', '$jurusan')");
    }

    public function cari($id)
    {
        global $koneksi;
        $sql = mysqli_query($koneksi, "SELECT * FROM kelas WHERE id = '$id'");
        $kelas = mysqli_fetch_assoc($sql);
        return $kelas;
    }
    public function update($id, $data)
    {
        global $koneksi;
        $nama = $data['nama'];
        $jurusan = $data['jurusan'];

        $sql = mysqli_query($koneksi, "UPDATE kelas SET nama = '$nama', jurusan = '$jurusan' WHERE id = '$id'");
    }
    public function hapus($id)
    {
        global $koneksi;
        $sql= mysqli_query($koneksi, "DELETE FROM kelas WHERE id = '$id'");
    }
}
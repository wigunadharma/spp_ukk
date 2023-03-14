<?php

class Siswa 
{
    public function semua()
    {
        global $koneksi;
        $sql = mysqli_query($koneksi, "SELECT * FROM siswa");
        $semua_siswa = mysqli_fetch_all($sql, MYSQLI_ASSOC);
        return $semua_siswa;
    }

    public function cari($id)
    {
        global $koneksi;
        $sql = mysqli_query($koneksi, "SELECT * FROM siswa WHERE id = '$id'");
        $siswa = mysqli_fetch_assoc($sql);
        return $siswa;
    }

    public function cari_via_pengguna($pengguna_id)
    {
        global $koneksi;
        $pengguna_siswa_query = "SELECT siswa.*, pengguna.username FROM siswa
            INNER JOIN pengguna ON siswa.pengguna_id = pengguna.id
            WHERE pengguna_id = '$pengguna_id'";
        $sql = mysqli_query($koneksi, $pengguna_siswa_query);
        $siswa = mysqli_fetch_assoc($sql);
        return $siswa;
    }

    public function tambah($data)
    {
        // kebutuhan pengguna, nis akan digunakan sebagai username
        $password = $data['password'];
        $role = 'Siswa';

        // kebutuhan siswa
        $nisn = $data['nisn'];
        $nis = $data['nis'];
        $nama = $data['nama'];
        $telepon = $data['telepon'];
        $alamat = $data['alamat'];
        $pembayaran_id = $data['pembayaran_id'];
        $kelas_id = $data['kelas_id'];

        global $koneksi;
        $pengguna_sql = mysqli_query($koneksi, "INSERT INTO pengguna VALUES (NULL, '$nis', '$password', '$role')");
        $pengguna_id = mysqli_insert_id($koneksi);
        $siswa_query = "INSERT INTO siswa VALUES (NULL, '$nisn', '$nis','$nama','$alamat','$telepon','$kelas_id','$pengguna_id','$pembayaran_id')";
        $siswa_sql = mysqli_query($koneksi, $siswa_query);
        return $siswa_sql;
    }

    public function update($pengguna_id, $data)
    {
        $nis = $data['nis'];
        $nisn = $data['nisn'];
        $nama = $data['nama'];
        $telepon = $data['telepon'];
        $alamat = $data['alamat'];
        $pembayaran_id = $data['pembayaran_id'];
        $kelas_id = $data['kelas_id'];

        global $koneksi;
        $pengguna_sql = mysqli_query($koneksi,"UPDATE pengguna SET username = '$nis' WHERE id = '$pengguna_id'");
        $siswa_query = "UPDATE siswa SET 
            nis = '$nis',
            nisn = '$nisn',
            telepon = '$telepon',
            alamat = '$alamat',
            nama = '$nama',
            pembayaran_id = '$pembayaran_id',
            kelas_id = '$kelas_id'
            WHERE pengguna_id = '$pengguna_id'
        ";
        $siswa_sql = mysqli_query($koneksi,$siswa_query);
        return $siswa_sql;
    }

    public function hapus($pengguna_id)
    {
        global $koneksi;
        $siswa_sql = mysqli_query($koneksi, "DELETE FROM siswa WHERE pengguna_id = '$pengguna_id'");
        $pengguna_sql = mysqli_query($koneksi, "DELETE FROM pengguna WHERE id = '$pengguna_id'");
        return $pengguna_sql;
    }

    public function jumlah()
    {
        global $koneksi;
        $count_sql = mysqli_query($koneksi, "SELECT id FROM siswa");
        return mysqli_num_rows($count_sql);
    }

}
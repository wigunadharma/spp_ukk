<?php

class Petugas 
{
    public function semua()
    {
        global $koneksi;
        // $pengguna_petugas_query = "SELECT petugas.*, pengguna.username FROM petugas
        //      INNER JOIN pengguna ON petugas.pengguna_id = pengguna.id";
        $sql = mysqli_query($koneksi, "SELECT * FROM petugas");
        $semua_petugas = mysqli_fetch_all($sql, MYSQLI_ASSOC);
        return $semua_petugas;
    }

    public function tambah($data)
    {
        // kebutuhan tabel pengguna
        $username = $data['username'];
        $password = $data['password'];
        $role = 'Petugas';

        // kebutuhan tabel petugas
        $nama = $data['nama'];
        
        global $koneksi;
        $pengguna_sql = mysqli_query($koneksi, "INSERT INTO pengguna VALUES (NULL, '$username', '$password', '$role')");
        $pengguna_id = mysqli_insert_id($koneksi); 

        $petugas_sql = mysqli_query($koneksi,"INSERT INTO petugas VALUES (NULL, '$nama', '$pengguna_id')");
        return $petugas_sql;
    }

    public function cari_via_pengguna($pengguna_id)
    {
        global $koneksi;
        $pengguna_petugas_query = "SELECT petugas.*, pengguna.username FROM petugas
            INNER JOIN pengguna ON petugas.pengguna_id = pengguna.id WHERE pengguna_id = '$pengguna_id'
        ";
        $sql = mysqli_query($koneksi, $pengguna_petugas_query);
        $petugas = mysqli_fetch_assoc($sql);
        return $petugas;
    }

    public function update($pengguna_id, $data)
    {
        $username = $data['username'];
        $nama = $data['nama'];
        
        global $koneksi;
        $pengguna_sql = mysqli_query($koneksi, "UPDATE pengguna SET username = '$username' WHERE id = '$pengguna_id'");
        $petugas_sql = mysqli_query($koneksi, "UPDATE petugas SET nama = '$nama' WHERE pengguna_id = '$pengguna_id'");

        return $petugas_sql;
    }

    public function hapus($pengguna_id)
    {
        global $koneksi;
        $petugas_sql = mysqli_query($koneksi, "DELETE FROM petugas WHERE pengguna_id = '$pengguna_id'");        
        $pengguna_sql = mysqli_query($koneksi,"DELETE FROM pengguna WHERE id = '$pengguna_id'");
        return $pengguna_sql;
    }

    public function jumlah()
    {
        global $koneksi;
        $count_sql = mysqli_query($koneksi, "SELECT id FROM petugas");
        return mysqli_num_rows($count_sql);
    }

}
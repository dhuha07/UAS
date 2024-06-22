<?php
// Pastikan skrip ini dijalankan hanya jika ada pengiriman form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Konfigurasi untuk koneksi ke database
    $servername = "localhost"; // Ganti sesuai server database Anda
    $username = "username"; // Ganti dengan username database Anda
    $password = "password"; // Ganti dengan password database Anda
    $dbname = "samsol_db"; // Ganti dengan nama database Anda

    // Membuat koneksi ke database menggunakan PDO
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // Mengatur mode error PDO ke mode exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Mengambil data dari form
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $pekerjaan = $_POST['pekerjaan'];
        $tanggal_lahir = $_POST['tanggal_lahir'];
        $provinsi = $_POST['provinsi'];

        // Mengambil file yang diunggah (foto KTP)
        $foto_KTP = $_FILES['foto_KTP']['name'];
        $foto_KTP_temp = $_FILES['foto_KTP']['tmp_name'];
        $foto_KTP_path = "uploads/" . $foto_KTP;

        // Pindahkan file yang diunggah ke lokasi yang diinginkan
        move_uploaded_file($foto_KTP_temp, $foto_KTP_path);

        // Mengambil file yang diunggah (foto STNK lama)
        $foto_STNK = $_FILES['foto_stnk']['name'];
        $foto_STNK_temp = $_FILES['foto_stnk']['tmp_name'];
        $foto_STNK_path = "uploads/" . $foto_STNK;

        // Pindahkan file yang diunggah ke lokasi yang diinginkan
        move_uploaded_file($foto_STNK_temp, $foto_STNK_path);

        // Query SQL untuk menyimpan data ke database
        $sql = "INSERT INTO stnk_data (nama, alamat, pekerjaan, tanggal_lahir, provinsi, foto_KTP, foto_STNK)
                VALUES ('$nama', '$alamat', '$pekerjaan', '$tanggal_lahir', '$provinsi', '$foto_KTP_path', '$foto_STNK_path')";

        // Eksekusi query
        $conn->exec($sql);

        // Tampilkan pesan sukses jika data berhasil disimpan
        echo "Data berhasil disimpan.";

    } catch(PDOException $e) {
        // Tangani kesalahan jika koneksi atau query gagal
        echo "Koneksi gagal: " . $e->getMessage();
    }

    // Tutup koneksi database
    $conn = null;
}
?>

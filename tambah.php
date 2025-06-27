<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'koneksi.php';
?>

<h2>Tambah Data Mahasiswa</h2>

<form action="" method="POST" enctype="multipart/form-data">
    NPM: <input type="text" name="npm" required><br><br>
    Nama: <input type="text" name="nama" required><br><br>
    Kelas: <input type="text" name="kelas" required><br><br>
    Semester: <input type="number" name="semester" required><br><br>
    Alamat: <textarea name="alamat" required></textarea><br><br>
    Ayah: <input type="text" name="ayah" required><br><br>
    Ibu: <input type="text" name="ibu" required><br><br>
    Foto: <input type="file" name="foto" accept="image/*" required><br><br>
    <button type="submit" name="submit">Simpan</button>
</form>

<?php
if (isset($_POST['submit'])) {
    $npm = mysqli_real_escape_string($koneksi, $_POST['npm']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $kelas = mysqli_real_escape_string($koneksi, $_POST['kelas']);
    $semester = (int) $_POST['semester'];
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $ayah = mysqli_real_escape_string($koneksi, $_POST['ayah']);
    $ibu = mysqli_real_escape_string($koneksi, $_POST['ibu']);

    $foto = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];

    // Folder untuk menyimpan file
    $folder = "uploads/";
    $path = $folder . basename($foto);

    // Cek ekstensi
    $allowed = ['jpg', 'jpeg', 'png', 'gif'];
    $ext = strtolower(pathinfo($foto, PATHINFO_EXTENSION));

    if (!in_array($ext, $allowed)) {
        echo "Ekstensi file tidak diizinkan!";
        exit;
    }

    // Upload file
    if (move_uploaded_file($tmp, $path)) {
        $query = "INSERT INTO mahasiswa (npm, nama, kelas, semester, alamat, ayah, ibu, foto)
                  VALUES ('$npm', '$nama', '$kelas', $semester, '$alamat', '$ayah', '$ibu', '$foto')";

        $result = mysqli_query($koneksi, $query);

        if ($result) {
            echo "✅ Data berhasil disimpan!";
        } else {
            echo "❌ Gagal menyimpan: " . mysqli_error($koneksi);
        }
    } else {
        echo "❌ Gagal upload foto.";
    }
}
?>

<?php
include 'koneksi.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID tidak ditemukan.");
}

$id = (int) $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE id=$id"));

if (!$data) {
    die("Data tidak ditemukan.");
}

if (isset($_POST['submit'])) {
    $npm = mysqli_real_escape_string($koneksi, $_POST['npm']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $kelas = mysqli_real_escape_string($koneksi, $_POST['kelas']);
    $semester = (int) $_POST['semester'];
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $ayah = mysqli_real_escape_string($koneksi, $_POST['ayah']);
    $ibu = mysqli_real_escape_string($koneksi, $_POST['ibu']);

    // Jika ada foto baru
    if (!empty($_FILES['foto']['name'])) {
        $foto = $_FILES['foto']['name'];
        $tmp = $_FILES['foto']['tmp_name'];
        $folder = "uploads/";
        $path = $folder . basename($foto);

        $ext = strtolower(pathinfo($foto, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];

        if (!in_array($ext, $allowed)) {
            echo "❌ Tipe file tidak didukung.";
            exit;
        }

        if (move_uploaded_file($tmp, $path)) {
            // Hapus foto lama jika ada
            if (!empty($data['foto']) && file_exists("uploads/" . $data['foto'])) {
                unlink("uploads/" . $data['foto']);
            }

            $query = "UPDATE mahasiswa SET npm='$npm', nama='$nama', kelas='$kelas', semester=$semester,
                      alamat='$alamat', ayah='$ayah', ibu='$ibu', foto='$foto' WHERE id=$id";
        } else {
            echo "❌ Upload foto gagal.";
            exit;
        }
    } else {
        // Tanpa ganti foto
        $query = "UPDATE mahasiswa SET npm='$npm', nama='$nama', kelas='$kelas', semester=$semester,
                  alamat='$alamat', ayah='$ayah', ibu='$ibu' WHERE id=$id";
    }

    if (mysqli_query($koneksi, $query)) {
        echo "✅ Data berhasil diperbarui. <a href='index.php'>Kembali</a>";
    } else {
        echo "❌ Gagal update: " . mysqli_error($koneksi);
    }
}
?>

<h2>Edit Data Mahasiswa</h2>

<form method="POST" enctype="multipart/form-data">
    NPM: <input type="text" name="npm" value="<?= $data['npm'] ?>" required><br><br>
    Nama: <input type="text" name="nama" value="<?= $data['nama'] ?>" required><br><br>
    Kelas: <input type="text" name="kelas" value="<?= $data['kelas'] ?>" required><br><br>
    Semester: <input type="number" name="semester" value="<?= $data['semester'] ?>" required><br><br>
    Alamat: <textarea name="alamat" required><?= $data['alamat'] ?></textarea><br><br>
    Ayah: <input type="text" name="ayah" value="<?= $data['ayah'] ?>" required><br><br>
    Ibu: <input type="text" name="ibu" value="<?= $data['ibu'] ?>" required><br><br>
    Foto baru (jika ingin mengganti): <input type="file" name="foto" accept="image/*"><br>
    Foto sekarang: <img src="uploads/<?= $data['foto'] ?>" width="80"><br><br>
    <button type="submit" name="submit">Update</button>
</form>

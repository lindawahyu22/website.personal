<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Mahasiswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container py-4">
    <h2>Tambah Mahasiswa</h2>
    <form action="store.php" method="post" enctype="multipart/form-data">
        <input type="text" name="npm" class="form-control mb-2" placeholder="NPM" required>
        <input type="text" name="nama" class="form-control mb-2" placeholder="Nama" required>
        <input type="text" name="kelas" class="form-control mb-2" placeholder="Kelas" required>
        <input type="number" name="semester" class="form-control mb-2" placeholder="Semester" required>
        <textarea name="alamat" class="form-control mb-2" placeholder="Alamat" required></textarea>
        <input type="text" name="ibu" class="form-control mb-2" placeholder="Nama Ibu" required>
        <input type="text" name="ayah" class="form-control mb-2" placeholder="Nama Ayah" required>
        <input type="file" name="foto" class="form-control mb-3" required>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="index.php" class="btn btn-secondary">Batal</a>
    </form>
</body>
</html>

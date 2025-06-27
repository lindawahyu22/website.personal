<?php include 'koneksi.php'; ?>

<a href="tambah.php">Tambah Data</a><br><br>

<table border="1">
    <tr>
        <th>ID</th><th>NPM</th><th>Nama</th><th>Kelas</th><th>Semester</th><th>Alamat</th>
        <th>Ayah</th><th>Ibu</th><th>Foto</th><th>Aksi</th>
    </tr>
    <?php
    $result = mysqli_query($koneksi, "SELECT * FROM mahasiswa");
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['npm']}</td>
            <td>{$row['nama']}</td>
            <td>{$row['kelas']}</td>
            <td>{$row['semester']}</td>
            <td>{$row['alamat']}</td>
            <td>{$row['ayah']}</td>
            <td>{$row['ibu']}</td>
            <td><img src='uploads/{$row['foto']}' width='50'></td>
            <td>
                <a href='edit.php?id={$row['id']}'>Edit</a> | 
                <a href='hapus.php?id={$row['id']}' onclick=\"return confirm('Yakin hapus?')\">Hapus</a>
            </td>
        </tr>";
    }
    ?>
</table>

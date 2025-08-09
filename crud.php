<?php
$koneksi = mysqli_connect("localhost", "root", "", "akademik");

// Tambah data
if (isset($_POST['simpan'])) {
    $nim = $_POST['nim'];
    $nama = $_POST['nama_mhs'];
    $kode_prodi = $_POST['kode_prodi'];
    $jkelamin = $_POST['jkelamin'];

    mysqli_query($koneksi, "INSERT INTO mahasiswa (nim , nama_mhs, kode_prodi, jkelamin) VALUES ('$nim', '$nama', '$kode_prodi', '$jkelamin')");
    header("Location: " . $_SERVER['PHP_SELF'] . "?status=sukses_tambah");
    exit();
}

// Update data
if (isset($_POST['update'])) {
    $id = $_POST['id_mhs'];
    $nim = $_POST['nim'];
    $nama = $_POST['nama_mhs'];
    $kode_prodi = $_POST['kode_prodi'];
    $jkelamin = $_POST['jkelamin'];

    mysqli_query($koneksi, "UPDATE mahasiswa SET nim='$nim', nama_mhs='$nama', kode_prodi='$kode_prodi', jkelamin='$jkelamin' WHERE id_mhs=$id");
    header("Location: " . $_SERVER['PHP_SELF'] . "?status=sukses_edit");
    exit();
}

// Hapus data
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM mahasiswa WHERE id_mhs=$id");
    header("Location: " . $_SERVER['PHP_SELF'] . "?status=sukses_hapus");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(-45deg, red, blue, green);
            background-size: 400% 400%;
            animation: gradientMove 15s ease infinite;
        }

        @keyframes gradientMove {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        h1 {
            animation: slideDown 4s ease;
            font-size:48px;
            color: white;
        }

        @keyframes slideDown {
            from { transform: translateY(-20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .table {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            animation: fadeIn 1s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <marquee><h1 class="mb-4">DATA MAHASISWA</h1></marquee>
        
        <?php if (isset($_GET['status'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php
                if ($_GET['status'] == 'sukses_tambah') echo "Data berhasil ditambahkan!";
                elseif ($_GET['status'] == 'sukses_edit') echo "Data berhasil diubah!";
                elseif ($_GET['status'] == 'sukses_hapus') echo "Data berhasil dihapus!";
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <button class="btn btn-light mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">Tambah Mahasiswa</button>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr tr class="text-center">
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Prodi</th>
                    <th>Jenis Kelamin</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $no = 1;
            $query = mysqli_query($koneksi, "SELECT m.*, p.nama_prodi FROM mahasiswa m LEFT JOIN prodi p ON m.kode_prodi = p.kode_prodi ORDER BY m.nim ASC");
            while ($data = mysqli_fetch_array($query)) {
            ?>
                <tr tr class="text-center">
                    <td><?= $no++ ?></td>
                    <td><?= $data['nim'] ?></td>
                    <td><?= $data['nama_mhs'] ?></td>
                    <td><?= $data['nama_prodi'] ?></td>
                    <td><?= ($data['jkelamin'] == 'L') ? 'Laki-laki' : 'Perempuan' ?></td>
                    <td>
                        <center> 
                        <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalLihat<?= $data['id_mhs'] ?>">Lihat</button>
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $data['id_mhs'] ?>">Update</button>
                        <a href="?hapus=<?= $data['id_mhs'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data?')">Hapus</a>
                        </center>
                    </td>
                </tr>

                <!-- Modal Lihat -->
                <div class="modal fade" id="modalLihat<?= $data['id_mhs'] ?>" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Detail Mahasiswa</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>NIM:</strong> <?= $data['nim'] ?></p>
                                <p><strong>Nama:</strong> <?= $data['nama_mhs'] ?></p>
                                <p><strong>Prodi:</strong> <?= $data['nama_prodi'] ?></p>
                                <p><strong>Jenis Kelamin:</strong> <?= ($data['jkelamin'] == 'L') ? 'Laki-laki' : 'Perempuan' ?></p>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Edit -->
                <div class="modal fade" id="modalEdit<?= $data['id_mhs'] ?>" tabindex="-1">
                    <div class="modal-dialog">
                        <form method="post">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Mahasiswa</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="id_mhs" value="<?= $data['id_mhs'] ?>">
                                    <div class="mb-3">
                                        <label>NIM</label>
                                        <input type="text" name="nim" class="form-control" value="<?= $data['nim'] ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Nama</label>
                                        <input type="text" name="nama_mhs" class="form-control" value="<?= $data['nama_mhs'] ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Prodi</label>
                                        <select name="kode_prodi" class="form-control" required>
                                            <?php
                                            $prodi = mysqli_query($koneksi, "SELECT * FROM prodi");
                                            while ($p = mysqli_fetch_array($prodi)) {
                                                $selected = ($p['kode_prodi'] == $data['kode_prodi']) ? 'selected' : '';
                                                echo "<option value='{$p['kode_prodi']}' $selected>{$p['nama_prodi']}</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label>Jenis Kelamin</label>
                                        <select name="jkelamin" class="form-control" required>
                                            <option value="L" <?= ($data['jkelamin'] == 'L') ? 'selected' : '' ?>>Laki-laki</option>
                                            <option value="P" <?= ($data['jkelamin'] == 'P') ? 'selected' : '' ?>>Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button class="btn btn-success" name="update">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="modalTambah" tabindex="-1">
        <div class="modal-dialog">
            <form method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Mahasiswa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>NIM</label>
                            <input type="text" name="nim" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Nama</label>
                            <input type="text" name="nama_mhs" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Prodi</label>
                            <select name="kode_prodi" class="form-control" required>
                                <?php
                                $prodi = mysqli_query($koneksi, "SELECT * FROM prodi");
                                while ($p = mysqli_fetch_array($prodi)) {
                                    echo "<option value='{$p['kode_prodi']}'>{$p['nama_prodi']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Jenis Kelamin</label>
                            <select name="jkelamin" class="form-control" required>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-primary" name="simpan">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Auto-hide alert setelah 3 detik
    setTimeout(() => {
        const alert = document.querySelector('.alert');
        if (alert) {
            alert.classList.remove('show');
            alert.classList.add('hide');
        }
    }, 3000);
</script>
</body>
</html>

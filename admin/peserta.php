<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../functions/config.php';
require_once '../functions/peserta.php';
?>

<?php include 'inc/header.php'; ?>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kelola Peserta Seminar</h1>
        <a href="index.php" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?php echo $training['judul']; ?></h6>
        </div>
        <div class="card-body">
            <p><strong>Tanggal:</strong> <?php echo date('d/m/Y', strtotime($training['tanggal'])); ?></p>
            <p><strong>Waktu:</strong> <?php echo $training['waktu']; ?></p>
            <p><strong>Lokasi:</strong> <?php echo $training['lokasi']; ?></p>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Peserta & Kehadiran</h6>
            <button type="submit" form="formKehadiran" class="btn btn-success btn-sm">
                <i class="fas fa-save"></i> Simpan Kehadiran
            </button>
        </div>
        <div class="card-body">
            <?php if(isset($_GET['updated'])) { ?>
            <div class="alert alert-success">
                Kehadiran berhasil disimpan!
            </div>
            <?php }; ?>

            <form method="POST" id="formKehadiran">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Peserta</th>
                                <th>Tanggal Daftar</th>
                                <th>Status Kehadiran</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(empty($A)): ?>
                            <tr>
                                <td colspan="4" class="text-center">Belum ada peserta</td>
                            </tr>
                            <?php else: ?>
                            <?php $no = 1; ?>
                            <?php foreach($A as $peserta): ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $peserta['nama']; ?></td>
                                <td><?php echo date('d/m/Y H:i', strtotime($peserta['tanggaldaftar'])); ?></td>
                                <td>
                                    <select name="statushadir[<?php echo $peserta['id']; ?>]" class="form-control form-control-sm">
                                        <option value="pending" <?php echo $peserta['statushadir'] == 'pending' ? 'selected' : ''; ?>>Pending</option>
                                        <option value="hadir" <?php echo $peserta['statushadir'] == 'hadir' ? 'selected' : ''; ?>>Hadir</option>
                                        <option value="alpa" <?php echo $peserta['statushadir'] == 'alpa' ? 'selected' : ''; ?>>Alpa</option>
                                    </select>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>
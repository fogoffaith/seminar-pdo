<?php
require_once '../functions/config.php';
require_once '../functions/training.php';

if(isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    deleteTraining($id);
    header("Location: index.php?deleted=1");
    exit();
}

$trainings = getAllTrainings();
?>

<?php include 'inc/header.php'; ?>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kelola Seminar</h1>
        <a href="create.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Seminar
        </a>
    </div>

    <?php if(isset($_GET['deleted'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        Seminar telah dihapus
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php endif; ?>

    <div class="row">
        <?php if(empty($trainings)): ?>
        <div class="col-12">
            <div class="alert alert-info">
                Belum ada seminar.
            </div>
        </div>
        <?php else: ?>
        <?php foreach($trainings as $training): ?>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                <?php echo date('d M Y', strtotime($training['tanggal'])); ?>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php echo $training['judul']; ?>
                            </div>
                            <div class="text-xs text-muted mt-2">
                                <i class="fas fa-clock"></i> <?php echo $training['waktu']; ?> |
                                <i class="fas fa-map-marker-alt"></i> <?php echo $training['lokasi']; ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-3">
                        <a href="peserta.php?trainingid=<?php echo $training['id']; ?>" 
                           class="btn btn-sm btn-info">
                            <i class="fas fa-users"></i> Peserta
                        </a>
                        <a href="edit.php?id=<?php echo $training['id']; ?>" 
                           class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="index.php?hapus=<?php echo $training['id']; ?>" 
                           class="btn btn-sm btn-danger" 
                           onclick="return confirm('Yakin hapus seminar ini?')">
                            <i class="fas fa-trash"></i> Hapus
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?php include 'inc/footer.php'; ?>
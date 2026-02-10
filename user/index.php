<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../functions/config.php';
require_once '../functions/user.php';
include 'inc/header.php';
?>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Seminar</h1>
    </div>

    <?php if(isset($_GET['success'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        Daftar berhasil
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php endif; ?>

    <div class="row">
        <?php if(empty($seminars)): ?>
        <div class="col-12">
            <div class="alert alert-info">
                Tidak ada seminar.
            </div>
        </div>
        <?php else: ?>
        <?php foreach($seminars as $seminar): ?>
        <?php $udah = in_array($seminar['id'], $list_udah); ?>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                <?php echo date('d M Y', strtotime($seminar['tanggal'])); ?>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php echo $seminar['judul']; ?>
                            </div>
                            <div class="text-xs text-muted mt-2">
                                <i class="fas fa-clock"></i> <?php echo $seminar['waktu']; ?> |
                                <i class="fas fa-map-marker-alt"></i> <?php echo $seminar['lokasi']; ?>
                            </div>
                            <?php if($udah): ?>
                            <div class="text-xs text-success mt-1">
                                <i class="fas fa-check-circle"></i> Sudah terdaftar
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="mt-3">
                        <a href="detail.php?id=<?php echo $seminar['id']; ?>" 
                           class="btn btn-sm btn-info">
                            <i class="fas fa-info-circle"></i> Detail
                        </a>
                        
                        <?php if($udah): ?>
                        <button class="btn btn-sm btn-success" disabled>
                            <i class="fas fa-check"></i> Sudah Daftar
                        </button>
                        <?php else: ?>
                        <a href="daftar.php?id=<?php echo $seminar['id']; ?>" 
                           class="btn btn-sm btn-primary"
                           onclick="return confirm('Daftar seminar ini?')">
                            <i class="fas fa-sign-in-alt"></i> Daftar
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?php include 'inc/footer.php'; ?>
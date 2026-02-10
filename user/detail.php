<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../functions/config.php';

session_start();
if(!isset($_SESSION['login']) || $_SESSION['role'] != 'karyawan') {
    header("Location: ../login.php");
    exit();
}

$seminar_id = $_GET['id'] ?? 0;
$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM training WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$seminar_id]);
$seminar = $stmt->fetch();


$sql = "SELECT trainingid FROM peserta WHERE userid = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$user_id]);
$seminar_udah = $stmt->fetchAll();

$list_udah = [];
foreach($seminar_udah as $s) {
    $list_udah[] = $s['trainingid'];
}
?>

<?php include 'inc/header.php'; ?>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Seminar</h1>
        <a href="index.php" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><?php echo $seminar['judul']; ?></h6>
                        <?php $udah = in_array($seminar['id'], $list_udah); ?>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong><i class="fas fa-calendar"></i> Tanggal:</strong><br>
                            <?php echo date('d F Y', strtotime($seminar['tanggal'])); ?></p>
                            
                            <p><strong><i class="fas fa-clock"></i> Waktu:</strong><br>
                            <?php echo $seminar['waktu']; ?></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong><i class="fas fa-map-marker-alt"></i> Lokasi:</strong><br>
                            <?php echo $seminar['lokasi']; ?></p>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <h6 class="font-weight-bold">Deskripsi / Materi:</h6>
                    <p><?php echo $seminar['deskripsi']; ?></p>
                </div>
                <div class="card-footer">
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
</div>

<?php include 'inc/footer.php'; ?>
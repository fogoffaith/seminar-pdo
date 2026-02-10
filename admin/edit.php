<?php
session_start();
require_once '../functions/config.php';
require_once '../functions/training.php';

if(!isset($_SESSION['login']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

$id = $_GET['id'] ?? 0;
$training = getTrainingById($id);

if(!$training) {
    header("Location: index.php");
    exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
        'judul' => $_POST['judul'],
        'deskripsi' => $_POST['deskripsi'],
        'tanggal' => $_POST['tanggal'],
        'waktu' => $_POST['waktu'],
        'lokasi' => $_POST['lokasi']
    ];
    
    if(updateTraining($id, $data)) {
        header("Location: index.php?updated=1");
        exit();
    }
}
?>

<?php include 'inc/header.php'; ?>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Seminar</h1>
        <a href="index.php" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="POST">
                <div class="form-group">
                    <label>Judul Seminar *</label>
                    <input type="text" name="judul" class="form-control" 
                           value="<?php echo htmlspecialchars($training['judul']); ?>" required>
                </div>
                
                <div class="form-group">
                    <label>Deskripsi / Materi</label>
                    <textarea name="deskripsi" class="form-control" rows="3" required><?php 
                        echo htmlspecialchars($training['deskripsi']); 
                    ?></textarea>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" 
                                   value="<?php echo $training['tanggal']; ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Waktu</label>
                            <input type="time" name="waktu" class="form-control" 
                                   value="<?php echo $training['waktu']; ?>" required>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Lokasi</label>
                            <input type="text" name="lokasi" class="form-control" 
                                   value="<?php echo htmlspecialchars($training['lokasi']); ?>" required>
                        </div>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update
                </button>
            </form>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>
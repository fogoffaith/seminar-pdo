<?php

$trainingid = $_GET['trainingid'] ?? 0;

$sql = "SELECT * FROM training WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$trainingid]);
$training = $stmt->fetch();

if(!$training) {
    die("Training tidak ditemukan");
}

$sql = "SELECT * FROM peserta WHERE trainingid = ? ORDER BY tanggaldaftar";
$stmt = $conn->prepare($sql);
$stmt->execute([$trainingid]);
$A = $stmt->fetchAll();

foreach($A as &$peserta) {
    $sql2 = "SELECT nama FROM users WHERE id = ?";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->execute([$peserta['userid']]);
    $user = $stmt2->fetch();
    $peserta['nama'] = $user['nama'];
}

unset($peserta);

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach($_POST['statushadir'] as $peserta_id => $status) {
        $sql = "UPDATE peserta SET statushadir = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$status, $peserta_id]);
    }
    header("Location: peserta.php?trainingid=$trainingid&updated=1");
    exit();
}

?>
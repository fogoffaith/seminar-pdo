<?php
session_start();
$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM training ORDER BY tanggal, waktu";
$stmt = $conn->prepare($sql);
$stmt->execute();
$seminars = $stmt->fetchAll();

$sql = "SELECT trainingid FROM peserta WHERE userid = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$user_id]);
$seminar_udah = $stmt->fetchAll();

$list_udah = [];
foreach($seminar_udah as $s) {
    $list_udah[] = $s['trainingid'];
}
?>
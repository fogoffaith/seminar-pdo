<?php
session_start();
require_once '../functions/config.php';

$user_id = $_SESSION['user_id'];
$seminar_id = $_GET['id'];

$sql = "INSERT INTO peserta (userid, trainingid) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->execute([$user_id, $seminar_id]);

header("Location: index.php?success=1");
exit();
?>
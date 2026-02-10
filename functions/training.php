<?php
require_once 'config.php';

function getAllTrainings() {
    global $conn;
    $sql = "SELECT * FROM training ORDER BY tanggal DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}
function getTrainingById($id) {
    global $conn;
    $sql = "SELECT * FROM training WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function createTraining($data) {
    global $conn;
    $sql = "INSERT INTO training (judul, deskripsi, tanggal, waktu, lokasi, status) 
            VALUES (:judul, :deskripsi, :tanggal, :waktu, :lokasi, 'open')";
    $stmt = $conn->prepare($sql);
    return $stmt->execute($data);
}

function updateTraining($id, $data) {
    global $conn;
    $sql = "UPDATE training SET 
            judul = :judul, 
            deskripsi = :deskripsi, 
            tanggal = :tanggal, 
            waktu = :waktu, 
            lokasi = :lokasi
            WHERE id = :id";
    
    $data['id'] = $id;
    $stmt = $conn->prepare($sql);
    return $stmt->execute($data);
}

function deleteTraining($id) {
    global $conn;
    $sql = "DELETE FROM training WHERE id = ?";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([$id]);
}
?>
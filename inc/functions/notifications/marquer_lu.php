<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once __DIR__ . '/../connections.php'; // CORRECTION ICI ✅
if($_SERVER['REQUEST_METHOD'] == 'GET') {
    if(isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = $_GET['id'];
        $stmt = $pdo->prepare("UPDATE notifications SET status = 'read' WHERE id_notification = ?");
        $stmt->execute([$id]);
        if($stmt->rowCount() > 0) {
            echo json_encode(['status' => 'success', 'message' => 'Notification marked as read']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Notification not found or already marked as read']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
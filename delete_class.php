<?php
session_start();

if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit;
}

require_once('../../mysqli_connect.php');

header('Content-Type: application/json');

$email = $_SESSION['email'];
$class_id = json_decode(file_get_contents('php://input'), true)['class_id'];

if (empty($class_id)) {
    echo json_encode(['success' => false]);
    exit;
}

$sql = "DELETE FROM portfolio_schedule WHERE id = ? AND emailAddr = ?";
$stmt = mysqli_prepare($dbc, $sql);
mysqli_stmt_bind_param($stmt, 'is', $class_id, $email);
mysqli_stmt_execute($stmt);

if (mysqli_stmt_affected_rows($stmt) > 0) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
?>
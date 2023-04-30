<?php
session_start();

if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit;
}

require_once('../../mysqli_connect.php');

$email = $_SESSION['email'];
$class_name = $_POST['class_name'];
$day_of_week = $_POST['day_of_week'];
$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];

$sql = "INSERT INTO portfolio_schedule (class_name, day_of_week, start_time, end_time, emailAddr) VALUES (?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($dbc, $sql);
mysqli_stmt_bind_param($stmt, 'sisss', $class_name, $day_of_week, $start_time, $end_time, $email);
mysqli_stmt_execute($stmt);

header('Location: schedule.php');
exit;
?>
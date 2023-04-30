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
$error_message = "";

if (empty($class_name) || $day_of_week === "" || empty($start_time) || empty($end_time)) {
    $error_message = "All fields must be filled out.";
    $_SESSION['submitted_values'] = [
        'class_name' => $class_name,
        'day_of_week' => $day_of_week,
        'start_time' => $start_time,
        'end_time' => $end_time,
    ];
} else {
    // Check for overlapping classes
    $sql = "SELECT * FROM portfolio_schedule WHERE emailAddr = ? AND day_of_week = ? AND ((start_time <= ? AND end_time > ?) OR (start_time < ? AND end_time >= ?) OR (start_time >= ? AND end_time <= ?))";
    $stmt = mysqli_prepare($dbc, $sql);
    mysqli_stmt_bind_param($stmt, 'sissssss', $email, $day_of_week, $end_time, $start_time, $start_time, $end_time, $start_time, $end_time);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $error_message = "There is already a class scheduled during that time and date combination.";
    } else {
        $sql = "INSERT INTO portfolio_schedule (class_name, day_of_week, start_time, end_time, emailAddr) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($dbc, $sql);
        mysqli_stmt_bind_param($stmt, 'sisss', $class_name, $day_of_week, $start_time, $end_time, $email);
        mysqli_stmt_execute($stmt);
    }
    // Clear the submitted_values after a successful submission
    unset($_SESSION['submitted_values']);
}

$_SESSION['error_message'] = $error_message;
header('Location: schedule.php');
exit;
?>
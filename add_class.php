<?php
session_start();

if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit;
}

if (isset($_POST['submit'])) {
    $class_name = $_POST['class_name'];
    $day_of_week = $_POST['day_of_week'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    if (strlen($class_name) > 15) {
        $error = "Class name must be 15 characters or less";
    } else {
        require_once('../../mysqli_connect.php');

        $email = $_SESSION['email'];

        $sql = "INSERT INTO portfolio_schedule (class_name, day_of_week, start_time, end_time, emailAddr) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($dbc, $sql);
        mysqli_stmt_bind_param($stmt, 'sissi', $class_name, $day_of_week, $start_time, $end_time, $email);
        mysqli_stmt_execute($stmt);

        header('Location: display_schedule.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Class</title>
    <link rel="stylesheet" type="text/css" href="styles/add_class.css">
</head>

<body>
    <header>
        <h1>Add Class</h1>
    </header>

    <main>
        <?php if (isset($error)): ?>
            <div class="error">
                <?= $error ?>
            </div>
        <?php endif; ?>

        <form method="post">
            <div>
                <label for="class_name">Class Name:</label>
                <input type="text" id="class_name" name="class_name" maxlength="15" required>
            </div>

            <div>
                <label for="day_of_week">Day of Week:</label>
                <select id="day_of_week" name="day_of_week" required>
                    <option value="0">Sunday</option>
                    <option value="1">Monday</option>
                    <option value="2">Tuesday</option>
                    <option value="3">Wednesday</option>
                    <option value="4">Thursday</option>
                    <option value="5">Friday</option>
                    <option value="6">Saturday</option>
                </select>
            </div>

            <div>
                <label for="start_time">Start Time:</label>
                <input type="time" id="start_time" name="start_time" required>
            </div>

            <div>
                <label for="end_time">End Time:</label>
                <input type="time" id="end_time" name="end_time" required>
            </div>

            <div>
                <button type="submit" name="submit">Submit</button>
            </div>
        </form>
    </main>
</body>

</html>
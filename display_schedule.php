<?php
session_start();

if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit;
}

require_once('../../mysqli_connect.php');

$email = $_SESSION['email'];

if (isset($_POST['add_class'])) {
    $class_name = $_POST['class_name'];
    $day_of_week = $_POST['day_of_week'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    $sql = "INSERT INTO portfolio_schedule (class_name, day_of_week, start_time, end_time, emailAddr) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($dbc, $sql);
    mysqli_stmt_bind_param($stmt, 'sissi', $class_name, $day_of_week, $start_time, $end_time, $email);
    mysqli_stmt_execute($stmt);
}

$sql = "SELECT * FROM portfolio_schedule WHERE emailAddr = ? ORDER BY day_of_week, start_time";
$stmt = mysqli_prepare($dbc, $sql);
mysqli_stmt_bind_param($stmt, 's', $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$classes = [];
while ($row = mysqli_fetch_assoc($result)) {
    $classes[] = $row;
}
?>

<table id="schedule_table">
    <thead>
        <tr>
            <th>Time</th>
            <th>Sunday</th>
            <th>Monday</th>
            <th>Tuesday</th>
            <th>Wednesday</th>
            <th>Thursday</th>
            <th>Friday</th>
            <th>Saturday</th>
        </tr>
    </thead>
    <tbody>
        <?php
        for ($i = 6 * 60; $i <= 22 * 60; $i += 15) {
            $time = sprintf('%02d:%02d:00', intdiv($i, 60), $i % 60);
            echo "<tr>";
            echo "<td>$time</td>";

            for ($day_of_week = 0; $day_of_week <= 6; $day_of_week++) {
                $class_name = '';
                foreach ($classes as $class) {
                    if ($class['day_of_week'] == $day_of_week && $class['start_time'] <= $time && $class['end_time'] >= $time) {
                        $class_name = $class['class_name'];
                        break;
                    }
                }
                echo "<td>";
                if (!empty($class_name)) {
                    echo "<div class='class_block'>$class_name</div>";
                }
                echo "</td>";
            }

            echo "</tr>";
        }
        ?>
    </tbody>
</table>
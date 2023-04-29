<!-- Mark Karels -->

<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$title = "School Schedule";
include "includes/header.php";
?>

<section>
    <h1>Schedule</h1>
    <p>
        Here is my current class schedule for the current semester.
    </p>
    <?php include "schedule_form.php"; ?>
    <?php include "display_schedule.php"; ?>

</section>

<?php
include "includes/footer.php";
echo '<link rel="stylesheet" type="text/css" href="styles/schedule.css">';
?>
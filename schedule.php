<!-- Mark Karels -->

<?php
$title = "School Schedule";
include "includes/header.php";
?>

<section>
    <h1>Schedule</h1>
    <p>
        Here is a breakdown of my school schedule along with course details for all
        the classes I have taken.
    </p>
    <?php include "schedule_form.php"; ?>
    <?php include "display_schedule.php"; ?>

</section>

<?php
include "includes/footer.php";
echo '<link rel="stylesheet" type="text/css" href="styles/schedule.css">';
?>
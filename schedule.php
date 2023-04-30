<!-- Mark Karels -->

<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$title = "School Schedule";
require_once 'secure_conn.php';
include "includes/header.php";
echo '<link rel="stylesheet" type="text/css" href="styles/schedule.css">';
?>

<section>
    <h1>Schedule</h1>
    <p>
        Here is my current class schedule for the current semester.
    </p>
    <?php include "schedule_form.php"; ?>
    <?php include "display_schedule.php"; ?>

</section>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.delete-class');

        deleteButtons.forEach((button) => {
            button.addEventListener('click', function () {
                const classId = this.dataset.classId;

                fetch('delete_class.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        class_id: classId
                    }),
                })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.success) {
                            location.reload();
                        } else {
                            alert('Error deleting the class. Please try again.');
                        }
                    });
            });
        });
    });
</script>
<?php
include "includes/footer.php";
?>
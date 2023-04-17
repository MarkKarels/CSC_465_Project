<?php
$title = "Logged In";
session_start();

if (isset($_SESSION['firstName']) && isset($_SESSION['email'])) {
    $firstname = $_SESSION['firstName'];
    $email = $_SESSION['email'];
    $message = "Welcome back $firstname";
    $message2 = "You are now logged in";
} else {
    $message = 'You have reached this page in error';
    $message2 = 'Please use the menu at the right';
}
require 'includes/header.php';
?>
<section>
    <?php
    // Print the message:
    echo '<h2>' . $message . '</h2>';
    echo '<h3>' . $message2 . '</h3>';
    ?>
</section>
<?php // Include the footer and quit the script:
include('includes/footer.php');
?>
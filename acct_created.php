<?php
$title = "Account Created";
session_start();
require_once 'secure_conn.php';
if (isset($_SESSION['firstname'])) {
    $firstname = $_SESSION['firstname'];
    $message = "Thank you for creating a new account, $firstname!";
    $message2 = 'Please click the login link <a href="login.php" class="register-link">Login Here</a> to login.';
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
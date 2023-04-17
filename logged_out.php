<?php
$title = "Logged Out";
session_start();
require_once 'reg_conn.php';
if (isset($_SESSION['email'])) {
    $firstname = $_SESSION['firstName'];
    $email = $_SESSION['email'];
    $message = "You have successfully logged out, $firstname!";
    $message2 = "Thank you for visiting. Have a great day!";

    // Empty the $_SESSION array
    $_SESSION = array();

    // Remove session data from server
    session_destroy();

    // Delete the cookie from the user's browser
    setcookie('PHPSESSID', '', time() - 3600, '/');

} else {
    $message = 'You have reached this page in error';
    $message2 = 'Please use the menu at the right';
}

require 'includes/header.php';
?>

<section>
    <h2>
        <?php echo $message; ?>
    </h2>
    <h3>
        <?php echo $message2; ?>
    </h3>
</section>

<?php
include('./includes/footer.php');
?>
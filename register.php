<!-- Mark Karels -->

<?php
$title = "Register";
require_once 'secure_conn.php';
require 'includes/header.php';

if (isset($_POST['send'])) {
    $errors = array();

    $firstname = filter_var(trim($_POST['firstname']), FILTER_SANITIZE_STRING); //returns a string
    if (empty($firstname))
        $errors['firstname'] = "First name is required";

    $lastname = filter_var(trim($_POST['lastname']), FILTER_SANITIZE_STRING); //returns a string
    if (empty($lastname))
        $errors['lastname'] = "Last name is required";

    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    if (empty($email))
        $errors['email'] = 'An email address is required:';
    else {
        //check validity
        $valid_email = filter_var($email, FILTER_VALIDATE_EMAIL); //returns a string or null if empty or false if not valid	
        if ($valid_email)
            $email = $valid_email;
        else
            $errors['email'] = 'A valid email is required:';
    }

    //Check to see if email address already exists
    //Handle as an error if yes 
    require_once '../../mysqli_connect.php'; //$dbc is the connection string set upon successful connection
    $sql = "SELECT emailAddr from portfolio_reg where emailAddr = ?";
    $stmt = mysqli_prepare($dbc, $sql);
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) >= 1)
        $errors['exists'] = 'That email already exists in the database. Please log in or enter a different email';
    mysqli_free_result($result);

    $password1 = filter_var(trim($_POST['password1']), FILTER_SANITIZE_STRING);
    $password2 = filter_var(trim($_POST['password2']), FILTER_SANITIZE_STRING);
    // Check for a password:
    if (empty($password1) || empty($password2))
        $errors['pw'] = "Please enter the password twice";
    elseif ($password1 !== $password2)
        $errors['pwmatch'] = "The passwords don't match";
    else
        $password = $password1;

    $firstport = filter_var(trim($_POST['firstport']), FILTER_SANITIZE_NUMBER_INT);
    if (empty($firstport))
        $errors['firstport'] = "Please select whether this is your first computer science portfolio or not.";

    $accepted = filter_var($_POST['terms']);
    if (empty($accepted) || $accepted != 'accepted')
        $errors['accepted'] = "You must accept the terms";

    if (!$errors) {
        $sql2 = "INSERT into portfolio_reg (firstName, lastName, emailAddr, pw, firstport) VALUES (?, ?, ?, ?, ?)";
        $stmt2 = mysqli_prepare($dbc, $sql2);
        $pw_hash = password_hash($password, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt2, 'ssssi', $firstname, $lastname, $email, $pw_hash, $firstport);
        mysqli_stmt_execute($stmt2);
        if (mysqli_stmt_affected_rows($stmt2)) {
            session_start();
            $_SESSION['firstname'] = $firstname;
            header('Location: acct_created.php');
            exit;
        } else {
            echo "<main><h2>We're sorry. We are unable to add your account at this time.</h2><h3>Please try again later</h3></main>";
        }
        include 'includes/footer.php';
        exit;
    } // no errors 

} //isset
?>

<section>
    <form method="post" action="register.php" name="register" class="register-form">
        <fieldset>
            <legend>Become a Registered User:</legend>
            <?php if ($errors) { ?>
                <h2 class="warning">Please fix the item(s) indicated.</h2>
            <?php } ?>

            <?php if ($errors['firstname'])
                echo "<h2 class=\"warning\">{$errors['firstname']}</h2>"; ?>
            <p>
                <label for="fn">First Name: </label>
                <input name="firstname" id="fn" type="text" <?php if (isset($firstname)) {
                    echo 'value="' . htmlspecialchars($firstname) . '"';
                } ?>>
            </p>
            <?php if ($errors['lastname'])
                echo "<h2 class=\"warning\">{$errors['lastname']}</h2>"; ?>
            <p>
                <label for="ln">Last Name: </label>
                <input name="lastname" id="ln" type="text" <?php if (isset($lastname)) {
                    echo 'value="' . htmlspecialchars($lastname) . '"';
                } ?>>
            </p>
            <?php
            if ($errors['email'])
                echo "<h2 class=\"warning\">{$errors['email']}</h2>";
            if ($errors['exists'])
                echo "<h2 class=\"warning\">{$errors['exists']}</h2>";
            ?>
            <p>
                <label for="email">Email: </label>
                <input name="email" id="email" type="text" <?php if (isset($email) && !$errors['email'] && !$errors['exists']) {
                    echo 'value="' . htmlspecialchars($email) . '"';
                } ?>>
            </p>
            <?php if ($errors['pw'])
                echo "<h2 class=\"warning\">{$errors['pw']}</h2>";
            if ($errors['pwmatch'])
                echo "<h2 class=\"warning\">{$errors['pwmatch']}</h2>";
            ?>
            <p>
                <label for="pw1">Password: </label>
                <input name="password1" id="pw1" type="password">
            </p>
            <p>
                <label for="pw2">Confirm Password: </label>
                <input name="password2" id="pw2" type="password">
            </p>

            <?php if ($errors['firstport'])
                echo "<h2 class=\"warning\">{$errors['firstport']}</h2>"; ?>
            <p>
                <label>First Computer Science Portfolio:</label>
                <input type="radio" name="firstport" value="1" <?php if (isset($firstport) && $firstport == '1') {
                    echo 'checked';
                } ?>> Yes
                <input type="radio" name="firstport" value="0" <?php if (isset($firstport) && $firstport == '0') {
                    echo 'checked';
                } ?>> No
            </p>

            <?php if ($errors['accepted'])
                echo "<h2 class=\"warning\">{$errors['accepted']}</h2>"; ?>
            <p>
                <input type="checkbox" name="terms" value="accepted" id="terms" <?php if ($accepted) {
                    echo 'checked';
                } ?>>
                <label for="terms">I accept the terms of using this website</label>
            </p>
            <p>
                <input name="send" type="submit" value="Register">
            </p>
        </fieldset>
    </form>
</section>

<?php
include "includes/footer.php";
echo '<link rel="stylesheet" type="text/css" href="styles/register.css">';
?>
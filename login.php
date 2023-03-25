<?php
$title = "Login";
require("secure_conn.php");
require("includes/header.php");
if (isset($_POST['login'])) {
    $errors = array();

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

    $password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);
    if (empty($password))
        $errors['pw'] = "A password is required";

    while (!$errors) {
        require_once('../../mysqli_connect.php'); // Connect to the db.
        //Query for email
        $sql = "SELECT firstName, emailAddr, pw FROM portfolio_reg WHERE emailAddr = ?";
        $stmt = mysqli_prepare($dbc, $sql);
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $rows = mysqli_num_rows($result);
        if ($rows == 0)
            $errors['no_email'] = "That email address wasn't found";
        else { // email found, validate password
            $result2 = mysqli_fetch_assoc($result); //convert the result object pointer to an associative array 
            $pw_hash = $result2['pw'];
            if (password_verify($password, $pw_hash)) { //passwords match
                $firstName = $result2['firstName'];

                // Start session and store user info in session variables
                session_start();
                $_SESSION['firstName'] = $firstName;
                $_SESSION['email'] = $email;

                // Redirect to logged_in.php
                header('Location: dashboard.php');
                exit;
            } else {
                $errors['wrong_pw'] = "That isn't the correct password";
            }
        }
    } // end while 	
} //end isset $_POST['send']
?>
<section>
    <form method="post" action="login.php" name="login" class="login-form">
        <fieldset>
            <legend>Registered Users Login</legend>
            <?php if ($errors)
                echo "<h2 class=\"warning\">Please fix the item(s) indicated.</h2>";

            if ($errors['email'])
                echo "<h2 class=\"warning\">{$errors['email']}</h2>";
            if ($errors['no_email'])
                echo "<h2 class=\"warning\">{$errors['no_email']}</h2>";
            ?>
            <p>
                <label for="email">Email: </label>
                <input name="email" id="email" type="text" <?php if (isset($email) && !$errors['no_email']) {
                    echo 'value="' . htmlspecialchars($email) . '"';
                } ?>>
            </p>
            <?php if ($errors['pw'])
                echo "<h2 class=\"warning\">{$errors['pw']}</h2>";
            if ($errors['wrong_pw'])
                echo "<h2 class=\"warning\">{$errors['wrong_pw']}</h2>";
            ?>
            <p>
                <label for="pw">Password: </label>
                <input name="password" id="pw" type="password">
            </p>
            <p>
                <input name="login" type="submit" value="Login">
            </p>
            <p>
                Don't have an account? <a href="register.php" class="register-link">Register Here</a>
            </p>
        </fieldset>
    </form>
</section>
<?php
include "includes/footer.php";
echo '<link rel="stylesheet" type="text/css" href="styles/login.css">';
?>
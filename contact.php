<!-- Mark Karels -->

<?php
$title = "Contact";
require("header.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $message = $_POST["message"];

    $errors = array();

    function validateInput($input, $fieldName)
    {
        if (empty($input)) {
            $errors[] = "Please enter your " . $fieldName . ".";
            return false;
        }
        return true;
    }

    validateInput($name, "name");
    validateInput($email, "email");
    validateInput($phone, "phone");
    validateInput($message, "message");

    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p>" . $error . "</p>";
        }
    } else {
        echo "The form data has been processed!";
    }
}
?>

<section>
    <h1>Contact</h1>
    <p>Fill out the form below to get in touch with me.</p>
    <form class="contact-form" action="submit-form.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <label for="phone">Phone Number:</label>
        <input type="tel" id="phone" name="phone" required>
        <label for="message">Message:</label>
        <textarea id="message" name="message" required></textarea>
        <button type="submit">Send</button>
    </form>
</section>

<?php
include "footer.php";
?>
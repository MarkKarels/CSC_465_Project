<?php
$title = "Contact";
require("includes/header.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = filter_var($_POST["fullname"], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $phone = filter_var($_POST["phone"], FILTER_SANITIZE_NUMBER_INT);
    $message = filter_var($_POST["message"], FILTER_SANITIZE_STRING);

    $errors = array();

    function validateInput($input, $fieldName)
    {
        if (empty($input)) {
            $errors[] = "Please enter your " . $fieldName . ".";
            return false;
        }
        return true;
    }

    validateInput($fullname, "fullname");
    validateInput($email, "email");
    validateInput($phone, "phone");
    validateInput($message, "message");

    // validate email address format using regex
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p>" . $error . "</p>";
        }
    } else {
        // send email
        $to = "mak8966@uncw.edu";
        $subject = "Contact Form Submission";
        $body = "Name: $fullname\nEmail: $email\nPhone: $phone\nMessage: " . htmlspecialchars_decode($message);
        $headers = "From: $email";

        if (mail($to, $subject, $body, $headers)) {
            echo "<p class='message' style='text-align: center;'>Thank you for contacting us. We will get back to you soon.</p>";
        } else {
            echo "<p class='message' style='text-align: center;'>There was an error sending your message. Please try again later.</p>";
        }
    }
}
?>

<section>
    <h1>Contact</h1>
    <p>Fill out the form below to get in touch with me.</p>
    <form class="contact-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="fullname">Name:</label>
        <input type="text" id="fullname" name="fullname" required>
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
include "includes/footer.php";
?>
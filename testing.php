<!-- Mark Karels -->
<?php
$title = "Code Testing";
require_once 'secure_conn.php';
require("includes/header.php");
echo '<link rel="stylesheet" type="text/css" href="styles/testing.css">';
?>

<section>
    <h1>Code Testing</h1>
    <h2>Python</h2>
    <div class="iframe-container">
        <iframe src="https://www.jdoodle.com/python3-programming-online/"></iframe>
    </div>
    <h2>Java</h2>
    <div class="iframe-container">
        <iframe src="https://www.jdoodle.com/online-java-compiler/"></iframe>
    </div>
    <h2>PHP</h2>
    <div class="iframe-container">
        <iframe src="https://www.jdoodle.com/php-online-editor/"></iframe>
    </div>
    <h2>HTML, CSS, and JS</h2>
    <div class="iframe-container">
        <iframe src="https://www.jdoodle.com/html-css-javascript-online-editor/"></iframe>
    </div>
</section>

<?php
include "includes/footer.php";
?>
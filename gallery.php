<!-- Mark Karels -->

<?php
$title = "Gallery";
require 'includes/header.php';
echo '<script src="./includes/function.js"></script>';

echo "<main>";
if (isset($_SESSION['folder'])) {
    echo "<h2>Click on an image to view it in a separate window.</h2>";
    echo "<ul>";

    // This script lists the images in the uploads directory.
    // This version now shows each image's file size and uploaded date and time.

    // Set the default timezone:
    date_default_timezone_set('America/New_York');
    $folder = $_SESSION['folder'];
    $imgDir = '../../uploads/' . $folder;
    $files = scandir($imgDir); // Read all the images into an array.

    // Display each image caption as a link to the JavaScript function:
    foreach ($files as $image) {

        if (substr($image, 0, 1) != '.') { // Ignore anything starting with a period.

            // Get the image's size in pixels:
            $image_size = getimagesize("$imgDir/$image");

            // Make the image's name URL-safe:
            $image_name = urlencode($image);

            // Print the information:
            echo "<li><a href=\"javascript:create_window('$image_name',$image_size[0],$image_size[1])\">$image</a></li>";
        } // End IF.

    } // End of the foreach loop.
    echo '</ul></main>';
} //end isset
else {
    echo "<h2>We are sorry, but you must be logged in as a registered user to view images</h2>";
}
include 'includes/footer.php';
echo '<link rel="stylesheet" type="text/css" href="styles/gallery.css">';
?>
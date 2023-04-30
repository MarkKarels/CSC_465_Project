<?php
$title = "Admin";
define('MAX_SIZE', 1000);
require 'includes/header.php';
session_start();
if (isset($_SESSION['email']) != 'adminprofile@uncw.edu') {
    header("Location: login.php");
    exit();
}

if (isset($_POST['submit'])) {
    if (isset($_FILES['site_img'])) {
        $filename = $_FILES['site_img']['name'];
        $destination = $_SERVER['CONTEXT_DOCUMENT_ROOT'] . "/project/images/$filename";
        if (move_uploaded_file($_FILES['site_img']['tmp_name'], $destination)) {
            $img = getimagesize("images/$filename");
            $width = $img[0];
            $height = $img[1];
            $type = $img['mime'];
            if ($width <= MAX_SIZE && $height <= MAX_SIZE) {
                $ratio = 1;
            } elseif ($width > $height) {
                $ratio = MAX_SIZE / $width;
            } else {
                $ratio = MAX_SIZE / $height;
            }
            $new_w = round($width * $ratio);
            $new_h = round($height * $ratio);
            $shortType = substr($type, 6); //strip off MIME: image/
            if ($shortType == 'gif') {
                $resource = imagecreatefromgif($destination);
            } elseif ($shortType == 'png') {
                $resource = imagecreatefrompng($destination);
            } else {
                $resource = imagecreatefromjpeg($destination);
            }
            $resized = imagecreatetruecolor($new_w, $new_h); //Create a new blank image of the specified size.
            imagecopyresampled($resized, $resource, 0, 0, 0, 0, $new_w, $new_h, $width, $height);
            $new_destination = "images/$filename";
            if ($shortType == 'gif') {
                imagegif($resized, $new_destination);
            } elseif ($shortType == 'png') {
                imagepng($resized, $new_destination);
            } else {
                imagejpeg($resized, $new_destination);
            }

            //Send image data to db:
            if (isset($_POST['caption']))
                $caption = filter_var(trim($_POST['caption']), FILTER_SANITIZE_STRING);
            else
                $caption = NULL;
            if (isset($_POST['price']))
                $price = filter_var(trim($_POST['price']), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            else
                $price = NULL;

            if (isset($_POST['details']))
                $details = filter_var(trim($_POST['details']), FILTER_SANITIZE_STRING);
            else
                $details = NULL;
            require_once('../../mysqli_connect.php'); // Connect to the db.
            include 'includes/create_thumb.php';
            $sql = "INSERT into portfolio_images(filename, caption, details) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($dbc, $sql);
            mysqli_stmt_bind_param($stmt, 'sss', $filename, $caption, $details);
            mysqli_stmt_execute($stmt);
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                echo "<main><h2>We have saved the new item</h2>";
                echo "<img src = 'images/$filename'></main>";
                mysqli_stmt_close($stmt);
            } else {
                echo "<main><h3>There was a problem saving to the database</h3></main>";
                include 'includes/footer.php';
                exit;
            }
        } elseif ($_FILES['site_img']['error'] > 0) {
            echo '<p class="error">The file could not be uploaded because: <strong>';

            // Print a message based upon the error.
            switch ($_FILES['site_img']['error']) {
                case 1:
                    echo 'The file exceeds the upload_max_filesize setting in php.ini.';
                    break;
                case 2:
                    echo 'The file exceeds the MAX_FILE_SIZE setting in the HTML form.';
                    break;
                case 3:
                    echo 'The file was only partially uploaded.';
                    break;
                case 4:
                    echo 'No file was uploaded.';
                    break;
                case 6:
                    echo 'No temporary folder was available.';
                    break;
                case 7:
                    echo 'Unable to write to the disk.';
                    break;
                case 8:
                    echo 'File upload stopped.';
                    break;
                default:
                    echo 'A system error occurred.';
                    break;
            } // End of switch.
            echo '</strong></p>';
        } // End of error IF.
        else {
            echo "<main><h3>Some unknown error has occurred.</h3></main>";
            //exit;
        }
    } //isset $_FILES
    include 'includes/footer.php';
    //release the uploaded file resource
    if (file_exists($_FILES['site_img']['tmp_name']) && is_file($_FILES['site_img']['tmp_name']))
        unlink($_FILES['site_img']['tmp_name']);
    exit;
}
?>
<main>
    <h2>Admin Upload Site Images</h2>
    <form action="admin.php" method="post" enctype="multipart/form-data">
        <label for="site_img">Select an image to upload:</label>
        <input type="file" name="site_img" id="site_img" accept="image/*"><br><br>
        <label for="caption">Image Caption:</label>
        <input type="text" name="caption" id="caption"><br><br>
        <label for="details">Item Details:</label>
        <textarea name="details" id="details" rows="4" cols="50"></textarea><br><br>
        <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_SIZE * MAX_SIZE; ?>">
        <input type="submit" name="submit" value="Upload Image">
    </form>
</main>
<?php // Include the footer and quit the script:
include('includes/footer.php');
?>
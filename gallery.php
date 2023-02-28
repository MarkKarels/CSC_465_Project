<!-- Mark Karels -->

<?php
$title = "Gallery";
require("header.php");

// set the directory where uploaded images will be saved
$targetDir = "assets/images";

// check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // get the uploaded file and other form data
    $fileName = $_FILES["file"]["name"];
    $fileType = $_FILES["file"]["type"];
    $fileSize = $_FILES["file"]["size"];
    $fileTmpName = $_FILES["file"]["tmp_name"];
    $description = $_POST["description"];

    // set the file path to save the uploaded image
    $filePath = $targetDir . $fileName;

    // check if the uploaded file is an image
    if (getimagesize($fileTmpName)) {
        // move the uploaded file to the target directory
        if (move_uploaded_file($fileTmpName, $filePath)) {
            // add the image data to a JSON file
            $jsonData = file_get_contents("gallery.json");
            $images = json_decode($jsonData, true);
            $images[] = array("file" => $fileName, "description" => $description);
            $jsonData = json_encode($images);
            file_put_contents("gallery.json", $jsonData);

            echo "<p>File uploaded successfully.</p>";
        } else {
            echo "<p>There was an error uploading your file. Please try again later.</p>";
        }
    } else {
        echo "<p>Invalid file type. Please upload an image file.</p>";
    }
}
?>

<section>
    <h1>Gallery</h1>
    <p>Show screenshots and/or videos of your working assignments to prospective employers.</p>

    <!-- display images from JSON file -->
    <?php
    $jsonData = file_get_contents("gallery.json");
    $images = json_decode($jsonData, true);

    foreach ($images as $image) {
        // create a div to contain the image and description
        echo "<div class='image-container'>";

        // display the image
        echo "<img src='" . $targetDir . $image["file"] . "' alt='" . $image["description"] . "'>";

        // display the image description
        echo "<p>" . $image["description"] . "</p>";

        // close the image-container div
        echo "</div>";
    }
    ?>

    <!-- add image upload form -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
        <label for="file">Choose image:</label>
        <input type="file" name="file" id="file" required>
        <label for="description">Image description:</label>
        <textarea name="description" id="description" required></textarea>
        <button type="submit">Upload</button>
    </form>
</section>

<style>
    .image-container {
        float: left;
        width: 50%;
        box-sizing: border-box;
        padding: 10px;
        text-align: center;
    }

    .image-container img {
        max-width: 100%;
        height: auto;
    }
</style>
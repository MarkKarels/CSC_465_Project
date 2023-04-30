<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}
$title = "Gallery";
require 'includes/header.php';
echo '<link rel="stylesheet" type="text/css" href="styles/gallery.css">';
function shortTitle($title)
{
    $title = substr($title, 0, -4);
    $title = str_replace('_', ' ', $title);
    $title = ucwords($title);
    return $title;
}

// echo '<script src="./includes/function.js"></script>';

define('COLS', 2);
define('ROWS', 3);

echo "<section>";
if (isset($_SESSION['folder'])) {
    echo "<h2><a href=\"upload_image.php\">Click Here To Upload Image</a></h2>";
    echo "<h2>Click on an image to view it in a separate window.</h2>";

    // Set the default timezone:
    date_default_timezone_set('America/New_York');
    $folder = $_SESSION['folder'];
    $imgDir = '../../uploads/' . $folder;
    $files = array_diff(scandir($imgDir), array('.', '..')); // Read all the images into an array and remove '.' and '..' entries.

    $numImages = count($files);
    $numPages = ceil($numImages / (COLS * ROWS));
    $pageNumber = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $offset = (COLS * ROWS) * ($pageNumber - 1);
    $files = array_slice($files, $offset, COLS * ROWS);

    $counter = 0;
    ?>

<section id="gallery">
    <table id="thumbs">
        <?php
            foreach ($files as $image) {

                if ($counter % COLS == 0) {
                    echo "<tr>";
                }

                $image_name = urlencode($image);
                $image_size = getimagesize("$imgDir/$image");

                echo '<td><a href="gallery.php?page=' . $pageNumber . '&image=' . $image_name . '"><img src="thumbnail.php?image=' . $image_name . '" alt="' . $image . '" width="80" height="54"></a></td>';

                $counter++;
                if ($counter % COLS == 0) {
                    echo "</tr>";
                }
            }
            while ($counter % COLS != 0) {
                echo '<td></td>';
                $counter++;
            }
            ?>
        <tr>
            <td colspan="<?php echo COLS; ?>">
                <?php
                    if ($pageNumber > 1) {
                        echo '<a href="gallery.php?page=' . ($pageNumber - 1) . '">&lt;&lt;Prev</a>';
                    }
                    for ($i = 1; $i <= $numPages; $i++) {
                        if ($i == $pageNumber) {
                            echo " $i ";
                        } else {
                            echo ' <a href="gallery.php?page=' . $i . '">' . $i . '</a> ';
                        }
                    }
                    if ($pageNumber < $numPages) {
                        echo '<a href="gallery.php?page=' . ($pageNumber + 1) . '">Next&gt;&gt;</a>';
                    }
                    ?>
            </td>
        </tr>
    </table>
    <?php
        if (isset($_GET['image'])) {
            $selectedImage = urldecode($_GET['image']);
        } else {
            $selectedImage = $files[0]; // Default to the first image in the folder.
        }
        $selectedImageSrc = $imgDir . '/' . $selectedImage;
        echo '<figure id="main_image">
        <img id="large_image" src="thumbnail.php?image=' . urlencode($files[0]) . '&large=true" alt="' . shortTitle($files[0]) . '">
        <figcaption>' . shortTitle($selectedImage) . '</figcaption>
        </figure>';

        ?>
    <div style="text-align: center;"></div>
</section>

<?php
    echo '</section>';
} //end isset
else {
    echo "<h2>We are sorry, but you must be logged in as a registered user to view images</h2>";
}?>
<script>
document.addEventListener("DOMContentLoaded", function() {
    var thumbnailImages = document.querySelectorAll("#thumbs a");
    var mainImage = document.querySelector("#main_image img");

    thumbnailImages.forEach(function(thumbnail) {
        thumbnail.addEventListener("click", function(event) {
            event.preventDefault();
            var selectedImageSrc = this.href.replace("gallery.php", "thumbnail.php") +
                "&large=true";
            mainImage.src = selectedImageSrc;
            mainImage.alt = this.children[0].alt;
        });
    });
});
</script>
<?php
include 'includes/footer.php';
?>
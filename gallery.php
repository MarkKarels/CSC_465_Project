<!-- Mark Karels -->

<?php
$title = "Gallery";
require 'includes/header.php';
require_once '../../mysqli_connect.php';

define('COLS', 2);
define('ROWS', 3);

$countQuery = "SELECT COUNT(*) AS numImages FROM Portfolio_Images";
$countResult = mysqli_query($dbc, $countQuery);
if (!$countResult) {
    echo "We are unable to process your request at this time. Please try again later.";
    include 'includes/footer.php';
    exit;
}

function shortTitle($title)
{
    $title = substr($title, 0, -4);
    $title = str_replace('_', ' ', $title);
    $title = ucwords($title);
    return $title;
}

$countRow = mysqli_fetch_assoc($countResult);
$numImages = $countRow['numImages'];
$numPages = ceil($numImages / (COLS * ROWS));
$pageNumber = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = (COLS * ROWS) * ($pageNumber - 1);
$imageQuery = "SELECT filename, caption FROM Portfolio_Images LIMIT $offset, " . (COLS * ROWS);
$imageResult = mysqli_query($dbc, $imageQuery);
if (!$imageResult) {
    echo "We are unable to process your request at this time. Please try again later.";
    include 'includes/footer.php';
    exit;
}

$counter = 0;
$selectedFilename = isset($_GET['filename']) ? $_GET['filename'] : '';

$selectedCaption = '';
?>
<main>
    <h2>Portfolio Project Photos</h2>
    <?php
    $firstImage = ($offset + 1);
    $lastImage = min($firstImage + (COLS * ROWS) - 1, $numImages);
    ?>
    <p id="picCount">Displaying images
        <?= $firstImage ?> to
        <?= $lastImage ?> of
        <?= $numImages ?>
    </p>
    <section id="gallery">
        <table id="thumbs">
            <?php
            while ($imageRow = mysqli_fetch_assoc($imageResult)) {
                if ($counter % COLS == 0) {
                    echo "<tr>";
                }
                echo '<td><a href="gallery.php?filename=' . $imageRow['filename'] . '&page=' . $pageNumber . '"><img src="images/' . $imageRow['filename'] . '" alt="' . shortTitle($imageRow['caption']) . '" width="80" height="54"></a></td>';

                if ($selectedFilename == '' || $selectedFilename == $imageRow['filename']) {
                    $selectedFilename = $imageRow['filename'];
                    $selectedCaption = $imageRow['caption'];
                }

                $counter++;
            }
            while ($counter % COLS != 0) {
                echo '<td></td>';
                $counter++;
            }
            if ($counter % COLS == 0) {
                echo "</tr>";
            }

            if ($pageNumber == 1 && $lastImage < $numImages) {
                // Display Next link only
                echo '<tr><td colspan="' . (COLS - 1) . '"></td><td><a href="gallery.php?page=' . ($pageNumber + 1) . '&$start=' . ($offset + (COLS * ROWS) + 1) . '">Next&gt;&gt;</a></td></tr>';
            } else if ($pageNumber > 1 && $lastImage < $numImages) {
                // Display Prev and Next links
                echo '<tr><td><a href="gallery.php?page=' . ($pageNumber - 1) . '&$start=' . ($offset - (COLS * ROWS) + 1)
                    . '">&lt;&lt;Prev</a></td><td align="right"><a href="gallery.php?page=' . ($pageNumber + 1) . '&$start=' . ($offset + (COLS * ROWS)) . '">Next&gt;&gt;</a></td></tr>';
            } else if ($pageNumber > 1) {
                // Display Prev link only
                echo '<tr><td><a href="gallery.php?page=' . ($pageNumber - 1) . '&$start=' . ($offset - (COLS * ROWS) + 1) . '">&lt;&lt;Prev</a></td><td></td></tr>';
            }
            ?>
        </table>
        <figure id="main_image">
            <img src="images/<?= $selectedFilename ?>" alt="<?= shortTitle($selectedCaption) ?>">
            <figcaption>
                <?= $selectedCaption ?>
            </figcaption>
        </figure>
    </section>
</main>
<?php
include 'includes/footer.php';
echo '<link rel="stylesheet" type="text/css" href="styles/gallery.css">';
?>
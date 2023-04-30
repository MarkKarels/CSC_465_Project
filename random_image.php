<!-- Mark Karels -->
<?php
require_once '../../mysqli_connect.php';

$countQuery = "SELECT COUNT(*) AS numImages FROM portfolio_images";
$countResult = mysqli_query($dbc, $countQuery);
if (!$countResult) {
    echo "We are unable to process your request at this time. Please try again later.";
    include 'includes/footer.php';
    exit;
}

$row = mysqli_fetch_assoc($countResult);
$numImages = $row['numImages'];
$i = mt_rand(1, $numImages) - 1;
$imageQuery = "SELECT filename, caption FROM portfolio_images LIMIT $i, 1";
$imageResult = mysqli_query($dbc, $imageQuery);

if ($imageRow = mysqli_fetch_assoc($imageResult)) {
    $filename = $imageRow['filename'];
    $caption = $imageRow['caption'];
    $imageSrc = "images/" . $filename;
    $imageInfo = getimagesize($imageSrc);
}
?>
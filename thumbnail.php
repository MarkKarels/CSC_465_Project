<?php
session_start();

function resize_image($file, $width, $height)
{
    list($originalWidth, $originalHeight) = getimagesize($file);
    $ratio = $originalWidth / $originalHeight;

    if ($width / $height > $ratio) {
        $width = $height * $ratio;
    } else {
        $height = $width / $ratio;
    }

    $img = "";
    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    if ($ext === 'jpeg' || $ext === 'jpg') {
        $img = imagecreatefromjpeg($file);
    } else if ($ext === 'gif') {
        $img = imagecreatefromgif($file);
    } else if ($ext === 'png') {
        $img = imagecreatefrompng($file);
    }

    $dst = imagecreatetruecolor($width, $height);
    imagecopyresampled($dst, $img, 0, 0, 0, 0, $width, $height, $originalWidth, $originalHeight);
    imagedestroy($img);
    return $dst;
}

if (!isset($_SESSION['folder'])) {
    header("Location: ./error_page.php"); // Replace with the path to your error page.
    exit;
} else {
    $folder = $_SESSION['folder'];
    $name = FALSE;

    if (isset($_GET['image'])) {
        $ext = strtolower(substr($_GET['image'], -4));
        if (($ext == '.jpg') or ($ext == 'jpeg') or ($ext == '.png') or ($ext == '.gif')) {
            $image = "../../uploads/$folder/{$_GET['image']}";

            if (file_exists($image) && (is_file($image))) {
                $name = $_GET['image'];
            }
        }
    }

    if (!$name) {
        $image = 'unavailable.png';
        $name = 'unavailable.png';
    }

    $info = getimagesize($image);
    $fs = filesize($image);
    $isLargeImage = isset($_GET['large']);

    if ($isLargeImage) {
        $width = $info[0] * 2;
        $height = $info[1] * 2;
        $resizedImage = resize_image($image, $width, $height);

        header("Content-Type: {$info['mime']}\n");
        header("Content-Disposition: inline; filename=\"$name\"\n");

        if ($info[2] === IMAGETYPE_JPEG) {
            imagejpeg($resizedImage);
        } elseif ($info[2] === IMAGETYPE_GIF) {
            imagegif($resizedImage);
        } elseif ($info[2] === IMAGETYPE_PNG) {
            imagepng($resizedImage);
        }
    } else {
        header("Content-Type: {$info['mime']}\n");
        header("Content-Disposition: inline; filename=\"$name\"\n");
        header("Content-Length: $fs\n");

        readfile($image);
    }
}
?>
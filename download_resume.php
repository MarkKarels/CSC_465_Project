<?php
session_start();

if (!isset($_SESSION['email'])) {
    echo "Access denied. Please login.";
    exit;
}

// Function to get the file extension
function getFileExtension($file)
{
    $info = new SplFileInfo($file);
    return $info->getExtension();
}

$folder = $_SESSION['folder'];
$resume_path = "../../uploads/$folder/resume";
$resume_file = '';
$allowed_extensions = array('docx', 'pdf');

foreach ($allowed_extensions as $extension) {
    if (file_exists($resume_path . '.' . $extension)) {
        $resume_file = $resume_path . '.' . $extension;
        break;
    }
}

if ($resume_file) {
    $file_extension = getFileExtension($resume_file);
    $content_type = ($file_extension === 'docx') ? 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' : 'application/pdf';

    header('Content-Description: File Transfer');
    header('Content-Type: ' . $content_type);
    header('Content-Disposition: attachment; filename="' . basename($resume_file) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($resume_file));
    readfile($resume_file);
    exit;
} else {
    echo "No file found. Please upload a resume.";
    exit;
}
?>
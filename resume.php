<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}
$title = "Resume";
require("includes/header.php");
echo '<link rel="stylesheet" type="text/css" href="styles/resume.css">';

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
        $resume_file = "uploads/$folder/resume" . '.' . $extension;
        break;
    }
}

if (isset($_POST['submit'])) {
    if (isset($_FILES['resume']) && $_FILES['resume']['error'] == 0) {
        $file_extension = getFileExtension($_FILES['resume']['name']);

        if (in_array($file_extension, $allowed_extensions)) {
            if (move_uploaded_file($_FILES['resume']['tmp_name'], $resume_path . '.' . $file_extension)) {
                echo "<p class='success'>Resume uploaded successfully.</p>";
                $resume_file = $resume_path . '.' . $file_extension;
            } else {
                echo "<p class='error'>Failed to upload resume. Please try again.</p>";
            }
        } else {
            echo "<p class='error'>Invalid file type. Only .docx and .pdf files are allowed.</p>";
        }
    } else {
        echo "<p class='error'>Please select a resume to upload.</p>";
    }
}
?>
<div class="resume-container">
    <section>
        <h1>Resume</h1>
        <p>Upload your most up-to-date resume here and those who visit the site can download your resume for use.</p>

        <form enctype="multipart/form-data" action="resume.php" method="post">
            <label for="resume">Select a .docx or .pdf resume file:</label>
            <input type="file" name="resume" id="resume">
            <br>
            <input type="submit" name="submit" value="Upload/Replace Resume">
        </form>

        <br>

        <?php if ($resume_file): ?>
            <a href="download_resume.php" download>Download Resume</a>
        <?php else: ?>
            <p>Please upload a resume.</p>
        <?php endif; ?>
    </section>
</div>
<?php
include "includes/footer.php";
?>
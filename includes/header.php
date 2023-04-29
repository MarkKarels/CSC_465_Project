<!-- Mark Karels -->

<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>
        <?php echo $title; ?>
    </title>
    <link rel="icon" type="image/x-icon" href="assets/images/EPP.ico">
    <link rel="stylesheet" type="text/css" href="styles/main.css">
</head>

<body>
    <header>
        <div class="logo-container">
            <a href="index.php">
                <img src="assets/images/EPP.png" alt="Engineering Personal Portfolio">
            </a>
            <span id="name">
                <?php echo $title; ?>
            </span>
        </div>
        <nav>
            <ul>
                <li <?php if ($title == 'Engineering Personal Portfolio')
                    echo 'class="current"'; ?>><a
                        href="index.php">Home</a></li>
                <li <?php if ($title == 'Projects')
                    echo 'class="current"'; ?>><a href="projects.php">Projects</a></li>
                <li <?php if ($title == 'School Schedule')
                    echo 'class="current"'; ?>><a href="schedule.php">Schedule</a>
                </li>
                <li <?php if ($title == 'Resume')
                    echo 'class="current"'; ?>><a href="resume.php">Resume</a></li>
                <li <?php if ($title == 'Gallery')
                    echo 'class="current"'; ?>><a href="gallery.php">Gallery</a></li>
                <li <?php if ($title == 'Contact')
                    echo 'class="current"'; ?>><a href="contact.php">Contact</a></li>
                <?php if (isset($_SESSION['email'])) { // User is logged in, show logout link ?>
                    <li><a href="logged_out.php">Logout</a></li>
                <?php } else { ?>
                    <li <?php if ($title == 'Login')
                        echo 'class="current"'; ?>><a href="login.php">Login</a></li>
                <?php } ?>
            </ul>
        </nav>
    </header>
    <main>
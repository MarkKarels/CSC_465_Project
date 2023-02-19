<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>
        <?php echo $title; ?>
    </title>
    <link rel="stylesheet" type="text/css" href="styles/main.css">
</head>

<body>
    <header>
        <div class="logo-container">
            <a href="index.php">
                <img src="assets/images/EPP.png" alt="Engineering Personal Portfolio">
            </a>
        </div>
        <nav>
            <ul>
                <li <?php if ($title == 'Engineering Personal Portfolio')
                    echo 'class="current"'; ?>><a href="index.php">Home</a></li>
                <li <?php if ($title == 'Projects')
                    echo 'class="current"'; ?>><a href="projects.php">Projects</a></li>
                <li <?php if ($title == 'School Schedule')
                    echo 'class="current"'; ?>><a href="schedule.php">Schedule</a>
                </li>
                <li <?php if ($title == 'Resume')
                    echo 'class="current"'; ?>><a href="resume.php">Resume</a></li>
                <li <?php if ($title == 'Work History')
                    echo 'class="current"'; ?>><a href="work-history.php">Work
                        History</a></li>
                <li <?php if ($title == 'Gallery')
                    echo 'class="current"'; ?>><a href="gallery.php">Gallery</a></li>
                <li <?php if ($title == 'Contact')
                    echo 'class="current"'; ?>><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
    </header>
    <main>
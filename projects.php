<!-- Mark Karels -->

<?php
$title = "Projects";
require("includes/header.php");
?>

<section>
    <h1>Projects</h1>
    <p>
        Here you can test code to your hearts content using the following IDEs
    </p>
    <div class="row">
        <div class="column">
            <h2>PYTHON</h2>
            <iframe height="500px" width="100%" src="https://repl.it/@MarkKarels/PythonIDE?lite=true"></iframe>
        </div>
        <div class="column">
            <h2>JAVA</h2>
            <iframe height="500px" width="100%" src="https://repl.it/@MarkKarels/JavaIDE?lite=true"></iframe>
        </div>
    </div>
    <div class="row">
        <div class="column">
            <h2>HTML, CSS, and JAVASCRIPT</h2>
            <iframe height="500px" width="100%" src="https://repl.it/@MarkKarels/FrontEnd?lite=true"></iframe>
        </div>
        <div class="column">
            <h2>C++</h2>
            <iframe height="500px" width="100%" src="https://repl.it/@MarkKarels/CIDE?lite=true"></iframe>
        </div>
    </div>
</section>

<?php
include "includes/footer.php";
echo '<link rel="stylesheet" type="text/css" href="styles/testing.css">';
?>
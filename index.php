<!-- Mark Karels -->

<?php
$title = "Engineering Personal Portfolio";
require("includes/header.php");
echo '<link rel="stylesheet" type="text/css" href="styles/index.css">';
require 'random_image.php'
    ?>

<section>
    <h1>Welcome to my Portfolio Webpage!</h1>
    <h3>
        This is where I showcase coding projects, school schedule, resume,
        and gallery. Click on the tabs above to explore!
    </h3>
    <figure>
        <!-- I included the getimagesize() attribute in the random_image.php for reference in this file -->
        <img src="<?php echo $imageSrc; ?>" alt="Random image" height="<?php echo $imageInfo[1]; ?>"
            width="<?php echo $imageInfo[0]; ?>">
        <figcaption>
            <?php if (isset($imageInfo)) { ?>
                <style scoped>
                    figcaption {
                        width:
                            <?php echo $imageInfo[0];
                            ?>
                            px;
                    }
                </style>
            <?php } ?>
        </figcaption>
    </figure>
    <p>My portfolio showcases a selection of my work and highlights the ways in which I have contributed to the field of
        engineering. Whether you are interested in learning more about my professional experience, exploring my
        technical expertise, or simply viewing examples of my work, I hope that you find this portfolio informative and
        engaging. Thank you for visiting, and please feel free to contact me if you have any questions or would like to
        discuss a potential project or collaboration.</p>
</section>

<?php
include "includes/footer.php";
?>
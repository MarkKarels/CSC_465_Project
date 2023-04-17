function create_window(image, width, height) {
  let largeImageDiv = document.getElementById("large_image");
  let imgTag =
    '<img src="view_image.php?image=' +
    image +
    '" alt="' +
    image +
    '" width="' +
    width +
    '" height="' +
    height +
    '">';
  largeImageDiv.innerHTML = imgTag;
}

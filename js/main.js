const images = document.querySelectorAll(".image");
const list = document.querySelector(".images");
const imageList = Array.from(images);

let slideIndex = 0;
const imageWidth = images[0].clientWidth;

function updateSlide() {
  const a = slideIndex * imageWidth;
  images.forEach((currentImage, index) => {
    if (index !== slideIndex) {
      currentImage.className = "image";
    } else {
      currentImage.classList.toggle("toggle");
    }

    if (index === getPrevIndex()) {
      currentImage.classList.add("image-prev");
    }
  });
}

function getPrevIndex() {
  return slideIndex > 0 ? slideIndex - 1 : images.length - 1;
}

function showNextSlide() {
  if (slideIndex < images.length - 1) {
    slideIndex++;
  } else {
    slideIndex = 0;
  }
  updateSlide();
}

function showPrevSlide() {
  if (slideIndex > 0) {
    slideIndex--;
  } else {
    slideIndex = imageList.length - 1;
  }
  updateSlide();
}

updateSlide();

function showSearchInput() {
  const field = document.querySelector(".find-field");
  const catalog = document.querySelector(".catalog");
  field.classList.toggle("show");
  catalog.classList.toggle("show");

  const iconSearch = document.querySelector("#icon-search");
  if (iconSearch.className === "fa fa-times fa-3x")
    iconSearch.className = "fa fa-search fa-3x";
  else iconSearch.className = "fa fa-times fa-3x";
}

// const images = document.querySelectorAll(".image");
// const list = document.querySelector(".images");
// const imageList = Array.from(images);
//
// let slideIndex = 0;
// const imageWidth = images[0].clientWidth;
const searchInput = document.querySelector(".search-input");
const xmark = document.querySelector("#xmark");
const select = document.querySelector("#category");

const option = window.location.search.substring(10);

select.value = option === "" ? "products" : option;

function selectCategory() {
  const selectedOption = select.options[select.selectedIndex].value;

  if (selectedOption !== "products") {
    window.location.replace(`index.php?category=${selectedOption}`);
  } else window.location.replace("index.php");
}

function clearSearchInput() {
  searchInput.value = "";
  xmark.style.visibility = "hidden";
}

searchInput.addEventListener("input", () => {
  if(searchInput.value.length > 0)
    xmark.style.visibility = "visible";
  else
    xmark.style.visibility = "hidden";
});

searchInput.addEventListener("keydown", (event) => {
  if(event.keyCode === 13) {
    console.log("here");
  }
});

// function updateSlide() {
//   const a = slideIndex * imageWidth;
//   images.forEach((currentImage, index) => {
//     if (index !== slideIndex) {
//       currentImage.className = "image";
//     } else {
//       currentImage.classList.toggle("toggle");
//     }
//
//     if (index === getPrevIndex()) {
//       currentImage.classList.add("image-prev");
//     }
//   });
// }
//
// function getPrevIndex() {
//   return slideIndex > 0 ? slideIndex - 1 : images.length - 1;
// }
//
// function showNextSlide() {
//   if (slideIndex < images.length - 1) {
//     slideIndex++;
//   } else {
//     slideIndex = 0;
//   }
//   updateSlide();
// }
//
// function showPrevSlide() {
//   if (slideIndex > 0) {
//     slideIndex--;
//   } else {
//     slideIndex = imageList.length - 1;
//   }
//   updateSlide();
// }
//
// updateSlide();
//
// function findProducts(selectedOption = "") {
//   const findInput = document.querySelector(".find");
//   const categoryParam = selectedOption ? `category=${selectedOption}` : "";
//   const searchParam = findInput.value ? `search=${findInput.value}` : "";
//
//   const queryString =
//     categoryParam && searchParam
//       ? `?${categoryParam}&${searchParam}`
//       : categoryParam || searchParam
//       ? `?${categoryParam}${searchParam}`
//       : "";
//
//   window.location.href = `index.php${queryString}`;
// }

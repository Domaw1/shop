const searchInput = document.querySelector(".search-input");
const xmark = document.querySelector("#xmark");
const buttonsToCart = document.querySelectorAll(".btn-to-cart");
const categoriesList = document.querySelectorAll(".categories-item");

const sortDown = document.getElementById("sort-down-c");
const sortDownMaterial = document.getElementById("sort-down-m");
const sortUp = document.getElementById("sort-up-c");
const sortUpMaterial = document.getElementById("sort-up-m");

const categories = document.querySelector(".available-categories");
const materials = document.querySelector(".available-materials");

const urlParams = new URLSearchParams(window.location.search);

const categoryOption = urlParams.get('category');
const searchOption = urlParams.get('search');

const selectorCategory = document.querySelector(".select-category");
const selectorMaterial = document.querySelector(".select-material");

const selectMaterial = document.querySelector("#select-material");

searchInput.value = searchOption === null ? "" : searchOption;

if(searchInput.value.length > 0)
  xmark.style.visibility = "visible";
else
  xmark.style.visibility = "hidden";

function addToCart(currentUser) {
  if(currentUser === null) {

  }
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
    const categoryParam = categoryOption ? `category=${categoryOption}` : "";
    const searchParam = searchInput.value ? `search=${searchInput.value}` : "";

    const queryString =
        categoryParam && searchParam
            ? `?${categoryParam}&${searchParam}`
            : categoryParam || searchParam
                ? `?${categoryParam}${searchParam}`
                : "";

    window.location.href = `index.php${queryString}`;
  }
});

selectorCategory.addEventListener("click", () => {
  if(window.getComputedStyle(sortUp).display === "block") {
    sortDown.style.display = "block";
    sortUp.style.display = "none";
    categories.style.display = "block";

    selectorCategory.style.background = "#cfe2fa";
  } else {
    sortDown.style.display = "none";
    sortUp.style.display = "block";
    categories.style.display = "none";

    selectorCategory.style.background = "transparent";
  }
});

selectorMaterial.addEventListener("click", () => {
  if(window.getComputedStyle(sortUpMaterial).display === "block") {
    sortDownMaterial.style.display = "block";
    sortUpMaterial.style.display = "none";
    materials.style.display = "block";

    selectorMaterial.style.background = "#cfe2fa";
  } else {
    sortDownMaterial.style.display = "none";
    sortUpMaterial.style.display = "block";
    materials.style.display = "none";

    selectorMaterial.style.background = "transparent";
  }
});

categoriesList.forEach(category => {
  if(categoryOption === category.id) {
    category.style.background = "#cfe2fa";

    sortDown.style.display = "block";
    sortUp.style.display = "none";
    categories.style.display = "block";

    selectorCategory.style.background = "#cfe2fa";
  }

  category.addEventListener("click", (event) => {
    if(event.target.id === "products") {
      window.location.replace(`index.php`);
    } else {
      window.location.replace(`index.php?category=${event.target.id}`);
    }
  })
});

selectMaterial.addEventListener("click", (event) => {
  const checked = document.querySelectorAll(".material-check");
  let url = "";

  checked.forEach(check => {
    if(check.checked) {
      url += check.value + "&"
    }
  });
  if(url.length === 0) {
    window.location.replace(`index.php`);
  }
  else {
    url = url.substring(0, url.length - 1);
    window.location.replace(`index.php?materials=${url}`);  
  }
});
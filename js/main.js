const searchInput = document.querySelector(".search-input");
const xmark = document.querySelector("#xmark");
const buttonsToCart = document.querySelectorAll(".btn-to-cart");
const categoriesList = document.querySelectorAll(".categories-item");

const sortDown = document.getElementById("sort-down");
const sortUp = document.getElementById("sort-up");
const categories = document.querySelector(".available-categories");

const urlParams = new URLSearchParams(window.location.search);

const categoryOption = urlParams.get('category');
const searchOption = urlParams.get('search');

const selector = document.querySelector(".select-category");

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

selector.addEventListener("click", (event) => {

  if(window.getComputedStyle(sortUp).display === "block") {
    sortDown.style.display = "block";
    sortUp.style.display = "none";
    categories.style.display = "block";

    selector.style.background = "#cfe2fa";
  } else {
    sortDown.style.display = "none";
    sortUp.style.display = "block";
    categories.style.display = "none";

    selector.style.background = "transparent";
  }
});

categoriesList.forEach(category => {
  if(categoryOption === category.id) {
    category.style.background = "#cfe2fa";

    sortDown.style.display = "block";
    sortUp.style.display = "none";
    categories.style.display = "block";

    selector.style.background = "#cfe2fa";
  }

  category.addEventListener("click", (event) => {
    if(event.target.id === "products") {
      window.location.replace(`index.php`);
    } else {
      window.location.replace(`index.php?category=${event.target.id}`);
    }
  })
});
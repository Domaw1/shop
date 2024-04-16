const searchInput = document.querySelector(".search-input");
const xmark = document.querySelector("#xmark");
const buttonsToCart = document.querySelectorAll(".btn-to-cart");
const categoriesList = document.querySelectorAll(".categories-item");

const sortDown = document.getElementById("sort-down-c");
const sortDownMaterial = document.getElementById("sort-down-m");
const sortDownFilter = document.getElementById("sort-down-f");
const sortUp = document.getElementById("sort-up-c");
const sortUpMaterial = document.getElementById("sort-up-m");
const sortUpFilter = document.getElementById("sort-up-f");
const categories = document.querySelector(".available-categories");
const select = document.querySelector('.select');
const sortFilters = document.querySelector('.sort-filters');
const materials = document.querySelector(".available-materials");

const checkboxes = document.querySelectorAll(".material-check");

const urlParams = new URLSearchParams(window.location.search);

const categoryOption = urlParams.get("category");
const searchOption = urlParams.get("search");
const materialOption = urlParams.get("materials");

const selectorCategory = document.querySelector(".select-category");
const selectorMaterial = document.querySelector(".select-material");

searchInput.value = searchOption === null ? "" : searchOption;

if (materialOption) {
  const materialArr = materialOption.split("-");

  checkboxes.forEach((check) => {
    if (materialArr.includes(check.value)) {
      check.checked = true;
    }
  });

  sortDownMaterial.style.display = "block";
  sortUpMaterial.style.display = "none";
  materials.style.display = "block";

  selectorMaterial.style.background = "#cfe2fa";
}

if (searchInput.value.length > 0) xmark.style.visibility = "visible";
else xmark.style.visibility = "hidden";

function clearSearchInput() {
  searchInput.value = "";
  xmark.style.visibility = "hidden";
}

searchInput.addEventListener("input", () => {
  if (searchInput.value.length > 0) xmark.style.visibility = "visible";
  else xmark.style.visibility = "hidden";
});

searchInput.addEventListener("keydown", (event) => {
  if (event.keyCode === 13) {
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
  if (window.getComputedStyle(sortUp).display === "block") {
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
  if (window.getComputedStyle(sortUpMaterial).display === "block") {
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

categoriesList.forEach((category) => {
  if (categoryOption === category.id) {
    category.style.background = "#cfe2fa";

    sortDown.style.display = "block";
    sortUp.style.display = "none";
    categories.style.display = "block";

    selectorCategory.style.background = "#cfe2fa";
  }

  category.addEventListener("click", (event) => {
    if (event.target.id === "products") {
      if (materialOption)
        window.location.replace(`index.php?materials=${materialOption}`);
      else window.location.replace(`index.php`);
    } else {
      if (materialOption)
        window.location.replace(`index.php?category=${event.target.id}&materials=${materialOption}`);
      else window.location.replace(`index.php?category=${event.target.id}`);
    }
  });
});

const but = document.querySelector("#but");

but.addEventListener("click", () => {
  let url = "";

  checkboxes.forEach((c) => {
    if (c.checked) {
      url += c.value + "-";
    }
  });

  if (url.length === 0) {
    if (categoryOption)
      window.location.replace(`index.php?category=${categoryOption}`);
    else window.location.replace("index.php");
  } else {
    url = url.substring(0, url.length - 1);
    if (categoryOption)
      window.location.replace(
          `index.php?category=${categoryOption}&materials=${url}`
      );
    else window.location.replace(`index.php?materials=${url}`);
  }
});


select.addEventListener("click", (event) => {
  if (window.getComputedStyle(sortUpFilter).display === "block") {
    sortDownFilter.style.display = "block";
    sortUpFilter.style.display = "none";
    sortFilters.style.opacity = "1";
  } else {
    sortDownFilter.style.display = "none";
    sortUpFilter.style.display = "block";
    sortFilters.style.opacity = "0";
  }
})

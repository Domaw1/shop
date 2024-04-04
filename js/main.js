const searchInput = document.querySelector(".search-input");
const xmark = document.querySelector("#xmark");
const select = document.querySelector("#category");
const buttonsToCart = document.querySelectorAll(".btn");

const urlParams = new URLSearchParams(window.location.search);

const categoryOption = urlParams.get('category');
const searchOption = urlParams.get('search');

select.value = categoryOption === null ? "products" : categoryOption;
searchInput.value = searchOption === null ? "" : searchOption;

if(searchInput.value.length > 0)
  xmark.style.visibility = "visible";
else
  xmark.style.visibility = "hidden";

function addToCart(currentUser) {
  if(currentUser === null) {

  }

}

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
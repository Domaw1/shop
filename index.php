<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="./styles/main.css" />
  <title>Main</title>
</head>

<body>
  <?php require "connection.php";
  $query = mysqli_query($conn, "SELECT * FROM categories");
  $categories = mysqli_fetch_all($query);

  $productQuery = mysqli_query($conn, "SELECT * FROM products");
  $products = mysqli_fetch_all($productQuery);

  $currentUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  $path = parse_url($currentUrl, PHP_URL_QUERY);
  $selectedCategory = substr($path, 9);
  $filter = mysqli_query(
    $conn,
    "SELECT * FROM products INNER JOIN categories ON categories.idCategory = products.idCategory
      WHERE categories.nameCategory = '$selectedCategory' ORDER BY products.idProduct"
  );
  $filteredProducts = mysqli_fetch_all($filter);

  if (count($filteredProducts) == 0) {
    $filteredProducts = $products;
  }
  ?>

  <header>
    <div class="shop-title">
      <i class="fa fa-birthday-cake fa-4x" aria-hidden="true"></i>
      <h1>Sweet Shop</h1>
    </div>
    <div class="catalog">
      <div class="link">
        <h2>Catalog</h2>
      </div>
      <div class="link">
        <h2>Requisites</h2>
      </div>
    </div>
    <div class="icons">
      <div class="find-field">
        <input type="text" class="find" placeholder="Find..." />
        <i class="fa fa-search fa-3x" aria-hidden="true" style="cursor: pointer"></i>
      </div>
      <i class="fa fa-search fa-3x" id="icon-search" aria-hidden="true" style="cursor: pointer"
        onclick="showSearchInput()"></i>
      <a href="./cart.html">
        <i class="fa fa-shopping-cart fa-3x" aria-hidden="true" style="cursor: pointer"></i>
      </a>
      <a href="./profile.html">
        <i class="fa fa-user fa-3x" aria-hidden="true"></i>
      </a>
    </div>
  </header>

  <hr size="3px" />

  <main>
    <div class="slider">
      <div class="pop">
        <h1>MOST POPULAR</h1>
      </div>
      <div class="images">
        <div class="image">
          <img src="./images/arizona.png" alt="arizona" />
        </div>
        <div class="image">
          <img src="./images/beast.png" alt="doritos" />
        </div>
        <div class="image">
          <img src="./images/chup.png" alt="feastables " />
        </div>
        <div class="image">
          <img src="./images/doritos.png" alt="feastables " />
        </div>
      </div>
      <button class="prev" onclick="showPrevSlide()"></button>
      <button class="next" onclick="showNextSlide()"></button>
    </div>
    <div class="categories">
      <a href="index.php">
        <p>All Products</p>
      </a>
      <? foreach ($categories as $itemCategory): ?>
        <a href="index.php?category=<?= $itemCategory[1] ?>">
          <p>
            <?= $itemCategory[1] ?>
          </p>
        </a>
      <? endforeach; ?>
    </div>

    <div class="products">
      <? foreach ($filteredProducts as $product): ?>
        <div class="product">
          <h2>
            <?= $product[1] ?>
          </h2>
          <?php
          $imageData = base64_encode($product[8]); // замените 'blob_column' на имя вашего столбца с данными blob
          // Генерация тега <img> с данными изображения
          echo '<img src="data:image/jpeg;base64,' . $imageData . '" />';
          ?>
          <p><?= $product[5] ?>.99$</p>
          <button>Buy</button>
        </div>
      <? endforeach; ?>
    </div>
  </main>

  <footer>
    <h1>HH</h1>
  </footer>

  <script>
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
      });
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
  </script>
</body>

</html>
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
  $categoriesQuery = mysqli_query($conn, "SELECT * FROM categories");
  $categories = mysqli_fetch_all($categoriesQuery);

  $selectedCategory = isset($_GET["category"]) ? $_GET["category"] : null;
  $searchValue = isset($_GET["search"]) ? $_GET["search"] : null;

  if ($selectedCategory) {
    $filter = mysqli_query(
      $conn,
      "SELECT * FROM products INNER JOIN categories ON categories.idCategory = products.idCategory
        WHERE categories.nameCategory = '$selectedCategory' AND products.title LIKE '%$searchValue%'
        ORDER BY products.idProduct"
    );
  } else {
    $filter = mysqli_query(
      $conn,
      "SELECT * FROM products WHERE title LIKE '%$searchValue%'"
    );
  }

  $filteredProducts = mysqli_fetch_all($filter);
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
        <a href="brands.html">

        
          <h2>Brands</h2>
        </a>
      </div>
    </div>
    <div class="icons">
      <div class="find-field">
        <input type="text" class="find" placeholder="Find..." />
        <i class="fa fa-search fa-3x" aria-hidden="true" onclick="findProducts(`<?= $selectedCategory ?>`)"
          style="cursor: pointer"></i>
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
    <h1 style="text-align: center; margin-top: 10px;">Our catalog</h1>

    <div class="products-filters">
      <div class="categories">
        <select name="category" id="category">
          <option value="products">All products</option>
          <? foreach ($categories as $itemCategory): ?>
            <option value="<?= $itemCategory[1] ?>">
              <?= $itemCategory[1] ?>
            </option>
          <? endforeach; ?>
        </select>
        <button class="btn" onclick="selectCategory()">Show</button>
      </div>
      <div class="products">
        <? if (count($filteredProducts) == 0): ?>
          <h1>No results</h1>
        <? else: ?>
          <? foreach ($filteredProducts as $product): ?>
            <div class="product">
              <h2>
                <?= $product[1] ?>
              </h2>
              <?php
              $imageData = base64_encode($product[8]);
              echo '<img src="data:image/jpeg;base64,' . $imageData . '"style="width: 400px; height=400px" />';
              ?>
              <div>
                <p>
                  <?= $product[5] ?>.99$ /
                  <?= $product[7] ?> pieces
                </p>
                <button class="btn">Add to cart</button>

              </div>
            </div>
          <? endforeach; ?>
        <? endif; ?>
      </div>

    </div>
  </main>

  <footer id="footer">
    <h1>HH</h1>
  </footer>

  <script src="./js/main.js"></script>
</body>

</html>
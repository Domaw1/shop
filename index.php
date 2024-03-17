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

  $selectedCategory = isset ($_GET["category"]) ? $_GET["category"] : null;
  $searchValue = isset ($_GET["search"]) ? $_GET["search"] : null;

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
    <div class="user-links">
      <div class="info-links">
        <div class="link">
          <a href="profile.html">
            Магазины
          </a>
        </div>
        <div class="link">
          <a href="brands.html">
            Доставка и оплата
          </a>
        </div>
      </div>
      <div class="jewerly-link">
        <h1>JEWERLY</h1>
      </div>
      <div class="icons">
        <a href="#">
          <i class="fa fa-heart fa-2x" aria-hidden="true"></i>
        </a>
        <a href="./cart.html">
          <i class="fa fa-shopping-cart fa-2x" aria-hidden="true" style="cursor: pointer"></i>
        </a>
        <a href="./profile.html">
          <i class="fa fa-user fa-2x" aria-hidden="true"></i>
        </a>
      </div>
    </div>
    <nav>
      <div class="jewerly-link">
        <h2>Catalog</h2>
      </div>
      <div class="search">
        <input type="text" placeholder="Find..." class="search-input"/>
      </div>
    </nav>
  </header>

  <hr size="3px" />

  <main>
    <div class="jewerly-link">
      <h1 >Our catalog</h1>
    </div>

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
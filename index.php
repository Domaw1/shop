<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="./styles/main.css" />
  <title>Main</title>
  <script src="https://kit.fontawesome.com/34d37fffb3.js"></script>

</head>

<body>
  <?php require "connection.php";
  function translit($value)
  {
    $converter = array(
      'а' => 'a',
      'б' => 'b',
      'в' => 'v',
      'г' => 'g',
      'д' => 'd',
      'е' => 'e',
      'ё' => 'e',
      'ж' => 'zh',
      'з' => 'z',
      'и' => 'i',
      'й' => 'y',
      'к' => 'k',
      'л' => 'l',
      'м' => 'm',
      'н' => 'n',
      'о' => 'o',
      'п' => 'p',
      'р' => 'r',
      'с' => 's',
      'т' => 't',
      'у' => 'u',
      'ф' => 'f',
      'х' => 'h',
      'ц' => 'c',
      'ч' => 'ch',
      'ш' => 'sh',
      'щ' => 'sch',
      'ь' => '',
      'ы' => 'y',
      'ъ' => '',
      'э' => 'e',
      'ю' => 'yu',
      'я' => 'ya',

      'А' => 'A',
      'Б' => 'B',
      'В' => 'V',
      'Г' => 'G',
      'Д' => 'D',
      'Е' => 'E',
      'Ё' => 'E',
      'Ж' => 'Zh',
      'З' => 'Z',
      'И' => 'I',
      'Й' => 'Y',
      'К' => 'K',
      'Л' => 'L',
      'М' => 'M',
      'Н' => 'N',
      'О' => 'O',
      'П' => 'P',
      'Р' => 'R',
      'С' => 'S',
      'Т' => 'T',
      'У' => 'U',
      'Ф' => 'F',
      'Х' => 'H',
      'Ц' => 'C',
      'Ч' => 'Ch',
      'Ш' => 'Sh',
      'Щ' => 'Sch',
      'Ь' => '',
      'Ы' => 'Y',
      'Ъ' => '',
      'Э' => 'E',
      'Ю' => 'Yu',
      'Я' => 'Ya',
    );

    $value = strtr($value, $converter);
    return $value;
  }

  $categories_query = mysqli_query($conn, "SELECT * FROM categories");
  $categories = mysqli_fetch_all($categories_query);

  $products_query = mysqli_query($conn, "SELECT * FROM products");
  $filtered_products = mysqli_fetch_all($products_query);

  $url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  $url_query = parse_url($url, PHP_URL_QUERY);

  if ($url_query != null) {
    $currentCategory = substr($url_query, 9);
  }
  ?>

  <header>
    <div class="user-links">
      <div class="info-links">
        <div class="link">
          <a href="profile.html">
            О нас
          </a>
        </div>
        <div class="link">
          <a href="brands.html">
            Доставка и оплата
          </a>
        </div>
      </div>
      <div class="jewerly-link">
        <h1>JEWELRY</h1>
      </div>
      <div class="icons">
        <a href="#">
          <i class="fa-solid fa-heart fa-2x" aria-hidden="true"></i>
        </a>
        <a href="./cart.html">
          <i class="fa-solid fa-shopping-cart fa-2x" aria-hidden="true" style="cursor: pointer"></i>
        </a>
        <a href="./profile.html">
          <i class="fa-solid fa-user fa-2x" aria-hidden="true"></i>
        </a>
      </div>
    </div>
    <nav>
      <div class="jewelry-link">
        <h2>Каталог</h2>
      </div>
      <div class="search">
        <i class="fa-solid fa-magnifying-glass fa-lg"></i>
        <label>
          <input type="text" placeholder="Поиск..." class="search-input" />
        </label>
        <i class="fa-solid fa-xmark fa-xl" id="xmark" onclick="clearSearchInput()"></i>
      </div>
    </nav>
  </header>

  <hr size="3px" />

  <main>
    <div class="jewelry-link">
      <h1>Наш каталог</h1>
    </div>

    <div class="products-filters">
      <div class="categories">
        <select name="category" id="category">
          <option value="products">Все товары</option>
          <?php foreach ($categories as $itemCategory): ?>
            <option value="<?= translit($itemCategory[1]) ?>">
              <?= $itemCategory[1] ?>
            </option>
          <?php endforeach; ?>
        </select>
        <button class="btn" onclick="selectCategory()" style="align-self: flex-start">Показать</button>
      </div>
      <div class="products">
        <?php if ($filtered_products == null): ?>
          <h1>No results</h1>
        <?php else: ?>
          <?php foreach ($filtered_products as $product): ?>
            <div class="product">
              <?php
              $query_string = "SELECT * FROM photos INNER JOIN products ON photos.product_id = products.id 
                               WHERE photos.product_id = $product[0] ORDER BY photos.id";
              $select_photos_query = mysqli_query($conn, $query_string);
              $photos = mysqli_fetch_all($select_photos_query);
              $imageData = base64_encode($photos[0][2]);

              echo '<img src="data:image/jpeg;base64,' . $imageData . '"style="width: 200px; height=200px; align-self:center;" />';
              ?>
              <div>
                <p style="font-size: 2rem">
                  <?= $product[8] ?> ₽
                </p>
                <p style="font-size: 1.3rem">
                  <?= $product[1] ?>
                </p>
                <p style="font-size: 1.3rem;">
                  <?= $product[6] ?> г
                </p>
              </div>

              <button class="btn">В корзину</button>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>

    </div>
  </main>

  <footer id="footer">
    <h1>HH</h1>
  </footer>

  <script src="./js/main.js"></script>
</body>

</html>
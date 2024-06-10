<?php require "connection.php";
$currentUser = $_SESSION["user_email"] ?? null;

$categoryParam = $_GET["category"] ?? null;
$searchParam = $_GET["search"] ?? null;
$materialParam = $_GET["materials"] ?? null;

$currentCategory = $categoryParam ?? "";

if ($materialParam != null) {
    $materialFilter = explode('-', $materialParam);
    $asd = implode("','", $materialFilter);
    $material_filter = mysqli_query($conn, "SELECT * FROM products INNER JOIN materials ON products.material_id = materials.id 
        INNER JOIN categories ON products.category_id = categories.id WHERE materials.title IN ('$asd') AND categories.title LIKE '%$categoryParam%'");
    $material_result = mysqli_fetch_all($material_filter);
}

$categories_query = mysqli_query($conn, "SELECT * FROM categories");
$categories = mysqli_fetch_all($categories_query);

$materials_query = mysqli_query($conn, "SELECT * FROM materials");
$materials = mysqli_fetch_all($materials_query);

$param = "%{$searchParam}%";

$products_query = $conn->prepare("SELECT * FROM products WHERE title LIKE ?");
$products_query->bind_param("s", $param);
$products_query->execute();
$products_query = $products_query->get_result();

$filtered_products = mysqli_fetch_all($products_query);

$query_string = "SELECT * FROM products INNER JOIN categories ON products.category_id = categories.id 
        WHERE categories.title = ? AND products.title LIKE ?";
$filter_query = $conn->prepare($query_string);

$filter_query->bind_param("ss", $currentCategory, $param);
$filter_query->execute();
$filter_query = $filter_query->get_result();
$result = mysqli_fetch_all($filter_query);

if ($result)
    $filtered_products = $result;
if ($materialParam)
    $filtered_products = $material_result;
?>

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
    <header>
        <?php require "navbar.php" ?>
        <nav>
            <div class="jewelry-link">
                <h2>Каталог</h2>
            </div>
            <div class="search">
                <i class="fa-solid fa-magnifying-glass fa-lg"></i>
                <input type="text" placeholder="Поиск..." class="search-input">
                <i class="fa-solid fa-xmark fa-xl" id="xmark" onclick="clearSearchInput()"></i>
            </div>
        </nav>
    </header>
    <main>
        <div class="jewelry-link">
            <h1 style="margin: 10px 0 10px 0">Наш каталог</h1>
        </div>

        <div class="products-filters">
            <div class="categories">
                <div style="margin-left: 20px; width: 300px;">
                    <div class="select-category">
                        <p>Категории</p>
                        <i class="fa-solid fa-sort-up" id="sort-up-c"></i>
                        <i class="fa-solid fa-sort-down" id="sort-down-c"></i>
                    </div>
                    <div class="available-categories">
                        <div style="margin-left: 25px; margin-bottom: 15px;">
                            <p class="categories-item" id="products">Все</p>
                            <?php foreach ($categories as $itemCategory): ?>
                                <p class="categories-item" id="<?= $itemCategory[1] ?>"><?= $itemCategory[1] ?></p>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div style="margin-left: 20px; width: 300px;">
                    <div class="select-material">
                        <p>Материалы</p>
                        <i class="fa-solid fa-sort-up" id="sort-up-m"></i>
                        <i class="fa-solid fa-sort-down" id="sort-down-m"></i>
                    </div>
                    <div class="available-materials">
                        <div style="margin-left: 25px;">
                            <?php foreach ($materials as $material): ?>
                                <div class="checkbox">
                                    <input type="checkbox" class="material-check" id="<?= $material[1] ?>"
                                        value="<?= $material[1] ?>">
                                    <label for="<?= $material[1] ?>" class="material-item"><?= $material[1] ?></label>
                                </div>
                            <?php endforeach; ?>
                            <button class="btn-to-cart" id="but">Показать</button>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <!-- <div class="select-filter">
                    <div class="select">
                        <p>По популярности</p>
                        <i class="fa-solid fa-sort-up" id="sort-up-f"></i>
                        <i class="fa-solid fa-sort-down" id="sort-down-f"></i>
                    </div>
                    <div class="sort-filters">
                        <p class="sort" id="fame">По популярности</p>
                        <p class="sort" id="cost-up">По возрастанию цены</p>
                        <p class="sort" id="cost-down">По убыванию цены</p>
                    </div>
                </div> -->

                <div class="products">
                    <?php if ($filtered_products == null): ?>
                        <h1>No results</h1>
                    <?php else: ?>
                        <?php foreach ($filtered_products as $product): ?>
                            <div class="product">
                                <?php
                                $query_string = "SELECT * FROM photos INNER JOIN products ON photos.product_id = products.id 
                                   WHERE photos.product_id = ? ORDER BY photos.id";

                                $image_query = $conn->prepare($query_string);
                                $image_query->bind_param("i", $product[0]);
                                $image_query->execute();
                                $image_query = $image_query->get_result();
                                $result_image = mysqli_fetch_all($image_query);

                                $imageData = base64_encode($result_image[0][2]);

                                echo '<img src="data:image/jpeg;base64,' . $imageData . '"style="width: 200px; height=200px; align-self:center;" />';
                                ?>
                                <div>
                                    <p style="font-size: 2rem" class="product-info">
                                        <?= $product[8] ?> ₽
                                    </p>
                                    <p class="product-info">
                                        <?= $product[1] ?>
                                    </p>
                                    <p class="product-info">
                                        Примерный вес: <?= $product[6] ?>г
                                    </p>
                                </div>
                                <button class="btn-to-cart"><a href="add-to-cart.php?item=<?= $product[0] ?>"
                                        style="color: white">В корзину</a></button>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </main>

    <footer id="footer">
    </footer>

    <script src="./js/main.js"></script>
</body>

</html>
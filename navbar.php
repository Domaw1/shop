    <div class="user-links">
        <div class="info-links">
            <div class="link">
                <a href="profile.php">
                    О нас
                </a>
            </div>
        </div>
        <div class="jewelry-link">
            <h1><a href="index.php" style="color: black;">Ювелирка</a></h1>
        </div>
        <div class="icons">
            <a href="cart.php">
                <i class="fa-solid fa-shopping-cart fa-2x" aria-hidden="true" style="cursor: pointer"></i>
            </a>
            <?php if ($currentUser): ?>
                <a href="profile.php">
                    <i class="fa-solid fa-user fa-2x" aria-hidden="true"></i>
                </a>
            <?php else: ?>
                <a href="./auth.php">
                    <i class="fa-solid fa-user fa-2x" aria-hidden="true"></i>
                </a>
            <?php endif ?>
        </div>
    </div>
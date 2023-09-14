<header class="header">
    <a href="./index.php" class="header__logo"><span>КАБИНЕТ</span></a>
    <nav>
        <ul class="header__links">
            <li><a href="./index.php" class="header__link <?= 'main' === $currentPage ? 'header__link-active' : '' ?>">Главная</a></li>
            <li><a href="./profile.php" class="header__link <?= 'profile' === $currentPage ? 'header__link-active' : '' ?>">Профиль</a></li>
            <li><a href="./login.php" class="header__link <?= 'login' === $currentPage ? 'header__link-active' : '' ?>"><img class="header__login" src="./images/log-in.png" alt="Login"></a></li>
        </ul>
    </nav>
</header>
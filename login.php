<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./pages/index.css">
</head>
<body class="body">
<?php
session_start();

//В случае активной авторизации переход на страницу logout
if (isset($_SESSION['user_id'])) {
    header('Location: logout.php');
    exit();
}

require_once(__DIR__ . '/Dbase.php');

$currentPage = 'login';
$loginError = false;
$passError = false;

$userObj = [];
$userObj['login'] = $_POST['login'] ?? '';
$userObj['password'] = $_POST['password'] ?? '';
if ($userObj['login'] !== '' && $userObj['password'] !== '') {
    //Запрос в БД пользователя $userObj['login']
    $userTest = Dbase::checkUserEmail($userObj['login']);
    if (!$userTest) {
        //Если такого пользователя в БД не существует
        $loginError = true;
    } else if ($userTest['pass_hash'] !== $userObj['password']) {
        //Если пароль не правильный
        $passError = true;
    } else if ($userTest['pass_hash'] === $userObj['password']) {
        $_SESSION['user_id'] = $userObj['login'];
        header('Location: ./profile.php');
        exit();
    }
}
//var_dump($userTest);

require_once(__DIR__ . '/header.php');
?>
<main>
    <section class="form-main">
        <h1>Войти в систему</h1>
        <form method="post" class="form-login">
            <input class="form-login__input form-login__login" type="text" name="login"
                   placeholder="login" required="required">
            <span class="form-login__login-error <?= $loginError ? 'form-login__error-active' : '' ?>">Пользователь не зарегестрирован</span>
            <input class="form-login__input form-login__pass" type="text" name="password"
                   placeholder="password" required="required">
            <span class="form-login__pass-error <?= $passError ? 'form-login__error-active' : '' ?>">Введите правильный пароль</span>
            <button class="form-login__button" type="submit">Войти</button>
        </form>
        <a href="./register.php" class="form-main__register">или Зарегистрироваться</a>
    </section>

</main>
<footer></footer>
</body>
</html>
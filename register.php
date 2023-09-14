<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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

$currentPage = 'register';
$phoneError = false;
$emailError = false;
$passError = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $userObj = [];
    $userObj['name'] = $_POST['name'] ?? '';
    $userObj['phone'] = $_POST['phone'] ?? '';
    $userObj['email'] = $_POST['email'] ?? '';
    $userObj['password'] = $_POST['password'] ?? '';
    $userObj['password2'] = $_POST['password2'] ?? '';

    if ($userObj['password'] !== $userObj['password2']) {
        $passError = true;
    }

    $userTest = Dbase::checkUserPhone($userObj['phone']);
    if ($userTest) {
        //Если такой телефон уже существует
        $phoneError = true;
    }

    $userTest = Dbase::checkUserEmail($userObj['email']);
    if ($userTest) {
        //Если такой email уже существует
        $emailError = true;
    }

//        } else if ($userTest['pass_hash'] === $userObj['password']) {
//            $_SESSION['user_id'] = $userObj['login'];
//            header('Location: ./profile.php');
//            exit();
//        }

}
//var_dump($userTest);

require_once(__DIR__ . '/header.php');
?>
<main>
    <section class="form-main">
        <h1>Введите свои данные</h1>
        <form method="post" class="form-register">
            <input class="form-register__input form-register__name" type="text" name="name"
                   placeholder="Введите ФИО" required="required">
            <input class="form-register__input form-register__phone" type="text" name="phone"
                   placeholder="Введите телефон" required="required">
            <span class="form-register__phone-error <?= $phoneError ? 'form-login__error-active' : '' ?>">Такой телефон уже зарегестрирован</span>

            <input class="form-register__input form-register__email" type="text" name="email"
                   placeholder="Введите email" required="required">
            <span class="form-register__email-error <?= $emailError ? 'form-login__error-active' : '' ?>">Такой email уже зарегестрирован</span>

            <input class="form-register__input form-login__pass" type="text" name="password"
                   placeholder="Введите password" required="required">
            <input class="form-register__input form-login__pass2" type="text" name="password2"
                   placeholder="Введите password" required="required">
            <span class="form-register__pass2-error <?= $passError ? 'form-login__error-active' : '' ?>">Введите одинаковый пароль</span>

            <button class="form-register__button" type="submit">Зарегистрироваться</button>
        </form>
        <a href="./login.php" class="form-main__register">или Войти</a>
    </section>

</main>
<footer></footer>
</body>
</html>
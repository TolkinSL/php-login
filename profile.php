<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="./pages/index.css">
</head>
<body class="body">
<?php
session_start();
//var_dump($_SESSION['user_id']);
$currentPage = 'profile';
require_once(__DIR__ . '/header.php');
require_once(__DIR__ . '/Dbase.php');

//В случае отсутствия авторизации переход на страницу login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$phoneError = false;
$emailError = false;
$passError = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $userObj = [];
    $userObj['id'] = $_SESSION['user_id'] ?? '';
    $userObj['name'] = $_POST['name'] ?? '';
    $userObj['phone'] = $_POST['phone'] ?? '';
    $userObj['email'] = $_POST['email'] ?? '';
    $userObj['pass_hash'] = $_POST['password'] ?? '';
    $userObj['pass_hash2'] = $_POST['password2'] ?? '';

    if ($userObj['pass_hash'] !== $userObj['pass_hash2']) {
        $passError = true;
    }

    if (!$passError) {
        Dbase::updateUser($userObj);
    }

}

$userTest = Dbase::checkUserId($_SESSION['user_id']);
//var_dump($userTest);

?>
<main>
    <section class="form-main">
        <h1>Ваши личные данные</h1>
        <form method="post" class="form-register">
            <input class="form-register__input form-register__name" type="text" name="name"
                   placeholder="Введите ФИО" required="required"
                   value="<?= $userTest['name'] ?>">
            <input class="form-register__input form-register__phone" type="text" name="phone"
                   placeholder="Введите телефон" required="required"
                   value="<?= $userTest['phone'] ?>">
            <span class="form-register__phone-error <?= $phoneError ? 'form-login__error-active' : '' ?>">Такой телефон уже зарегестрирован</span>

            <input class="form-register__input form-register__email" type="text" name="email"
                   placeholder="Введите email" required="required"
                   value="<?= $userTest['email'] ?>">
            <span class="form-register__email-error <?= $emailError ? 'form-login__error-active' : '' ?>">Такой email уже зарегестрирован</span>

            <input class="form-register__input form-login__pass" type="text" name="password"
                   placeholder="Введите password" required="required">
            <input class="form-register__input form-login__pass2" type="text" name="password2"
                   placeholder="Введите password" required="required">
            <span class="form-register__pass2-error <?= $passError ? 'form-login__error-active' : '' ?>">Введите одинаковый пароль</span>

            <button class="form-register__button" type="submit">Сменить данные</button>
        </form>
    </section>

</main>
<footer></footer>
</body>
</html>
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
require_once(__DIR__ . '/Dbase.php');
require_once(__DIR__ . '/header.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_unset();
    session_destroy();
    header('Location: index.php');
    exit();
}

?>
<main>
    <section class="form-main">
        <h1>Выйти из системы</h1>
        <form method="post" class="form-login">
            <button class="form-login__button" type="submit">Выйти</button>
        </form>
    </section>

</main>
<footer></footer>
</body>
</html>
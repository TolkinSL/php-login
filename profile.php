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

//В случае отсутствия авторизации переход на страницу login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>
<main>
    <h1>Профиль пользователя</h1>
</main>
<footer></footer>
</body>
</html>
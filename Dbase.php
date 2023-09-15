<?php

class Dbase
{
    public static function checkUserEmail($email)
    {
        $dbc = new PDO('mysql:host=localhost;dbname=php-login;charset=utf8', 'root', '');
        $stSql = "SELECT id, name, email, phone, pass_hash FROM contact WHERE email = :email OR phone = :email";
        $res = $dbc->prepare($stSql);
        $res->bindValue(':email', $email, PDO::PARAM_STR);
        $res->execute();
        $rowUser = $res->fetch();
        return $rowUser;
    }

    public static function checkUserPhone($phone)
    {
        $dbc = new PDO('mysql:host=localhost;dbname=php-login;charset=utf8', 'root', '');
        $stSql = "SELECT email, phone, pass_hash FROM contact WHERE phone = :phone";
        $res = $dbc->prepare($stSql);
        $res->bindValue(':phone', $phone, PDO::PARAM_STR);
        $res->execute();
        $rowUser = $res->fetch();
        return $rowUser;
    }

    public static function checkUserId($id)
    {
        $dbc = new PDO('mysql:host=localhost;dbname=php-login;charset=utf8', 'root', '');
        $stSql = "SELECT id, name, email, phone, pass_hash FROM contact WHERE id = :id";
        $res = $dbc->prepare($stSql);
        $res->bindValue(':id', $id, PDO::PARAM_STR);
        $res->execute();
        $rowUser = $res->fetch();
        return $rowUser;
    }

    public static function registerUser($userObj)
    {
        $dbc = new PDO('mysql:host=localhost;dbname=php-login;charset=utf8', 'root', '');
        $stSql = "INSERT INTO contact (name, phone, email, pass_hash) VALUES (:name, :phone, :email, :pass_hash)";
        $res = $dbc->prepare($stSql);
        $res->bindValue(':name', $userObj['name'], PDO::PARAM_STR);
        $res->bindValue(':phone', $userObj['phone'], PDO::PARAM_STR);
        $res->bindValue(':email', $userObj['email'], PDO::PARAM_STR);
        $res->bindValue(':pass_hash', $userObj['pass_hash'], PDO::PARAM_STR);
        $res->execute();
    }

    public static function updateUser($userObj)
    {
        $dbc = new PDO('mysql:host=localhost;dbname=php-login;charset=utf8', 'root', '');
        $stSql = "UPDATE contact SET name = :name, phone = :phone, email = :email, pass_hash = :pass_hash WHERE id = :id";
        $res = $dbc->prepare($stSql);
        $res->bindValue(':id', $userObj['id'], PDO::PARAM_INT);
        $res->bindValue(':name', $userObj['name'], PDO::PARAM_STR);
        $res->bindValue(':phone', $userObj['phone'], PDO::PARAM_STR);
        $res->bindValue(':email', $userObj['email'], PDO::PARAM_STR);
        $res->bindValue(':pass_hash', $userObj['pass_hash'], PDO::PARAM_STR);
        $res->execute();
    }
}
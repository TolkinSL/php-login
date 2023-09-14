<?php

class Dbase
{
    public static function checkUserEmail($email)
    {
        $dbc = new PDO('mysql:host=localhost;dbname=php-login;charset=utf8', 'root', '');
        $stSql = "SELECT email, phone, pass_hash FROM contact WHERE email = :email";
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
}
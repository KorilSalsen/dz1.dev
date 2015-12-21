<?php
session_start(session_name('admin'));

$email = htmlentities(strip_tags(trim($_POST['login-email'])), ENT_QUOTES);
$password = md5($_POST['login-pass']);

if (empty($email) || empty($password)) {
    $_SESSION['message'] = "Заполните все поля";
    header('Content-Type: application/json');
    echo json_encode($_SESSION);
    exit;
} else {
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "dz.dev";

    mysql_connect($host, $user, $pass) or die(mysql_error());
    mysql_select_db($db) or die(mysql_error());

    $sql = "SELECT `ID` FROM `users` WHERE `email`='$email' AND `pass`='$password'";
    $result = mysql_query($sql) or die(mysql_error());
    $result_array = mysql_fetch_assoc($result);

    if ($result_array['ID']) {
        $_SESSION['message'] = "Вы успешно залогинены";
        $_SESSION['auth'] = true;
        header("HTTP/1.1 302 Moved Temporarily");
        header("Location: ../index.html");
        exit;
    } else {
        $_SESSION['message'] = "Неправильные данные";
        unset($_SESSION['auth']);
        header('Content-Type: application/json');
        echo json_encode($_SESSION);
        exit;
    }
}
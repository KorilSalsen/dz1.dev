<?php
session_start(session_name('admin'));

$email = htmlentities(strip_tags(trim($_POST['login-email'])), ENT_QUOTES);
$password = md5($_POST['login-pass']);

if (empty($email) || empty($password)) {
    $_SESSION['status'] = "error";
    $_SESSION['title'] = "Ошибка!";
    $_SESSION['message'] = "Заполните все поля.";
} else {
    require_once "db-connect.php";

    $sql = "SELECT `ID` FROM `users` WHERE `email`='$email' AND `pass`='$password'";
    $result = mysql_query($sql) or die(mysql_error());
    $result_array = mysql_fetch_assoc($result);

    if ($result_array['ID']) {
        $uri = dirname(dirname($_SERVER['PHP_SELF']));
        $_SESSION['status'] = "ok";
        $_SESSION['title'] = "Ура!";
        $_SESSION['message'] = "Вы успешно вошли";
        $_SESSION['auth'] = true;
        $_SESSION['location'] = $uri.'/index.php';
    } else {
        $_SESSION['status'] = "error";
        $_SESSION['title'] = "Ошибка!";
        $_SESSION['message'] = "Неправильные данные.";
        unset($_SESSION['auth']);
        unset($_SESSION['location']);
    }
}

header('Content-Type: application/json');
echo json_encode($_SESSION);
exit;
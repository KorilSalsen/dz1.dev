<?php

//Вывод кнопки добаления проекта
function print_login_button()
{
    $enter = "<a href='login.php' class='enter'>вход</a>";
    $exit = "<a href='php/logout.php' class='exit'>выход</a>";

    if ($_SESSION['auth']) {
        echo $exit;
    } else {
        echo $enter;
    }
}

//Вывод оектов
function print_projects()
{
    require_once "db-connect.php";

    $sql = "SELECT * FROM `projects`";
    $result = mysql_query($sql) or die(mysql_error());

    while ($row = mysql_fetch_assoc($result)) {
        $name = $row['name'];
        $img_src = $row['img_src'];
        $url = $row['url'];
        $description = $row['description'];

        $project = "
                    <li class='work'>
                        <div class='work__img-wrapper'>
                            <div class='link-wrapper'>
                                <a href='//$url' class='img-link' title='$url' target='_blank'>Подробнее</a>
                            </div>
                            <img class='work__img' src='$img_src' alt='$url'>
                        </div>
                        <a href='//$url' class='work__link' title='$url' target='_blank'>$name</a>
                        <p class='work__description'>
                            $description
                        </p>
                    </li>";

        echo $project;
    }

    $add_project_button = "
    <!--Добавление работы-->
    <li class='work work_add'>
        <a href='' class='work__add-link work__add-link_ico popup-button' data-popup-name='new-project' title='Добавить проект'>
            <p class='work__add-text'>Добавить проект</p>
        </a>
    </li>";

    if ($_SESSION["auth"]) {
        echo $add_project_button;
    }

}

//Очистка введеного текста
function clear_data_str($data){
    return htmlentities(strip_tags(trim($data)));
}

//Проверка капчи
function check_captcha($key, $captcha)
{
    $url_to_send = "https://www.google.com/recaptcha/api/siteverify?secret=" . $key . '&response=' . $captcha;
    $data_request = file_get_contents($url_to_send);
    $data = json_decode($data_request, true);

    if (isset($data['success']) && $data['success'] == 1) {
        return true;
    } else {
        return false;
    }
}

//Определение расширения файла
function getExtension($filename, $point) {
    return substr(strrchr($filename, $point), 1);
}

//Определение типа файла
function getTypeOfFile($filename) {
    return substr($filename, 0, strrpos($filename, '/'));
}
<?php
ini_set(('display_errors'),0);
require_once "functions.php";
//Сообщение сервера
$data = array(
    'status' => 'ok',
    'title' => 'Ура!',
    'message' => 'Проект добавлен.'
);

//Получаем данные
if($_SERVER['REQUEST_METHOD'] == "POST") {
    foreach ($inputData as $input) {
        if ((gettype($input) == 'array' && $input['error']) || !$input) {
            $data['status'] = 'error';
            $data['title'] = 'Ошибка!';
            $data['message'] = 'Заполните все поля.';

            header('Content-Type: application/json');
            echo json_encode($data);
            exit;
        }
    }
} else{
    $data['status'] = 'error';
    $data['title'] = 'Ошибка!';
    $data['message'] = 'Ошибка получения данных.';

    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

$name = $_POST['title'];
$img = $_FILES['work-pic'];
$url = $_POST['work-url'];
$description = $_POST['work-description'];

//Ограничения
$max_file_size = 5 * 1024 * 1024; //Максимальный размер файла в байтах
$max_resolution = 4000; //Максимальный размер файла в пикселях
$formats = array('jpeg', 'png', 'bmp'); //Разрешенные форматы изображений

//Получаем размер файлов в байтах
$mage_size = $img['size'];

//Проверки
//Проверка размера файла
$image_valid = $mage_size === 0 || $mage_size > $max_file_size;

if ($image_valid) {
    $data['status'] = 'error';
    $data['message'] = 'Иизображение не выбрано или превышает допустимый размер!';

    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
} else {
    //Получаем тип файла
    $image_type = getTypeOfFile($img['type']);
}

//Проверка типа
if ($image_type !== 'image') {
    $data['status'] = 'error';
    $data['message'] = 'Выберите изображение!';

    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
} else {
    //Получаем формат  файла
    $image_format = getExtension($img['type'], '/');
}

//Проверка формата
$image_valid = array_search($image_format, $formats);

if ($image_valid === false) {
    $data['status'] = 'error';
    $data['message'] = 'Неверный формат изображения!';

    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
} else {
    //Получаем размер изображений в пикселях
    $image_resolution = getimagesize($img['tmp_name']);
}

//Проверка размера фзображения
$image_valid = $image_resolution[0] > $max_resolution || $image_resolution[1] > $max_resolution;

if ($image_valid) {
    $data['status'] = 'error';
    $data['message'] = 'Слишком большое изображение!';

    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

if ($data['status'] == 'ok') {
    //Данные для подключения к ДБ
    require_once "db-connect.php";

    //Работа с файлом
    $img_name = $img['name'];
    $img_src = 'img/' . $img_name;
    $img_path = __DIR__ . '/../' . $img_src;

    move_uploaded_file($img['tmp_name'], $img_path);

    //Работа с БД
    $strSQL = "INSERT INTO projects(name,img_src,url,description) VALUES('$name','$img_src','$url', '$description')";

    mysql_query($strSQL) or die(mysql_error());

    //Элемент для вставки в документ
    $data['project'] = "<li class='work'>
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
}

header('Content-Type: application/json');
echo json_encode($data);
exit;
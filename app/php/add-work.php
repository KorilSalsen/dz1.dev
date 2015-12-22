<?php

$inputData = array(
    'work_name' => $_POST['work-title'],
    'work_pic' => $_FILES['work-pic'],
    'work_url' => $_POST['work-url'],
    'work_description' => $_POST['work-description']
);

$data = array(
    'status' => 'ok',
    'title' => 'Ура!',
    'message' => 'Проект добавлен.'
);

foreach ($inputData as $input) {
    if ((gettype($input) == 'array' && $input['error']) || !$input) {
        $data['status'] = 'error';
        $data['title'] = 'Ошибка!';
        $data['message'] = 'Заполните все поля.';
    }
}

if ($data['status'] == 'ok') {
    require_once "db-connect.php";

    $name = $inputData['work_name'];
    $img = $inputData['work_pic'];
    $url = $inputData['work_url'];
    $description = $inputData['work_description'];

    $img_name = $img['name'];
    $img_src = 'img/' . $img_name;
    $img_path = __DIR__ . '/../' . $img_src;

    move_uploaded_file($img['tmp_name'], $img_path);

    $strSQL = "INSERT INTO projects(name,img_src,url,description) VALUES('$name','$img_src','$url', '$description')";

    mysql_query($strSQL) or die(mysql_error());

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
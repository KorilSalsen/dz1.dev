<?php

$inputData = array(
    'workTitle' => $_POST['work-title'],
    'workPic' => $_FILES['work-pic'],
    'workUrl' => $_POST['work-url'],
    'workDescription' => $_POST['work-description']
);

$data = array(
    'status' => 'ok',
    'title' => 'Ура!',
    'message' => 'Проект добавлен.'
);

foreach ($inputData as $input) {
    if (gettype($input) == 'array') {
        if ($input['error']) {
            $data['status'] = 'error';
            $data['title'] = 'Ошибка!';
            $data['message'] = 'Невозможно добавить проект.';
        }
    } else {
        if (!$input) {
            $data['status'] = 'error';
            $data['title'] = 'Ошибка!';
            $data['message'] = 'Невозможно добавить проект.';
        }
    }
}

header('Content-Type: application/json');
echo json_encode($data);
exit;
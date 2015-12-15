<?php

$data = array();
$inputData = array();
$inputData['workTitle'] = $_POST['work-title'];
$inputData['workPic'] = $_FILES['work-pic'];
$inputData['workUrl'] = $_POST['work-url'];
$inputData['workDescription'] = $_POST['work-description'];

$data['status'] = 'OK';

foreach ($inputData as $input) {
    if (gettype($input) == 'array') {
        if ($input['error']) {
            $data['status'] = 'error';
        }
    } else {
        if (!$input) {
            $data['status'] = 'error';
        }
    }
}

header('Content-Type: application/json');
echo json_encode($data['status']);
exit;
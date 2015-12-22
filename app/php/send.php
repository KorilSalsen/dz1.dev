<?php

require_once "data.php";

$inputData = array(
    'feedback_name' => $_POST['feedback-name'],
    'feedback_email' => $_POST['feedback-email'],
    'feedback_message' => $_POST['feedback-message'],
    'feedback_captcha' => $_POST['g-recaptcha-response']
);

$data = array(
    'status' => 'ok',
    'title' => 'Ура!',
    'message' => 'Собощение отправлено.'
);

foreach ($inputData as $input) {
    if (!$input || !check_captcha($inputData['feedback_captcha'], $secret_key)) {
        $data['status'] = 'error';
        $data['title'] = 'Ошибка!';
        $data['message'] = 'Заполните все поля.';
    }
}

if ($data['status'] == 'ok') {
    $data['mail'] = "good";
}

header('Content-Type: application/json');
echo json_encode($data);
exit;

function check_captcha($key, $catpcha)
{
    $url_to_send = "https://www.google.com/recaptcha/api/siteverify?secret=" . $key . '&response=' . $catpcha;
    $data_request = file_get_contents($url_to_send);
    $data = json_decode($data_request, true);

    if (isset($data['success']) && $data['success'] == 1) {
        return true;
    } else {
        return false;
    }
}
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
    if (!$input) {
        $data['status'] = 'error';
        $data['title'] = 'Ошибка!';
        $data['message'] = 'Заполните все поля.';
    }
}

if (!check_captcha($secret_key, $inputData['feedback_captcha'])) {
    $data['status'] = 'error';
    $data['title'] = 'Ошибка!';
    $data['message'] = 'Подтвердите, что вы не робот.';
}

if ($data['status'] == 'ok') {
    require '../composer/vendor/phpmailer/phpmailer/PHPMailerAutoload.php';

    $mail = new PHPMailer;
    $mail->isSendmail();
    $mail->setFrom($inputData['feedback_email'], $inputData['feedback_name']);
    $mail->addAddress('ilyakorchenov@mail.ru', 'Ilya Korchenov');
    $mail->Subject = "Сообщение с сайта-портфолио от " . $inputData['feedback_name'];
    $mail->msgHTML("Тестовое письмо с вебинара от ".$inputData['feedback_name'].PHP_EOL.'<br /><br />'.$inputData['feedback_message']);


    if (!$mail->send()) {
        $data['status'] = 'error';
        $data['title'] = 'Ошибка!';
        $data['message'] = 'Возникла ошибкка при отправке. ' . $mail->ErrorInfo;
    }
}

header('Content-Type: application/json');
echo json_encode($data);
exit;

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
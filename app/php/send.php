<?php

require_once "data.php";
require_once "functions.php";

$inputData = array(
    'feedback_name' => clear_data_str($_POST['feedback-name']),
    'feedback_email' => clear_data_str($_POST['feedback-email']),
    'feedback_message' => clear_data_str($_POST['feedback-message']),
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
    $mail->CharSet = 'UTF-8';
    $mail->isSendmail();
    $mail->setFrom('feedback@korchenov.ru', 'korchenov.ru');
    $mail->addAddress('ilyakorchenov@mail.ru', 'Ilya Korchenov');
    $mail->Subject = $inputData['feedback_name'] . " написал(а) сообщение с сайта";
    $mail->msgHTML("<b>".$inputData['feedback_name'].' просит прислать ответ на адрес: '.$inputData['feedback_email'].'</b>'.PHP_EOL.'<br/><br />'.$inputData['feedback_message']);


    if (!$mail->send()) {
        $data['status'] = 'error';
        $data['title'] = 'Ошибка!';
        $data['message'] = 'Возникла ошибкка при отправке. ' . $mail->ErrorInfo;
    }
}

header('Content-Type: application/json');
echo json_encode($data);
exit;
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once "PHPMailer/PHPMailer.php";
require_once "PHPMailer/SMTP.php";
require_once "PHPMailer/Exception.php";

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$subject = $_POST['subject'] ?? '';
$body = $_POST['body'] ?? '';

if (isset($_POST['email'])) {
      $email = $_POST['email'];
  
      // Проверка на пустоту
      if (empty($email)) {
          // Обработка случая, когда адрес электронной почты пустой
          echo json_encode(array('status' => 'failed', 'response' => 'ERROR - Email address is empty'));
          exit(); // Прекращение выполнения скрипта
      }
  
      // Валидация адреса электронной почты
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          // Обработка случая, когда адрес электронной почты некорректен
          echo json_encode(array('status' => 'failed', 'response' => 'ERROR - Invalid email address'));
          exit(); // Прекращение выполнения скрипта
      }
  } else {
      // Обработка случая, когда ключ 'email' отсутствует в массиве $_POST
      echo json_encode(array('status' => 'failed', 'response' => 'ERROR - Email address not provided'));
      exit(); // Прекращение выполнения скрипта
  }




$mail = new PHPMailer(true);

try {
    // SMTP settings
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = 'komilovsg@gmail.com';
    $mail->Password = 'yegexhnsmwinymqu';
    $mail->SMTPSecure = "ssl";
    $mail->Port = 465;

    $mail->setFrom($email, $name);
    $mail->addAddress('komilovsg@gmail.com');
    $mail->isHTML(true);
    $mail->Subject = "$email ($subject)";
    $mail->Body = $body;

    $mail->send();

    $status = "success";
    $response = "Email is sent!";
} catch (Exception $e) {
    $status = "failed";
    $response = "ERROR - Something went wrong: <br>" . $mail->ErrorInfo;
}

echo json_encode(array("status" => $status, "response" => $response));
?>
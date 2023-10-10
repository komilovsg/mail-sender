<?php
use PHPMailer\PHPMailer\PHPMailer;

if(isset($_POST['name']) && isset($_POST['email'])){
      $name = $_POST['name'];
      $email = $_POST['email'];
      $subject = $_POST['subject'];
      $body = $_POST['body'];


      require_once "../phpmailer/src/PHPMailer.php";
      require_once "../phpmailer/src/SMTP.php";
      require_once "../phpmailer/src/Exception.php";

      $mail = new PHPMailer();

      //smtp settings
      $mail->isSMTP();
      $mail->Host = "smtp.gmail.com";
      $mail->SMTPAuth = true;
      $mail->Username = 'komilovsg@gmail.com';
      $mail->Password = 'yegexhnsmwinymqu';
      $mail->SMTPSecure = "ssl";
      $mail->Port = 465;

      $mail->isHTML(true); 
      $mail->setFrom($email, $name);
      $mail->addAddress('komilovsg@gmail.com'); // Add a recipient
      $mail->Subject = ("$email ($subject)");
      $mail->Body = $body;

      if($mail->send()){
            $status = "seccess";
            $response = "Email is sent!";
      }
      else {
            $status = "failed";
            $response = "ERROR - Something is wrong: <br>" .$mail->ErrorInfo;
      }

      exit(json_encode(array("status" => $status, "response" => $response)));
}
<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';
//require 'PHPMailer/PHPMailerAutoload.php';

class SendMail
{

    public $mail;

    /*public function __construct()
    {
		//$this->mail = new PHPMailer; 
		//$this->mail->isSMTP(); 
		// $this->mail->SMTPDebug = 2; 
		$this->mail->Debugoutput = 'html'; 
		$this->mail->Host = 'smtp.gmail.com'; 
		$this->mail->Port = 587; 
		$this->mail->SMTPSecure = 'tls'; 
		$this->mail->SMTPAuth = true; 
		$this->mail->Username = "ajay.genextwebs@gmail.com"; 
		$this->mail->Password = "ser_12345";
		$this->mail->CharSet = 'UTF-8';
        $this->mail->isHTML(true);
    }*/

    /*public function sendTo($toEmail, $recipientName, $subject, $msg)
    {
        $this->mail->setFrom($this->mail->Username,'Ajay');
        $this->mail->addAddress($toEmail, $recipientName);
        $this->mail->isHTML(true); 
        $this->mail->Subject = $subject;
        $this->mail->Body = $msg;
        if (!$this->mail->send()) {
            log_message('error', 'Mailer Error: ' . $this->mail->ErrorInfo);
            return false;
        }
        $this->mail->clearAllRecipients();
        return true;
    }*/

    public function sendTo($toEmail, $recipientName, $subject, $msg){
        $email = new \SendGrid\Mail\Mail();
       //print_r($email);die;
        $email->setFrom('project165.system@gmail.com', "PMS");
        $email->setSubject($subject);
        $email->addTo($toEmail,$recipientName);
        $email->addContent("text/html", $msg);
        $sendgrid = new \SendGrid('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');
        try {
            //echo "ghng";die;
           //print_r($email);die;
            $response = $sendgrid->send($email);
            //echo "<PRE>";print_r($response);exit();
            /*print $response->statusCode() . "\n";
            print_r($response->headers());
            print $response->body() . "\n";die;*/
        } catch (Exception $e) {
            echo 'Caught exception: '. $e->getMessage() ."\n";
        }
    }

}

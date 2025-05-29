<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

putenv("SMTP_USER=jsn1190@gmail.com");
putenv("SMTP_PASS=hvemerdu11");

echo getenv('SMTP_USER'); // Should print ".com"
echo getenv('SMTP_PASS'); // Should print ""

require "../../vendor/autoload.php";


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle the POST request
} else {
    die("Invalid request method.");
}

// use Dotenv\Dotenv;

// $dotenv = Dotenv::createImmutable(__DIR__);
// $dotenv->load();

// $mail->Username = getenv('SMTP_USER');
// $mail->Password = getenv('SMTP_PASS');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $name = htmlspecialchars($_POST['name']);
    $phone = htmlspecialchars($_POST['phone']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Validate email and phone
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Ugyldig e-mail-adresse.");
    }
    if (!preg_match('/^[0-9()#&+*-=.\s]*$/', $phone)) {
        die("Ugyldigt telefonnummer.");
    }

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {

            // Enable debugging
        $mail->SMTPDebug = 2; // Debug level
        $mail->Debugoutput = 'html';
        
        // Server settings
        $mail->SMTPOptions = 
        [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true,
            ],
        ];

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = getenv('SMTP_USER'); // Use environment variables
        $mail->Password = getenv('SMTP_PASS'); // Use environment variables
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom($email, $name);
        // $mail->addReplyTo($email, $name);
      $mail->addAddress(getenv('SMTP_USER'));


        // Content
        $mail->isHTML(false);
        $mail->Subject = 'Ny Form Submission';
        $mail->Body = "Navn: $name\nTelefon: $phone\nE-mail: $email\n\nMeddelelse:\n$message";

        // Send the email
        $mail->send();
        echo "Tak! Din besked er blevet sendt.";
    } catch (Exception $e) {
        error_log("Email error: {$mail->ErrorInfo}");
        echo "Beklager, der opstod en fejl. Prøv igen senere.";
    }
} else {
    echo "Ugyldig forespørgsel.";
}

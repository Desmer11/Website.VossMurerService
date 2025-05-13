<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $name = htmlspecialchars($_POST['name']);
    $phone = htmlspecialchars($_POST['phone']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();                                    // Send using SMTP
        $mail->Host = 'smtp.simply.com';                     // Simply.com SMTP server
        $mail->SMTPAuth = true;                              // Enable SMTP authentication
        $mail->Username = 'your-email@simply.com';           // Your Simply.com email address
        $mail->Password = 'your-email-password';             // Your Simply.com email password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  // Enable TLS encryption
        $mail->Port = 587;                                  // TCP port to connect to

        // Recipients
        $mail->setFrom($email, $name);
        $mail->addAddress('jonassnk11@gmail.com');           // Replace with your email

        // Content
        $mail->isHTML(false);                               // Set email format to plain text
        $mail->Subject = 'Ny Form Submission';
        $mail->Body    = "Navn: $name\nTelefon: $phone\nE-mail: $email\n\nMeddelelse:\n$message";

        // Send the email
        $mail->send();
        echo "Tak! Din besked er blevet sendt.";
    } catch (Exception $e) {
        echo "Beklager, der opstod en fejl: {$mail->ErrorInfo}";
    }
} else {
    echo "Ugyldig forespørgsel.";
}
?>

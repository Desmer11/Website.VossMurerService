<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

putenv("SMTP_USER=thorvoss7@hotmail.com");
putenv("SMTP_PASS=");

echo getenv('SMTP_USER'); // Should print "thorvoss7@hotmail.com"
echo getenv('SMTP_PASS'); // Should print ""

require 'vendor/autoload.php';

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
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.simply.com';
        $mail->SMTPAuth = true;
        $mail->Username = getenv('SMTP_USER'); // Use environment variables
        $mail->Password = getenv('SMTP_PASS'); // Use environment variables
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('thorvoss7@hotmail.com', 'Website Contact Form');
        $mail->addReplyTo($email, $name);
        $mail->addAddress('jonassnk11@gmail.com');

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

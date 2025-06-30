<?php
// Display all errors for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include PHPMailer and dotenv
require "../vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
use Dotenv\Dotenv;

// Load environment variables
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize form input
    $name = htmlspecialchars($_POST['name'] ?? '');
    $phone = htmlspecialchars($_POST['phone'] ?? '');
    $email = htmlspecialchars($_POST['email'] ?? '');
    $message = htmlspecialchars($_POST['message'] ?? '');

    // Validate email and required fields
    if (empty($name) || empty($email) || empty($message)) {
        echo "Fyld alle felter";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Email addresse ikke fundet.";
        exit;
    }

    // Create PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Enable SMTP debugging
        $mail->SMTPDebug = SMTP::DEBUG_OFF;

        // Set mailer to use SMTP
        $mail->isSMTP();
        $mail->Host = $_ENV['SMTP_HOST']; // Load from .env
        $mail->SMTPAuth = true;          // Enable SMTP authentication
        $mail->Username = $_ENV['SMTP_USER']; // Load from .env
        $mail->Password = $_ENV['SMTP_PASS']; // Load from .env
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS
        $mail->Port = $_ENV['SMTP_PORT'];   // Load from .env

        // Sender and recipient settings
        $mail->setFrom($email, $name);
        $mail->addAddress($_ENV['SMTP_USER'], "Jonas"); // Load recipient from .env

        // Email content
        $mail->isHTML(false); // Set email format to plain text
        $mail->Subject = "Ny Kontact Form Sent";
        $mail->Body = "Name: $name\nPhone: $phone\nEmail: $email\n\nMessage:\n$message";

        // Send the email
        $mail->send();
        echo "Email Sent!";
    } catch (Exception $e) {
        echo "Email kunne ikke sendes Fejl(ERROR): {$mail->ErrorInfo}";
    }
} else {
    echo "Fejl ved sende Metoden.";
}

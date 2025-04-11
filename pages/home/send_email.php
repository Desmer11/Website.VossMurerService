<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $name = htmlspecialchars($_POST['name']);
    $phone = htmlspecialchars($_POST['phone']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Email configuration
    $to = 'jonassnk11@gmail.com'; // Replace with your email
    $subject = 'Ny Form Submission';
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Email body
    $body = "Navn: $name\n";
    $body .= "Telefon: $phone\n";
    $body .= "E-mail: $email\n\n";
    $body .= "Meddelelse:\n$message\n";

    // Send email
    if (mail($to, $subject, $body, $headers)) {
        echo "Tak! Din besked er blevet sendt.";
    } else {
        echo "Beklager, der opstod en fejl. Prøv venligst igen senere.";
    }
} else {
    echo "Ugyldig forespørgsel.";
}
?>

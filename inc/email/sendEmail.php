<?php
require_once __DIR__ . '/MailService.php';
session_start();

$mailService = new MailService();

// Set target email, subject, and body
$target_mail = 'ayayoubelhilali@gmail.com';
$subject = 'Your ENSAH Service Account Has Been Created';
$body = 'Dear Professor $_SESSION["name"],

We are pleased to inform you that your account has been successfully created on the ENSAH Service platform.

🔐 Here are your login details:
- **Email**: [professor.email@example.com]
- **Temporary Password**: [temporary_password]

To access your account, please visit:
👉 https://ensah-service.com/login

⚠️ For security reasons, we strongly recommend that you log in and change your password immediately after your first connection.

If you have any questions or encounter any issues, feel free to contact the technical support team.

Best regards,  
Ayoub Hilali  
ENSAH Service Team';

// Validate email address
if (!filter_var($target_mail, FILTER_VALIDATE_EMAIL)) {
    die('❌ Invalid email address.');
}

// Send the email
$result = $mailService->sendEmail($target_mail, $subject, $body);

if ($result === true) {
    echo '✅ Email sent!';
} else {
    echo '❌ Error: ' . $result;
}

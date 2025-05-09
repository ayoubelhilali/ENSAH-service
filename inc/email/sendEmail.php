<?php
require_once __DIR__ . '/MailService.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class PrepareEmail
{
    private MailService $email_handler;

    public function __construct()
    {
        $this->email_handler = new MailService();
    }

    public function sendEmailtoUser(string $target_mail, string $target_password, string $target_name): bool
    {
        // Email content
        $login_url = "http://127.0.0.1/ENSAH-service/login.php";
        $subject = "Creation de votre compte sur la plateforme ENSAH Service";
        $body = "Bonjour Monsieur/Madame " . $target_name . ",\n\n" .
            "Votre compte a été créé avec succès sur la plateforme ENSAH Service.\n\n" .
            "🔐 Informations de connexion :\n" .
            "- Email : " . $target_mail . "\n" .
            "- Mot de passe temporaire : " . $target_password . "\n\n" .
            "Vous pouvez vous connecter ici :\n" .
            $login_url . "\n\n" .
            "⚠️ Pour des raisons de sécurité, nous vous recommandons de changer votre mot de passe dès votre première connexion.\n\n" .
            "En cas de problème ou de question, n'hésitez pas à nous contacter.\n\n" .
            "Cordialement, \n" .
            "Équipe ENSAH Service";

        // Call the send method of the MailService class
        return $this->email_handler->sendEmail($target_mail, $subject, $body);
    }
}

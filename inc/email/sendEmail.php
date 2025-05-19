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
        $body = "Bonjour Monsieur/Madame " . $target_name . "," .
            "Votre compte a ete cree avec succes sur la plateforme ENSAH Service." .
            " Informations de connexion :" .
            "- Email : " . $target_mail . "" .
            "- Password : " . $target_password . "" .
            " Pour des raisons de securite, nous vous recommandons de changer votre mot de passe dès votre premiere connexion." .
            "En cas de probleme ou de question, n'hesitez pas a nous contacter." .
            "Cordialement, " .
            "Equipe ENSAH Service";

        // Call the send method of the MailService class
        return $this->email_handler->sendEmail($target_mail, $subject, $body);
    }
}

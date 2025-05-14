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
        $body = "Bonjour Monsieur/Madame " . $target_name . ",<br><br>" .
            "Votre compte a été créé avec succès sur la plateforme ENSAH Service.<br><br>" .
            "🔐 Informations de connexion :<br>" .
            "- <strong>Email</strong> : " . $target_mail . "<br>" .
            "- <strong>Mot de passe temporaire</strong> : " . $target_password . "<br><br>" .
            "Vous pouvez vous connecter ici :<br>" .
            $login_url . "<br><br>" .
            "⚠️ Pour des raisons de sécurité, nous vous recommandons de changer votre mot de passe dès votre première connexion.<br><br>" .
            "En cas de problème ou de question, n'hésitez pas à nous contacter.<br><br>" .
            "Cordialement, <br>" .
            "Équipe ENSAH Service";
        ;

        // Call the send method of the MailService class
        return $this->email_handler->sendEmail($target_mail, $subject, $body);
    }
}

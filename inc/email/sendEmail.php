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

    public function sendEmailnewProf(string $target_mail, string $target_password, string $target_name): bool
    {
        // Email content
        $subject = "Creation de votre compte sur la plateforme ENSAH Service";
        $body = "Bonjour Monsieur/Madame " . $target_name . ",\n\n" .
            "Votre compte a ete cree avec succes sur la plateforme ENSAH Service.\n\n" .
            " Informations de connexion :\n" .
            " Email : " . $target_mail . "\n" .
            " Mot de passe : " . $target_password . "\n\n" .
            " Pour des raisons de securite, nous vous recommandons de changer votre mot de passe des votre premiere connexion.\n\n" .
            " En cas de probleme ou de question, n'hesitez pas a nous contacter.\n\n" .
            "Cordialement,\n" .
            "L'equipe ENSAH Service";
        // Call the send method of the MailService class
        return $this->email_handler->sendEmail($target_mail, $subject, $body);
    }
    public function changePassEmail(string $target_mail, string $target_password, string $target_name): bool
    {
        // Email content
        $subject = "Changement de votre mot de passe sur la plateforme ENSAH Service";
        $body = "Bonjour Monsieur/Madame " . $target_name . ",\n\n" .
            "Votre mot de passe a ete change avec succes sur la plateforme ENSAH Service.\n\n" .
            " Informations de connexion :\n" .
            "- Email : " . $target_mail . "\n" .
            "- Password : " . $target_password . "\n\n" .
            "Cordialement,\n" .
            "Equipe ENSAH Service";

        // Call the send method of the MailService class
        return $this->email_handler->sendEmail($target_mail, $subject, $body);
    }
}

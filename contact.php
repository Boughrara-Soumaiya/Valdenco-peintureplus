<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sécurisation des champs
    $nom     = htmlspecialchars($_POST['nom']);
    $email   = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $tel     = htmlspecialchars($_POST['tel']);
    $sujet   = htmlspecialchars($_POST['sujet']);
    $message = nl2br(htmlspecialchars($_POST['message']));

    // Email de réception (adresse liée à ton domaine OVH)
    $to = "sboughrara.860@gmail.com";

    // Sujet du mail reçu
    $subject = "📩 Nouveau message via le site – $sujet";

    // Contenu HTML de l'email
    $body = "
    <h2>Nouveau message reçu depuis le site</h2>
    <p><strong>Nom :</strong> $nom</p>
    <p><strong>Email :</strong> $email</p>
    <p><strong>Téléphone :</strong> $tel</p>
    <p><strong>Sujet :</strong> $sujet</p>
    <p><strong>Message :</strong><br>$message</p>
    ";

    // Headers (pour que ce soit propre et lisible en HTML)
    $headers  = "From: $nom <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // Envoi du mail
    if (mail($to, $subject, $body, $headers)) {
        // Redirection après succès
        header("Location: merci.html");
        exit();
    } else {
        echo "⚠️ Une erreur est survenue. Merci de réessayer plus tard.";
    }
}
?>

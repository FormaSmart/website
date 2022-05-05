<?php
if(!isset($_POST['submit']))
{
    echo"erreur, vous devez remplir le formulaire !";
}
    $name = $_POST['name'];
    $visitor_email = $_POST['email'];
    $message = $_POST['message'];

    //Validate first
    if(empty($name)||empty($visitor_email))
    {
        echo "Name and email are mandatory !";
        exit;
    }

    //Composer le message électronique
    $email_form = 'zwolf@outlook.fr'; //<= Votre adresse email ici
    $email_subject = "New form submission";
    $email_body = "You have received a new message from the user $name.\n".
        "email address: $visitor_email\n".
        "Here is the message: \n $message".

    //Envoi de l'e-mail
    $to = "zwolf@outlook.fr";
    $headers = "From: $email_form \r\n";
    $headers .= "Reply-To: $visitor_email \r\n";

    mail($to,$email_subject,$email_body,$headers);

    //Envoi de l'e-mail à plusieurs destinataires
    $to = "name1@website-name.com, name2@website-name.com,name3@website-name.com";

    mail($to,$email_subject,$email_body,$headers);
?>

//Sécuriser le formulaire contre l'injection d'email
<?php
function IsInjected($str)
{
    $injections = array('(\n+)',
        '(\r+)',
        '(\t+)',
        '(%0A+)',
        '(%0D+)',
        '(%08+)',
        '(%09+)'
    );

    $inject = join('|', $injections);
    $inject = "/$inject/i";

    if(preg_match($inject,$str))
    {
        return true;
    }
    else
    {
        return false;
    }
}

if(IsInjected($visitor_email))
{
    echo "Bad email value!";
    exit;
}
?>

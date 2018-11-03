<?php
function h($string){
    return htmlspecialchars($string);
}
if($_SERVER['REQUEST_METHOD']=='POST'){
$to      = 'rajkumaar2304@gmail.com';
$subject = h($_POST['contactSubject']);
$message = h($_POST['contactMessage']);
$name    = h($_POST['contactName']);
$from    = h($_POST['contactEmail']);
$headers = 'From: '.$from. "\r\n" .
    'Reply-To: '.$from . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);
}
echo "Mail sent".$to.$subject.$message;
?> 
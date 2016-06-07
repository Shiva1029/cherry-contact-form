<?php
include_once("scripts/phpInit.php");
$adminEmailCheck = 'email@example.com';
include_once("scripts/reCaptcha.php");
$reCaptchaResult = false;
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['g-recaptcha-response']) && $_POST['g-recaptcha-response'] != "") $reCaptchaResult = reCaptcha($reCaptchaSecretKey, $_POST['g-recaptcha-response']);

if (is_ajax()) {
    if (isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['email']) && isset($_POST['comment']) && ($_POST['inputFieldName'] == "") && ($_POST['inputFieldEmail'] == $adminEmailCheck) && ($reCaptchaResult)) {
        $errorMsg = "";
        $fname = preg_replace("/[^a-zA-Z]/", "", ucwords($_POST['fname']));
        $lname = preg_replace("/[^a-zA-Z]/", "", ucwords($_POST['lname']));
        preg_match('/[a-z0-9._-]+@[a-z0-9-]+.+[a-z].?[a-z]?/i', strtolower($_POST['email']), $matches);
        $email = $matches[0];
        $comment = ucfirst($_POST['comment']);
        if (strlen($fname) < 3 || strlen($fname) > 24 || $fname == "") {
            $errorMsg = "*First Name Field\n";
        }
        if (strlen($lname) < 3 || strlen($lname) > 24 || $lname == "") {
            $errorMsg = $errorMsg . "*Last Name Field\n";
        }
        if (strlen($email) < 6 || strlen($email) > 45 || $email == "") {
            $errorMsg = $errorMsg . "*Email Field\n";
        }
        if (strlen($comment) > $maxComment || $comment == "") {
            $errorMsg = $errorMsg . "*Comment Field\n";
        }
        if ($errorMsg == "") {
            $subject = 'Contact Form Submission - CinciBus.com';
            $body = $comment;
            $body = str_replace("\n.", "\n..", $body);
            $body = wordwrap($body, 70, "\r\n");
            $message = '<html>
<head>
  <title>' . $customTitle . ' - ' . $_SERVER['SERVER_NAME'] . '</title>
</head>
<body>
<div>Name: ' . $fname . ' ' . $lname . '</div>
<div>Comment: <br>' . $body . '</div>
</body>
</html>';
            $to = $adminEmail;
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= 'From: User <' . $email . '>' . "\r\n" . 'Reply-To: ' . $email . "\r\n";
            if (mail($to, $subject, $message, $headers)) echo "sent"; else echo "mail-error";
        } else echo $errorMsg;
    } else echo "postdata-error";
} else echo "ajaxpost-error";
function is_ajax()
{
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
} ?>
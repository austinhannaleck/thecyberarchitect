<?php
    
$fname = $_POST['firstname'];
$lname = $_POST['lastname'];
$email = $_POST['email'];
$service = $_POST['services'];
$message = $_POST['message'];
$to = 'akh452@live.com';
$subject = "The Cyber Architect - New Form Submission";



print_r($_POST);

echo "<br>" . $fname . " " . $lname . "<br>";
echo $email . "<br>";
echo $service . "<br>";
echo $message;


$msg = "$fname\n" .
        "$lname\n" .
        "$email\n" .
        "$service\n" .
        "$message";

mail($to, $subject, $msg, 'From:' . $email);

?>
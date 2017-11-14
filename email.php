<?php

// Only accept POST requests
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    // Remove any html tags and trim leading/trailing whitespace.
    $name = strip_tags(trim($_POST['firstname'])) . " " . strip_tags(trim($_POST['lastname']));
    $name = str_replace(array("\n", "\r"), array(" ", " "), $name);
    
    
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $service = $_POST['services'];
    $message = strip_tags($_POST['message']);
    
    // If the email is invalid, send back an error code.
    if(empty($message) || empty($service) || !filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        http_response_code(400);
        echo "There was a problem with your submission, please try again.";
        exit;
    }
    
    // Set email recipient.
    $to = 'ahannaleck1@gmail.com';
    
    // Set subject.
    $subject = "$service request from $name";
    
    // Build message content.
    $content  = "Name: $name\n";
    $content .= "Email: $email\n";
    $content .= "Message: $message\n";

    if(true == mail($to, $subject, $content, 'From:' . $email))
    {
        http_response_code(200);
        echo "Thank you for your submission, we will get back to you promptly!";
    }
    else
    {
        http_response_code(500);
        echo "Something went wrong and we couldn't send your message. Please try again later.";
    }
}
else
{
    // Not a POST request, send a forbidden error code (403)
    http_response_code(403);
    echo "There was a problem with your submission, please try again.";
}

?>
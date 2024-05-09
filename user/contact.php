
<?php
require 'vendor/autoload.php'; 
if (!empty($_POST["email"]) && !empty($_POST["inquiry"]))  {

    $email = new \SendGrid\Mail\Mail(); 
    $email->setFrom("no-reply@bauson.com", "no-reply-kidsofbataan");
    $email->setSubject("New Inquiry");
    $email->addTo("vashti.delapaz@gmail.com", "Support");
    $email->addContent("text/plain", "
    From: " . $_POST["email"]."\n\n
    Message: ".$_POST["inquiry"]
    );
    $sendgrid = new \SendGrid('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');

    try {
        $response = $sendgrid->send($email);
        print $response->statusCode() . "\n";
        print_r($response->headers());
        print $response->body() . "\n";
    } catch (Exception $e) {
        echo 'Caught exception: '. $e->getMessage() ."\n";
    }
}else{
    echo "No post params";
}

?>
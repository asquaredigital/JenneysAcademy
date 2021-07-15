<?php
    // My modifications to mailer script from:
    // http://blog.teamtreehouse.com/create-ajax-contact-form
    // Added input sanitizing to prevent injection


   


	
    // Only process POST reqeusts.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form fields and remove whitespace.
        $name = strip_tags(trim($_POST["name"]));
				$name = str_replace(array("\r","\n"),array(" "," "),$name);
		$father = trim($_POST["father"]);
        
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $contact = trim($_POST["contact"]);
        $year = trim($_POST["year"]);
        $position = trim($_POST["position"]);
        $address = trim($_POST["address"]);


        // Check that data was sent to the mailer.
        if ( empty($name) OR empty($father) OR empty($contact) OR empty($year) OR empty($address) OR empty($position) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Oops! There was a problem with your submission. Please complete the form and try again.";
            exit;
        }

        // Set the recipient email address.
        // FIXME: Update this to your desired email address.
        $recipient = "infojenneys@gmail.com";

        // Set the email subject.
        $subject = "Alumni Request from $name";
        $from="jenneyswebsite@gmail.com";
        //$sentby="eladinesh@ymail.com";
       // $retrun="eladinesh@ymail.com";

        // Build the email content.
        $email_content = "Name: $name\n\n";
        $email_content .= "Father: $father\n\n";
        $email_content .= "Email: $email\n\n";
        $email_content .= "Contact: $contact\n\n";
        $email_content .= "Year: $year\n\n";
        $email_content .= "Position :$position\n\n";
        $email_content .= "Address :$address\n\n";



        // Build the email headers.
        $email_headers = "From: $name <$from>\n";
        $email_headers .="Reply-To: $email\n";
       // $email_headers .="Sent by: $sentby\n";
        //$email_headers .= "Return-Path: $retrun";

        // Send the email.
       // if (mail($recipient, $subject, $email_content, $email_headers)) {
                if (mail($recipient, $subject, $email_content, $email_headers)) {

            // Set a 200 (okay) response code.
            http_response_code(200);
            echo "Thank You! Your message has been sent.";
        } else {
            // Set a 500 (internal server error) response code.
            http_response_code(500);
            echo "Oops! Something went wrong and we couldn't send your message.";
        }

    } else {
        // Not a POST request, set a 403 (forbidden) response code.
        http_response_code(403);
        echo "There was a problem with your submission, please try again.";
    }

?>

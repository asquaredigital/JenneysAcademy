<?php
    // My modifications to mailer script from:
    // http://blog.teamtreehouse.com/create-ajax-contact-form
    // Added input sanitizing to prevent injection

    // Only process POST reqeusts.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form fields and remove whitespace.
        $st_name= trim($_POST["st_name"]);
        $datepicker = trim($_POST["st_dob"]);
        $fr_name = trim($_POST["fr_name"]);
        $st_address= trim($_POST["st_address"]);
        $location = trim($_POST["location"]);
        $pincode = trim($_POST["pincode"]);
        $mobile_no = trim($_POST["mobile_no"]);
        $mail_id = filter_var(trim($_POST["mail_id"]), FILTER_SANITIZE_EMAIL);

        $optionsRadios = trim($_POST["optionsRadios"]);
        $passing_year = trim($_POST["passing_year"]);
        $marks_obt = trim($_POST["marks_obt"]);
        $percentage = trim($_POST["percentage"]);
        $course_interested = trim($_POST["course_interested"]);



        // Check that data was sent to the mailer.
        if ( empty($st_name) OR empty($st_address) OR !filter_var($mail_id, FILTER_VALIDATE_EMAIL)) {
            // Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Oops! There was a problem with your submission. Please complete the form and try again.";
            exit;
        }

        // Set the recipient email address.
        // FIXME: Update this to your desired email address.
        $recipient = "infojenneys@gmail.com";

        // Set the email subject.
        $subject = "Application from $st_name";
        $from="jenneyswebsite@gmail.com";
        $sentby="eladinesh@ymail.com";
        $retrun="eladinesh@ymail.com";

        // Build the email content.
        $email_content = "Name: $st_name\n\n";
        $email_content .= "DOB: $datepicker\n\n";
        $email_content .= "Father Name: $fr_name\n\n";
        $email_content .= "Address: $st_address\n\n";
        $email_content .= "Location: $location\n\n";
        $email_content .= "Pincode :$pincode\n\n";
        $email_content .= "Mobile :$mobile_no\n\n";
        $email_content .= "Email :$mail_id\n\n";
        $email_content .= "Examination :$optionsRadios\n\n";
        $email_content .= "Passing Year :$passing_year\n\n";
        $email_content .= "Marks :$marks_obt\n\n";
        $email_content .= "percentage :$percentage\n\n";

        
        $email_content .= "Course Interested :$course_interested\n\n";


        // Build the email headers.
        $email_headers = "From: $name <$from>\n";
        $email_headers .="Reply-To: $email\n";
       // $email_headers .="Sent by: $sentby\n";
        //$email_headers .= "Return-Path: $retrun";

        // Send the email.
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

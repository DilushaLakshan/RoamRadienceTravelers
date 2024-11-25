<?php
require 'connection.php';

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_GET["tID"]) && isset($_GET["statusID"]) && isset($_GET["bID"])) {
    $travelerID = $_GET["tID"];
    $statusID = $_GET["statusID"];
    $bookingID = $_GET["bID"];

    // get the user result according to the traveler_id
    $travelerResultSet = Database::search("SELECT * FROM `traveler` WHERE `id`='" . $travelerID . "'");
    $travelerNumRows = $travelerResultSet->num_rows;
    if ($travelerNumRows == 1) {
        $travelerData = $travelerResultSet->fetch_assoc();

        $fName = $travelerData["first_name"];
        $email = $travelerData["email"];

        // call the relevant email sending function
        if($statusID == 2){
            sendConfirmationEmail($email, $fName);
        } else if($statusID == 4){
            sendProceedToPayment($email, $fName);
        }
    }

    // update the status of the booking
    Database::insertUpdateDelete("UPDATE `booking` SET `status_id`='" . $statusID . "' WHERE `traveler_id`='" . $travelerID . "' AND `id`='" . $bookingID . "'");
    echo "success";
} else {
    echo "Something went wrong";
}

function sendConfirmationEmail($email, $fName)
{
    $email = $email;
    $fName = $fName;

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->SMTPDebug = 0;  // Disable debug output
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'roamradience@gmail.com';            // Your Gmail address
        $mail->Password = 'dfyu jqpz mxmr gmlw';                // App-specific password (not your Gmail password)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;      // Use SSL
        $mail->Port = 465;

        // Recipients
        $mail->setFrom('roamradience@gmail.com', 'RoamRadience Travelers');
        $mail->addAddress($email, $fName);     // Recipient email and name

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Your Booking is Confirmed - RoamRadience Travelers';
        $mail->Body = '
<html>
<head>
    <style>
        .email-container {
            font-family: Arial, sans-serif;
            color: #333;
            background-color: #f4f4f4;
            padding: 20px;
            border-radius: 10px;
            width: 100%;
        }
        .email-header {
            background-color: #28a745;
            color: white;
            padding: 10px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .email-body {
            background-color: white;
            padding: 20px;
            border-radius: 0 0 10px 10px;
        }
        .email-body h1 {
            color: #28a745;
        }
        .email-body p {
            font-size: 16px;
            line-height: 1.8;
        }
        .cta-button {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            color: white;
            background-color: #28a745;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #666;
        }
        .footer p {
            line-height: 1.5;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header Section -->
        <div class="email-header">
            <h2>Your Booking is Confirmed!</h2>
        </div>

        <!-- Body Section -->
        <div class="email-body">
            <h1>Hello ' . $fName . ' ,</h1>
            <p>
                We are thrilled to inform you that your booking with <b>RoamRadience Travelers</b> has been confirmed! Get ready for an unforgettable experience.
            </p>
            <p>
                Your journey details, including itinerary and travel tips, are now available in your account. You can review all the information, make additional plans, and prepare for your trip.
            </p>
            <a href="https://yourwebsite.com/booking-details" class="cta-button">View Your Booking</a>
        </div>

        <!-- Footer Section -->
        <div class="footer">
            <p>
                Have questions or need assistance? Contact us at <a href="mailto:support@roamradience.com">support@roamradience.com</a>.
            </p>
            <p>
                Safe travels,<br>
                The RoamRadience Team
            </p>
        </div>
    </div>
</body>
</html>
';

        // Send email
        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

function sendProceedToPayment($email, $fName){
    $email = $email;
    $fName = $fName;

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->SMTPDebug = 0;  // Disable debug output
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'roamradience@gmail.com';            // Your Gmail address
        $mail->Password = 'dfyu jqpz mxmr gmlw';                // App-specific password (not your Gmail password)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;      // Use SSL
        $mail->Port = 465;

        // Recipients
        $mail->setFrom('roamradience@gmail.com', 'RoamRadience Travelers');
        $mail->addAddress($email, $fName);     // Recipient email and name

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Your Booking is Confirmed - RoamRadience Travelers';
        $mail->Body = '
<html>
<head>
    <style>
        .email-container {
            font-family: Arial, sans-serif;
            color: #333;
            background-color: #f4f4f4;
            padding: 20px;
            border-radius: 10px;
            width: 100%;
        }
        .email-header {
            background-color: #28a745;
            color: white;
            padding: 10px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .email-body {
            background-color: white;
            padding: 20px;
            border-radius: 0 0 10px 10px;
        }
        .email-body h1 {
            color: #28a745;
        }
        .email-body p {
            font-size: 16px;
            line-height: 1.8;
        }
        .cta-button {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            color: white;
            background-color: #28a745;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #666;
        }
        .footer p {
            line-height: 1.5;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header Section -->
        <div class="email-header">
            <h2>Your Booking is Confirmed!</h2>
        </div>

        <!-- Body Section -->
        <div class="email-body">
            <h1>Hello ' . $fName . ' ,</h1>
            <p>
                We are thrilled to inform you that your booking with <b>RoamRadience Travelers</b> has been confirmed! Get ready for an unforgettable experience.
            </p>
            <p>
                Your journey details, including itinerary and travel tips, are now available in your account. You can review all the information, make additional plans, and prepare for your trip.
            </p>
            <a href="https://yourwebsite.com/booking-details" class="cta-button">View Your Booking</a>
        </div>

        <!-- Footer Section -->
        <div class="footer">
            <p>
                Have questions or need assistance? Contact us at <a href="mailto:support@roamradience.com">support@roamradience.com</a>.
            </p>
            <p>
                Safe travels,<br>
                The RoamRadience Team
            </p>
        </div>
    </div>
</body>
</html>
';

        // Send email
        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

?>
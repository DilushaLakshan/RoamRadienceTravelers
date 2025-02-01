<?php
require 'connection.php';

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST["email"])) {
    $email = $_POST["email"];

    if (empty($email)) {
        echo "Please enter your email";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Enter a valid email";
    } else {
        $userResultSet = Database::search("SELECT * FROM `traveler` WHERE `email`='" . $email . "'");
        $userNumRows = $userResultSet->num_rows;
        if ($userNumRows == 1) {
            // generating a random number for OTP
            $otp = rand(100000, 999999);

            $date = new DateTime();
            $timeZone = new DateTimeZone('Asia/colombo');
            $date->setTimezone($timeZone);
            $currentDateTimeString = $date->format('Y-m-d H:i:s');

            // update the traveler relation
            Database::insertUpdateDelete("UPDATE `traveler` SET `otp`='".$otp."', `otp_send_date_time`='".$currentDateTimeString."' WHERE `email`='".$email."'");
            
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
                $mail->addAddress($email);     // Recipient email and name

                // Content
                $mail->isHTML(true);
                $mail->Subject = 'Reset Password';
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
            <h2>OTP Verification</h2>
        </div>

        <!-- Body Section -->
        <div class="email-body">
            <p>
                Your OTP for verifying your email address is: 
                <b style="font-size: 20px; color: #28a745;">' . $otp . '</b>
            </p>
            <p>
                Please use this code to complete your verification process. This OTP is valid for <b>5 minutes</b>.
            </p>
            <p>
                If you did not request this code, please ignore this email.
            </p>
        </div>

        <!-- Footer Section -->
        <div class="footer">
            <p>
                Need assistance or have questions? Contact our support team at <a href="mailto:support@roamradience.com">support@roamradience.com</a>.
            </p>
            <p>
                Thank you for choosing RoamRadience Travelers!<br>
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

            echo "success";
        } else {
            echo "Could found email";
        }
    }
} else {
    echo "Something went wrong";
}

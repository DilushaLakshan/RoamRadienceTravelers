<?php
require 'connection.php';

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$fName = $_POST["firstName"];
$lName = $_POST["lastName"];
$email = $_POST["email"];
$password = $_POST["password"];
$contact = $_POST["contact"];
$houseNo = $_POST["houseNo"];
$street1 = $_POST["street1"];
$street2 = $_POST["street2"];

if (
    empty($fName) || empty($lName) || empty($email) ||
    empty($password) || empty($contact) || empty($houseNo) || empty($street1) || empty($street2)
) {
    echo "Please fill the required areas...!";
} else if (strlen($fName) > 20) {
    echo "First name should be less than 20 characters";
} else if (strlen($lName) > 20) {
    echo "Last Name  should be less than 20 characters";
} else if (strlen($email) > 45) {
    echo "Email should be less than 45 charcters";
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Enter a valid email";
} else if (strlen($password) != 8) {
    echo "Password must have 8 characters";
} else if (strlen($contact) != 10) {
    echo "Contact number does not contain 10 numbers";
} else if (!preg_match("/07[0,1,2,4,5,6,7,8][0-9]/", $contact)) {
    echo "Enter a valid contact number";
} else {

    //insert data to the traveler relation
    Database::insertUpdateDelete("INSERT INTO `traveler` (`first_name`,`last_name`,`email`,`password`,`contact`,`house_no`,`street_1`,`street_2`) VALUES ('" . $fName . "','" . $lName . "','" . $email . "','" . $password . "','" . $contact . "','" . $houseNo . "','" . $street1 . "','" . $street2 . "')");

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
        $mail->addAddress($email, $fName . ' ' . $lName);     // Recipient email and name

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Welcome to RoamRadience Travelers';
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
        .package-section {
            margin-top: 30px;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
        }
        .package {
            margin: 10px 0;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        .package h2 {
            color: #28a745;
            font-size: 20px;
        }
        .package img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }
        .package-description {
            font-size: 14px;
            margin-top: 5px;
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
            <h2>Welcome to RoamRadience Travelers!</h2>
        </div>

        <!-- Body Section -->
        <div class="email-body">
            <h1>Hello ' . $fName . ' ' . $lName . ',</h1>
            <p>
                We are beyond excited to have you join <b>RoamRadience Travelers!</b> Get ready to experience unforgettable journeys, special travel deals, and insider tips that will make your adventures truly remarkable.
            </p>
            <p>
                As part of our community, you now have access to exclusive offers and personalized travel recommendations based on your interests. We’ve already picked out some featured destinations just for you!
            </p>
            <a href="https://yourwebsite.com" class="cta-button">Explore Your Travel Deals</a>
            
            <!-- Featured Packages Section -->
            <div class="package-section">
                <h2>Featured Travel Packages:</h2>
                
                <!-- Package 1 -->
                <div class="package">
                    <h2>Sunny Beach Getaway</h2>
                    <img src="https://yourwebsite.com/beach.jpg" alt="Sunny Beach" />
                    <p class="package-description">
                        Soak up the sun and enjoy crystal-clear waters with our exclusive beach package. Limited-time offer with up to 50% off!
                    </p>
                </div>

                <!-- Package 2 -->
                <div class="package">
                    <h2>Mountain Adventure</h2>
                    <img src="https://yourwebsite.com/mountain.jpg" alt="Mountain Adventure" />
                    <p class="package-description">
                        Escape to the mountains for a refreshing adventure filled with hiking, camping, and breathtaking views. Book now for early-bird discounts!
                    </p>
                </div>

                <!-- Package 3 -->
                <div class="package">
                    <h2>City Explorer Tour</h2>
                    <img src="https://yourwebsite.com/city.jpg" alt="City Tour" />
                    <p class="package-description">
                        Discover vibrant cityscapes, historical landmarks, and cultural treasures in our handpicked city tour packages.
                    </p>
                </div>
            </div>

            <p>
                These are just a few of the exciting offers we have in store for you. Click the button above to see all available deals and start planning your next dream vacation!
            </p>
        </div>

        <!-- Footer Section -->
        <div class="footer">
            <p>
                Need assistance or have questions? Contact our support team at <a href="mailto:support@roamradience.com">support@roamradience.com</a>.
                We’re here to make sure your travel experience is perfect from start to finish!
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
        // $mail->send();
        echo "success";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

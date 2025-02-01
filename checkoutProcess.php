<?php
require __DIR__ . "/vendor/autoload.php";

$stripe_secret_key = "sk_test_51QgMpOLR0QAFGNEkIASoQOCaxhjT5OL83N7a0ZsF3Ev0Mwtor6TdKaTLcGIRcE4SswLseZteqVnvuckqlWGQasyR00jxZvhjpc";

\Stripe\Stripe::setApiKey($stripe_secret_key);

try {
    $checkout_session = \Stripe\Checkout\Session::create([
        "payment_method_types" => ["card"],
        "line_items" => [
            [
                "quantity" => 1,
                "price_data" => [
                    "currency" => "usd",
                    "unit_amount" => 2000, // Amount in cents (e.g., $20.00 = 2000 cents)
                    "product_data" => [
                        "name" => "Package 1",
                    ],
                ],
            ],
        ],
        "mode" => "payment",
        "success_url" => "http://localhost/roamradiencetravelers/traveler-profile.php?session_id={CHECKOUT_SESSION_ID}",
        "cancel_url" => "http://localhost/roamradiencetravelers/payment-cancelled.php",
    ]);

    http_response_code(303);
    header("Location: " . $checkout_session->url);
} catch (\Stripe\Exception\ApiErrorException $e) {
    echo "Error: " . $e->getMessage();
}
?>
<?php
require_once '../../../baseUrl.php';
require_once '../vendor/autoload.php';
require_once '../secrets.php';

\Stripe\Stripe::setApiKey($stripeSecretKey);
header('Content-Type: application/json');


$checkout_session = \Stripe\Checkout\Session::create([
    "mode" => "payment",
    "success_url" => $baseUrl."incorporation/register-company/backup/public/success.html",
    "cancel_url" => $baseUrl."incorporation/register-company/backup/public/cancel.html",
    "locale" => "auto",
    "line_items" => [
        [
            "quantity" => 1,
            "price_data" => [
                "currency" => "usd",
                "unit_amount" => 870,
                "product_data" => [
                    "name" => "incorporation Company Register With Virtual Address Fee"
                ]
            ]
        ],
        [
            "quantity" => 1,
            "price_data" => [
                "currency" => "usd",
                "unit_amount" => 630,
                "product_data" => [
                    "name" => "incorporation Company Register Fee"
                ]
            ]
        ]        
    ]
]);

http_response_code(303);
header("Location: " . $checkout_session->url);
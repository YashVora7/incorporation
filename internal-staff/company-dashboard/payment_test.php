<?php
require_once '../session.php';
require_once '../baseUrl.php';

// Your Stripe secret key
$apiKey = 'sk_test_51PlEneRpC1dMDr0aytDw4RoMmmVzDFdPCw9Fp1Aba23xkmefVaygMyzPX0Wg1bT64uoSpeQu5cBVMydjxRHKhSGJ00K3T1WxdJ';

header('Content-Type: application/json');

$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    echo json_encode(['error' => 'Invalid JSON received']);
    exit;
}

if (!isset($data['amount'], $data['currency'], $data['description'])) {
    echo json_encode(['error' => 'Missing required parameters']);
    exit;
}

$amount = $data['amount'];
$currency = $data['currency'];
$description = $data['description'];

function createStripePaymentIntent($amount, $currency, $description, $apiKey) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/payment_intents');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
        'amount' => $amount,
        'currency' => $currency,
        'payment_method_types' => ['card'],
        'description' => $description
    ]));
    curl_setopt($ch, CURLOPT_USERPWD, $apiKey . ':');

    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        throw new Exception('Curl error: ' . curl_error($ch));
    }
    curl_close($ch);

    $responseDecoded = json_decode($response, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception('Invalid JSON received from Stripe');
    }
    if (isset($responseDecoded['error'])) {
        throw new Exception($responseDecoded['error']['message']);
    }

    return $responseDecoded['client_secret'];
}

try {
    $clientSecret = createStripePaymentIntent($amount, $currency, $description, $apiKey);
    echo json_encode(['clientSecret' => $clientSecret]);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>

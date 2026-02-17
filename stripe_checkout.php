<?php
require __DIR__ . '/vendor/autoload.php';
session_start();

$config = require __DIR__ . '/config.example.php';
\Stripe\Stripe::setApiKey($config['stripe_secret']);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: stripe_form.php');
    exit;
}

$email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
$amount = floatval($_POST['amount'] ?? 0);
if ($amount <= 0.49) {
    $_SESSION['flash'] = 'Amount must be at least $0.50';
    header('Location: stripe_form.php');
    exit;
}

$amount_cents = intval(round($amount * 100));

$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$base = $protocol . '://' . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

try {
    $session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
                'currency' => 'usd',
                'product_data' => ['name' => 'Demo Payment'],
                'unit_amount' => $amount_cents,
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'customer_email' => $email ?: null,
        'success_url' => $base . '/stripe_success.php?session_id={CHECKOUT_SESSION_ID}',
        'cancel_url' => $base . '/stripe_cancel.php',
    ]);

    header('Location: ' . $session->url);
    exit;
} catch (Exception $e) {
    $_SESSION['flash'] = 'Stripe error: ' . $e->getMessage();
    header('Location: stripe_form.php');
    exit;
}

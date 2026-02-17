<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$name = trim($_POST['name'] ?? '');
$email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
$amount = floatval($_POST['amount'] ?? 0);
$card = preg_replace('/\D/', '', $_POST['card'] ?? '');
$exp = trim($_POST['exp'] ?? '');
$cvv = trim($_POST['cvv'] ?? '');

if (!$name || !$email || $amount <= 0 || strlen($card) < 12) {
    $_SESSION['flash'] = 'Invalid input. Please check your details.';
    header('Location: index.php');
    exit;
}

$txid = uniqid('tx_');

// Mock gateway logic: succeed when last card digit is even
$lastDigit = intval(substr($card, -1));
$success = ($lastDigit % 2) === 0;

if ($success) {
    $_SESSION['payment'] = [
        'txid' => $txid,
        'name' => $name,
        'email' => $email,
        'amount' => number_format($amount, 2, '.', ''),
        'timestamp' => time(),
    ];
    header('Location: success.php?tx=' . urlencode($txid));
    exit;
} else {
    $_SESSION['error'] = [
        'txid' => $txid,
        'reason' => 'Card declined by mock gateway',
    ];
    header('Location: cancel.php?tx=' . urlencode($txid));
    exit;
}

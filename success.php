<?php
session_start();
$tx = $_GET['tx'] ?? '';
$payment = $_SESSION['payment'] ?? null;
if (!$payment || $payment['txid'] !== $tx) {
    $_SESSION['flash'] = 'Payment not found or session expired.';
    header('Location: index.php');
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Payment Successful</title>
  <style>
    :root{--bg:#0b1020;--card:#0f1724;--muted:#9aa6bf;--accent:#7c5cff}
    body{font-family:Inter,Arial,Helvetica,sans-serif;background:linear-gradient(180deg,#071024 0%,var(--bg) 100%);color:#e6eef8;margin:0;padding:28px}
    .card{max-width:720px;margin:0 auto;background:linear-gradient(180deg,rgba(255,255,255,0.02),rgba(255,255,255,0.01));padding:22px;border-radius:12px;border:1px solid rgba(255,255,255,0.04)}
    h1{color:#22c55e;margin:0 0 8px}
    p{margin:8px 0;color:#e6eef8}
    ul{margin:12px 0;color:#e6eef8}
    a.button{display:inline-block;margin-top:8px;padding:10px 14px;background:transparent;color:var(--accent);border-radius:8px;text-decoration:none;border:1px solid rgba(124,92,255,0.12)}
  </style>
</head>
<body>
  <div class="card">
    <h1>Payment Successful</h1>
    <p>Thank you, <?php echo htmlspecialchars($payment['name']); ?>. Your payment was processed.</p>
    <ul>
      <li><strong>Transaction ID:</strong> <?php echo htmlspecialchars($payment['txid']); ?></li>
      <li><strong>Amount:</strong> $<?php echo htmlspecialchars($payment['amount']); ?></li>
      <li><strong>Email:</strong> <?php echo htmlspecialchars($payment['email']); ?></li>
    </ul>
    <a class="button" href="index.php">Return to payment page</a>
  </div>
</body>
</html>

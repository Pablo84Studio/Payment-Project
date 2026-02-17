<?php
require __DIR__ . '/vendor/autoload.php';
$config = require __DIR__ . '/config.example.php';
\Stripe\Stripe::setApiKey($config['stripe_secret']);

$session_id = $_GET['session_id'] ?? null;
$session = null;
if ($session_id) {
    try {
        $session = \Stripe\Checkout\Session::retrieve($session_id);
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Stripe Success</title>
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
    <h1>Payment Completed</h1>
    <?php if (!empty($error)): ?>
      <p>Error retrieving session: <?php echo htmlspecialchars($error); ?></p>
    <?php elseif ($session): ?>
      <p>Thank you. Payment status: <?php echo htmlspecialchars($session->payment_status ?? 'unknown'); ?></p>
      <ul>
        <li><strong>Session ID:</strong> <?php echo htmlspecialchars($session->id); ?></li>
        <li><strong>Amount:</strong> $<?php echo number_format(($session->amount_total ?? 0) / 100, 2); ?></li>
        <li><strong>Customer email:</strong> <?php echo htmlspecialchars($session->customer_email ?? ''); ?></li>
      </ul>
    <?php else: ?>
      <p>No session ID provided.</p>
    <?php endif; ?>
    <a class="button" href="stripe_form.php">Return to demo</a>
  </div>
</body>
</html>

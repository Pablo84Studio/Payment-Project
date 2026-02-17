<?php
// Simple cancel page for Stripe demo
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Stripe Cancelled</title>
  <style>
    :root{--bg:#0b1020;--card:#0f1724;--muted:#9aa6bf;--danger:#ff6b6b;--accent:#7c5cff}
    body{font-family:Inter,Arial,Helvetica,sans-serif;background:linear-gradient(180deg,#071024 0%,var(--bg) 100%);color:#e6eef8;margin:0;padding:28px}
    .card{max-width:720px;margin:0 auto;background:linear-gradient(180deg,rgba(255,255,255,0.02),rgba(255,255,255,0.01));padding:22px;border-radius:12px;border:1px solid rgba(255,255,255,0.04)}
    h1{color:var(--danger);margin:0 0 8px}
    p{margin:8px 0;color:#e6eef8}
    a.button{display:inline-block;margin-top:8px;padding:10px 14px;background:transparent;color:var(--accent);border-radius:8px;text-decoration:none;border:1px solid rgba(124,92,255,0.12)}
  </style>
</head>
<body>
  <div class="card">
    <h1>Payment Cancelled</h1>
    <p>Your payment was cancelled. You can try again.</p>
    <a class="button" href="stripe_form.php">Back to demo</a>
  </div>
</body>
</html>

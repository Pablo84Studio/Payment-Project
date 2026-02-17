<?php
// Simple form that posts to stripe_checkout.php
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Stripe Checkout Demo</title>
  <style>
    :root{--bg:#0b1020;--card:#0f1724;--muted:#9aa6bf;--accent:#7c5cff;--accent-2:#3b82f6}
    body{font-family:Inter,Arial,Helvetica,sans-serif;background:linear-gradient(180deg,#071024 0%,var(--bg) 100%);color:#e6eef8;margin:0;padding:28px}
    .box{max-width:720px;margin:0 auto;background:linear-gradient(180deg,rgba(255,255,255,0.02),rgba(255,255,255,0.01));padding:22px;border-radius:12px;border:1px solid rgba(255,255,255,0.04)}
    h1{margin:0 0 8px 0;color:#f8fafc}
    p.lead{margin:0 0 18px;color:var(--muted)}
    label{display:block;font-size:13px;color:var(--muted);margin-top:10px}
    input{width:100%;padding:12px;border-radius:10px;border:1px solid rgba(255,255,255,0.04);background:rgba(255,255,255,0.02);color:#e6eef8}
    .actions{display:flex;gap:10px;margin-top:16px}
    button{background:var(--accent);color:#fff;padding:10px 14px;border-radius:8px;border:none;cursor:pointer}
    button[onclick]{background:transparent;border:1px solid rgba(59,130,246,0.12);color:var(--accent-2)}
    small{display:block;margin-top:10px;color:var(--muted)}
  </style>
</head>
<body>
  <div class="box">
    <h1>Stripe Checkout Demo</h1>
    <p class="lead">Quick demo using server-side Checkout Sessions. Test cards only.</p>

    <form action="stripe_checkout.php" method="post" id="stripeDemo">
      <label for="email">Email</label>
      <input id="email" name="email" type="email" placeholder="you@example.com" required>

      <label for="amount">Amount (USD)</label>
      <input id="amount" name="amount" type="number" step="0.01" min="0.5" value="9.99" required>

      <div class="actions">
        <button type="submit">Pay with Stripe Checkout</button>
        <button type="button" onclick="location.href='index.php'" style="background:#eef2ff;color:#0b3a8c">Back to demo</button>
      </div>
    </form>

    <small>Test card: 4242 4242 4242 4242 — any future expiry and CVC are fine.</small>
  </div>

  <script>
    // live amount formatting
    const amt = document.getElementById('amount');
    amt.addEventListener('input', ()=>{ if(!amt.value) amt.value='0.00'; });
  </script>
</body>
</html>

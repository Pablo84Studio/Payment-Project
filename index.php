<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Simple PHP Payment Gateway</title>
  <style>
    :root{--bg:#0b1020;--card:#0f1724;--muted:#9aa6bf;--accent:#7c5cff;--accent-2:#3b82f6;--success:#22c55e;--danger:#ff6b6b}
    *{box-sizing:border-box}
    body{font-family:Inter,Arial,Helvetica,sans-serif;background:linear-gradient(180deg,#071024 0%,var(--bg) 100%);color:#e6eef8;margin:0;padding:32px}
    .wrap{max-width:980px;margin:0 auto}
    header{display:flex;align-items:center;gap:16px}
    h1{margin:0;font-size:20px;color:#f8fafc}
    .card{background:linear-gradient(180deg,rgba(255,255,255,0.02),rgba(255,255,255,0.01));border-radius:12px;padding:28px;margin-top:18px;border:1px solid rgba(255,255,255,0.04)}
    .lead{color:var(--muted);margin-top:6px}
    .flash{padding:12px;border-radius:8px;margin-bottom:12px}
    .flash.info{background:rgba(124,92,255,0.08);border:1px solid rgba(124,92,255,0.12);color:var(--accent)}
    form{display:grid;grid-template-columns:1fr 320px;gap:20px}
    .col-main{min-width:0}
    label{display:block;font-size:13px;color:var(--muted);margin-bottom:6px}
    input[type=text], input[type=email], input[type=number]{width:100%;padding:12px 14px;border-radius:10px;border:1px solid rgba(255,255,255,0.04);background:rgba(255,255,255,0.02);color:#e6eef8}
    .row{display:flex;gap:10px}
    .row > div{flex:1}
    .right{background:transparent;padding:16px;border-radius:8px}
    .amount{font-size:20px;font-weight:600;margin-top:6px;color:#fff}
    button{background:var(--accent);color:white;padding:12px 14px;border-radius:10px;border:none;cursor:pointer;width:100%;font-weight:600}
    button.secondary{background:transparent;color:var(--accent-2);border:1px solid rgba(59,130,246,0.12)}
    .note{font-size:13px;color:var(--muted);margin-top:12px}
    footer{margin-top:18px;color:var(--muted);font-size:13px}
    a{color:var(--accent-2)}
    @media (max-width:820px){form{grid-template-columns:1fr} .right{order:2}}
  </style>
</head>
<body>
  <div class="wrap">
    <header>
      <img src="" alt="" style="width:46px;height:46px;border-radius:8px;background:#e6eefc;display:inline-block;">
      <div>
        <h1>Simple PHP Payment Gateway</h1>
        <div class="lead">Demo checkout — fast, local testing</div>
      </div>
    </header>

    <div class="card">
      <?php if (!empty($_SESSION['flash'])): ?>
        <div class="flash info"><?php echo htmlspecialchars($_SESSION['flash']); unset($_SESSION['flash']); ?></div>
      <?php endif; ?>

      <form method="post" action="process.php" id="payForm">
        <div class="col-main">
          <label for="name">Full name</label>
          <input id="name" name="name" type="text" placeholder="Jane Doe" required>

          <label for="email">Email</label>
          <input id="email" name="email" type="email" placeholder="you@example.com" required>

          <label for="amount">Amount (USD)</label>
          <input id="amount" name="amount" type="number" step="0.01" min="0.50" value="9.99" required>

          <label for="card">Card number</label>
          <input id="card" name="card" type="text" placeholder="4242 4242 4242 4242" inputmode="numeric" autocomplete="cc-number" required>

          <div class="row" style="margin-top:8px">
            <div>
              <label for="exp">Expiry (MM/YY)</label>
              <input id="exp" name="exp" type="text" placeholder="12/30" autocomplete="cc-exp" required>
            </div>
            <div>
              <label for="cvv">CVV</label>
              <input id="cvv" name="cvv" type="text" placeholder="123" inputmode="numeric" autocomplete="cc-csc" required>
            </div>
          </div>

          <div class="note">Demo rule: card numbers ending with an even digit succeed; odd digits fail.</div>
        </div>

        <aside class="right">
          <div style="display:flex;justify-content:space-between;align-items:center">
            <div style="font-size:13px;color:var(--muted)">Order summary</div>
            <div style="font-size:12px;color:var(--muted)">Test only</div>
          </div>
          <div class="amount" id="summaryAmount">$9.99</div>
          <div style="margin-top:14px">
            <button type="submit">Pay now</button>
          </div>
          <div style="margin-top:10px">
            <button type="button" class="secondary" onclick="location.href='stripe_form.php'">Pay with Stripe</button>
          </div>
        </aside>
      </form>
    </div>

    <footer>For development only — do not collect real card data here.</footer>
  </div>

  <script>
    // update summary amount live
    const amount = document.getElementById('amount');
    const summary = document.getElementById('summaryAmount');
    amount.addEventListener('input', ()=>{
      const v = parseFloat(amount.value)||0;
      summary.textContent = '$' + v.toFixed(2);
    });

    // simple card formatting (blocks of 4)
    const card = document.getElementById('card');
    card.addEventListener('input', e=>{
      const digits = card.value.replace(/\D/g,'').slice(0,19);
      card.value = digits.replace(/(.{4})/g,'$1 ').trim();
    });
  </script>
</body>
</html>

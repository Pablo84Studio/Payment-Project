# Payment-Project

Simple demo of a payment gateway flow implemented in PHP. This repository contains a small, self-contained mock gateway for testing and learning purposes.

Important: This is a demo. Do NOT use this code in production — card data is handled insecurely for demonstration only.

Files added:
- `index.php` — payment form UI
- `process.php` — mock processor that simulates success/failure
- `success.php` — success landing page
- `cancel.php` — failure landing page

How the demo works:
- The mock rule: if the card number ends with an even digit the payment succeeds; if it ends with an odd digit it fails.

Run locally (PHP built-in server):

```bash
cd /workspaces/Payment-Project
php -S localhost:8000
```

Open http://localhost:8000/index.php in your browser.

Example test card numbers:
- Success: 4242424242424242
- Failure: 4242424242424241

Next steps (optional):
- Integrate a real processor (Stripe, PayPal) using their SDKs and switch to HTTPS.

Stripe integration example

- Files: `composer.json`, `config.example.php`, `stripe_form.php`, `stripe_checkout.php`, `stripe_success.php`, `stripe_cancel.php`

To use the Stripe demo:

1. Install dependencies with Composer (install Composer if needed):

```bash
cd /workspaces/Payment-Project
composer install
```

2. Set your Stripe secret key as an environment variable or edit `config.example.php`:

```bash
export STRIPE_SECRET=sk_test_...
```

3. Start the PHP server:

```bash
php -S localhost:8000
```

4. Open http://localhost:8000/stripe_form.php and test using Stripe test cards (e.g., 4242 4242 4242 4242).

Notes:
- This example uses Checkout Sessions and is intended for development/testing only.
- For production integrate full webhook verification and secure server configuration.

Payment Process

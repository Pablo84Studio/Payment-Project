<?php
// Copy to config.php or set STRIPE_SECRET environment variable
return [
    'stripe_secret' => getenv('STRIPE_SECRET') ?: 'sk_test_YOUR_TEST_KEY_HERE',
];

<!-- A page to test the OAuth server: install the database tables, register a consumer, get a request token, authorize it, exchange it for a request token, and then finally access the "protected resource". -->

<form method="POST" action="request_token.php">
<?php fields(); ?>
<input type="hidden" name="oauth_token" value="" />
<button type="submit">Request Token</button>
</form>

<form method="GET" action="authorize.php">
<button type="submit">Authorize Token</button>
<input type="text" name="oauth_token" value="" />
</form>

<form method="POST" action="access_token.php">
<?php fields(); ?>
<button type="submit">Access Token</button>
<input type="text" name="oauth_token" value="" />
</form>

<form method="POST" action="protected.php">
<?php fields(); ?>
<button type="submit">Protected Resource</button>
<input type="text" name="oauth_token" value="" />
</form>

<form method="POST" action="../oauth_register.php">
<input type="hidden" name="requester_name" value="Consumer" />
<input type="hidden" name="requester_email" value="name@domain.com" />
<input type="hidden" name="application_title" value="My API" />
<button type="submit">Register Consumer</button>
</form>

<form action="<?php 
// This should be an admin option, or perhaps part of core (?)
define('IN_COPPERMINE', TRUE);
require 'cpgOAuth.php';
$store = OAuthStore::instance();
$store->install();
?>">
<button type="submit">Install OAuth database tables</button>
</form>

<?php
function fields() {
echo <<<EOT
<input type="hidden" name="oauth_nonce" value="a123o40" />
<input type="hidden" name="oauth_timestamp" value="
EOT;
print(time());
echo <<<EOT
" />
<input type="hidden" name="oauth_consumer_key" value="2bbd8af7ca3e08f07b2c59ddba316bc70485ffd55" />
<input type="hidden" name="oauth_signature_method" value="HMAC-SHA1" />
<!-- <input type="hidden" name="oauth_signature" value="" /> -->
EOT;
}
?>
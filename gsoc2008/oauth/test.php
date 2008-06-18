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

<form method="POST" action="register.php">
<input type="hidden" name="requester_name" value="David" />
<input type="hidden" name="requester_email" value="name@domain.com" />
<input type="hidden" name="application_title" value="My API" />
<button type="submit">Register Consumer</button>
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
<input type="hidden" name="oauth_consumer_key" value="0939a5e84f061e904d1d3319de5c6e8a04849fd94" />
<input type="hidden" name="oauth_signature_method" value="HMAC-SHA1" />
<!-- <input type="hidden" name="oauth_signature" value="" /> -->

EOT;
}
?>
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


<form method="POST" action="api_index.php" enctype="multipart/form-data">
<?php fields(); ?>
<button type="submit">API Upload</button>
<input type="text" name="oauth_token" value="" />
<input type="hidden" name="function" value="upload" />
<input type="hidden" name="event" value="picture" />
<input type="hidden" name="album" value="1" />
<input type="hidden" name="title" value="testpic" />
<input type="hidden" name="caption" value="A picture." />
<input type="file" name="userpicture" value="" />
</form>


<form method="POST" action="api_index.php" enctype="multipart/form-data">
<?php fields(); ?>
<button type="submit">API Category List</button>
<input type="text" name="oauth_token" value="" />
<input type="hidden" name="function" value="cat_list" />
</form>

<form method="POST" action="register.php">
<input type="hidden" name="requester_name" value="Consumer" />
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
<input type="hidden" name="oauth_consumer_key" value="278c2e73743f531c42a71fe308c48ba104877fc36" />
<input type="hidden" name="oauth_signature_method" value="HMAC-SHA1" />
<!-- <input type="hidden" name="oauth_signature" value="" /> -->
EOT;
}
?>
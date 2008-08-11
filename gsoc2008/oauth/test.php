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

<form method="POST" action="api_index.php">
<?php fields(); ?>
<button type="submit">API Category List</button>
<input type="text" name="oauth_token" value="" />
<input type="hidden" name="function" value="catlist" />
<input type="hidden" name="catid" value="0" />
</form>

<form method="POST" action="api_index.php">
<?php fields(); ?>
<button type="submit">API Album List</button>
<input type="text" name="oauth_token" value="" />
<input type="hidden" name="function" value="alblist" />
<input type="hidden" name="cat" value="3" />
</form>

<form method="POST" action="api_index.php">
<?php fields(); ?>
<button type="submit">API Picture List</button>
<input type="text" name="oauth_token" value="" />
<input type="hidden" name="function" value="piclist" />
<input type="hidden" name="aid" value="2" />
<input type="hidden" name="password" value="secret" />
</form>

<form method="POST" action="api_index.php">
<?php fields(); ?>
<button type="submit">API Search</button>
<input type="text" name="oauth_token" value="" />
<input type="hidden" name="function" value="search" />
<input type="hidden" name="type" value="AND" />
<input type="hidden" name="search" value="pic" />
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
<input type="hidden" name="oauth_consumer_key" value="6be002f9d55a71f68d00458232abdaac0489113cb" />
<input type="hidden" name="oauth_signature_method" value="HMAC-SHA1" />
<!-- <input type="hidden" name="oauth_signature" value="" /> -->
EOT;
}
?>
<?php
// Register an application to "consume" the Coppermine API via OAuth

require 'cpgOAuth.php';

define('IN_COPPERMINE', true);
require_once 'include/init.inc.php';

if (!USER_ID) {
    echo 'Please <a href="../login.php?referer=oauth/register.php">login</a> to your user account.';
    exit();
}

$superCage = Inspekt::makeSuperCage();

if (!($superCage->post->keyExists('requester_name') && $superCage->post->keyExists('requester_email') && $superCage->post->keyExists('application_title'))) {
    echo <<<EOT
<form method="POST" action="register.php">
<label for="requester_name">Requester Name: </label><input type="text" name="requester_name" /><br />
<label for="requester_email">Requester Email: </label><input type="text" name="requester_email" /><br />
<label for="application_title">Application Title: </label><input type="text" name="application_title" /><br /><br />
<button type="submit">Register Consumer</button>
</form>
EOT;
exit;
}

// Get the consumer's information from POST - is the "/[\w ]+/" regex friendly to non-English languages?
$name = $superCage->post->getMatched('requester_name', '/[\w ]+/');
$email = $superCage->post->getMatched('requester_email', '/\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b/i'); // regex from install.php
$application = $superCage->post->getMatched('application_title', '/[\w ]+/');

$consumer = array(
    'requester_name' => $name[0],
    'requester_email' => $email[0],
    'application_title' => $application[0]
);

foreach ($consumer as $key => $value) {
    if ($value == '') {
        throw new OAuthException($key . ' is undefined in HTTP POST');
    }
}

$store = OAuthStore::instance();
// Register the consumer in the database and print out the resulting consumer key
$consumer_id = $store->updateConsumer($consumer, USER_ID, true);

// Print registration information
print "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>\n" .
'<consumer_key>' . $consumer_id . '</consumer_key>' .
"\n<name>$name[0]</name>" .
"\n<email>$email[0]</email>" .
"\n<application>$application[0]</application>";

?>
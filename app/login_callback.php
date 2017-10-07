<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'start.php';
require_once '../partials/header.php';
//var_dump($user);


if (isset($_GET['code']) && isset($_GET['state'])) {    
    //Bad practice! No input sanitization!
    $code = $_GET['code'];
    $state = $_GET['state'];

    //Fetch the AccessToken
    $accessToken = $authHelper->getAccessToken($code, $state, $callbackUrl);
    //echo $accessToken->getToken();
    //$authHelper->revokeAccessToken();
}

$access_token = $accessToken->getToken();
$dropbox->setAccessToken($access_token);


$store = $db->prepare("
	UPDATE users 
	SET dropbox_token = :dropbox_token
	WHERE id = :user_id
");

$store->execute([
	'dropbox_token' => $access_token,
	'user_id' => $_SESSION['user_id']
]);
//var_dump($user);

if($user->dropbox_token)
{
	$accountId = $accessToken->account_id;
	$account = $dropbox->getAccount($accountId);
	//var_dump($account);
}



/*
?>
<br />
<br />
<?php
var_dump($access_token);
?>
<br />
<br />
<?php
var_dump($dropbox);
*/

$file = $dropbox->getMetadata("/dropbox_logo.png");
//var_dump($file);

$listFolderContents = $dropbox->listFolder("/");
$items = $listFolderContents->getItems();
$filesList = $items->all();


$firstFile = $items->first();
//var_dump($firstFile->name);
//var_dump($firstFile);


echo '
<div class="col-8">
	<h1>Welcome '.$account->getDisplayName().'</h1>
	<br />
	<h4>Your files:</h4>
	';
	foreach($filesList as $key)
	{
		echo '
		<div class="col-10">
			<h6>'.$key->name.', '.$key->size.' kB</h6>
		</div>
		';
	}'
</div>
';

//var_dump($filesList);

//header('Location: login_finish.php');

require_once '../partials/footer.php';


//var_dump($dropbox->getAccessToken());


/*
var_dump($dropbox);
?>
<br />
<br />
<?php
$access_token = $accessToken->getToken();
var_dump($access_token);
?>
<br />
<br />
<?php
//var_dump($dropbox);

//var_dump($access_token);
$dropbox->setAccessToken($access_token);
$accountId = $accessToken->account_id;

//var_dump($accountId);
//$account = $dropbox->getCurrentAccount();
$account = $dropbox->getAccount($accountId);
var_dump($account);
?>
<br />
<br />
<?php
//$listFolderContents = $dropbox->listFolder("/");
//var_dump($listFolderContents);

var_dump($dropbox->getAccessToken());
*/



/*
$store = $db->prepare("
	UPDATE users 
	SET dropbox_token = :dropbox_token
	WHERE id = :user_id
");

$store->execute([
	'dropbox_token' => $access_token,
	'user_id' => $_SESSION['user_id']
]);

var_dump($user);

//header('Location: login_finish.php');

*/

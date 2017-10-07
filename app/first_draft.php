<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once './vendor/autoload.php';
foreach (glob("./Dropbox/*.php") as $filename)
{
    include $filename;
}
foreach (glob("./Dropbox/Authentication/*.php") as $filename)
{
    include $filename;
}

session_start();
$_SESSION['user_id'] = 1;

$db = new PDO('mysql:host=mysql9.ilait.se;dbname=dws117393', 'udmyws238373', '2W.qoaf');

//user details
$user = $db->prepare("SELECT * FROM users WHERE id = :user_id");
$user->execute(['user_id' => $_SESSION['user_id']]);
$user = $user->fetchObject();

//var_dump($user);
var_dump($user->id);


use Kunnu\Dropbox\DropboxApp;
$client_id = '82eilpyl3hg1dx8';
$client_secret = 'eym85juf53qf2l5';
$access_token = '7Gnxj4Pse0AAAAAAAAAATTwTwUy6KN6vHJkVeoSi4pXNb-HbFYqa7u3jkasQ3tzv';
$app = new DropboxApp($client_id, $client_secret, $user->dropbox_token);
use Kunnu\Dropbox\Dropbox;
$dropbox = new Dropbox($app);

$db = new PDO('mysql:host=mysql9.ilait.se;dbname=dws117393', 'udmyws238373', '2W.qoaf');

//user details
$user = $db->prepare("SELECT * FROM users WHERE id = :user_id");
$user->execute(['user_id' => $_SESSION['user_id']]);
$user = $user->fetchObject();

//var_dump($user);
//var_dump($user->id);


var_dump($app); ?>
<br />
<br />
<?php var_dump($dropbox);
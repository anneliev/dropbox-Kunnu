<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
$_SESSION['user_id'] = 1;

require './../vendor/autoload.php';
foreach (glob("./Dropbox/*.php") as $filename)
{
    include $filename;
}
foreach (glob("./Dropbox/Authentication/*.php") as $filename)
{
    include $filename;
}


use Kunnu\Dropbox\Dropbox;
use Kunnu\Dropbox\DropboxApp;

$client_id = '82eilpyl3hg1dx8';
$client_secret = 'eym85juf53qf2l5';
$access_tokenStatic = '7Gnxj4Pse0AAAAAAAAAAsgDHVeuhfSToDnbhw13HokFWvOERgAV1KEl-UQmT8IW3';
//Configure Dropbox Application
$app = new DropboxApp($client_id, $client_secret, $access_tokenStatic);

//Configure Dropbox service
$dropbox = new Dropbox($app);

//DropboxAuthHelper
$authHelper = $dropbox->getAuthHelper();

//Callback URL
$callbackUrl = "https://test.testserver.se/app/login_callback.php";



$db = new PDO('mysql:host=mysql9.ilait.se;dbname=dws117393', 'udmyws238373', '2W.qoaf');

//user details
$user = $db->prepare("SELECT * FROM users WHERE id = :user_id");
$user->execute(['user_id' => $_SESSION['user_id']]);
$user = $user->fetchObject();

//var_dump($user);


<?php
require_once 'start.php';
require_once './../partials/header.php';

//Fetch the Authorization/Login URL
$authUrl = $authHelper->getAuthUrl($callbackUrl);

echo 
'
	<div class="container">
		<div class="row">
			<div class="col-3">
			</div>
			<div class="col-2">
				<br />
				<img height="60em" width="60em" src="./images/dropbox_logo.png" />
			</div>
			<div class="col-4">
				<br />
				<button class="btn btn-outline-primary btn-lg">
					<a href="' . $authUrl . '">Dropbox SignIn</a>
				</button>
			</div>
			<div class="col-3">
			</div>
		</div>
	</div>
';


require_once './../partials/footer.php';
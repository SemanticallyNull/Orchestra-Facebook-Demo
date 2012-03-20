<?php
require_once("lib/facebook.php");

// You need to configure these. Get info from: https://developers.facebook.com/apps/
$fb_config = array(
					'appId' => '179983022118900',
					'secret' => '2e9bbd94722e7cd9a2886e326437efc9',
					// On Orchestra fileUpload will almost always be false. 
					// See http://docs.orchestra.io/kb/system-constraints/system-constraints#file-uploads-hosting
					'fileUpload' => false, 
				);
$facebook = new Facebook($fb_config);

if($facebook->getUser() !== 0) { // If the user is logged in
	try {
		$user_data = $facebook->api('/me','GET');
		$friends = $facebook->api('/me/friends','GET');
	} catch(FacebookApiException $e) {
		// Facebook may give you a user ID even if the user is logged
		// out. You'll need to make them login again.
		echo '<script type="text/javascipt"> top.location.href = "' . $facebook->getLoginUrl() . '" </script>'; // Redirect the user to the login page.
	}
} else { // If the user is not logged in
	echo '<script type="text/javascipt"> top.location.href = "' . $facebook->getLoginUrl() . '" </script>'; // Redirect the user to the login page.
}

?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="assets/style.css" />		
	</head>
	<body>
		<div id="outer_container">
			<div id="header">
				<img id="logo" src="assets/orchestra.png" title="Orchestra" alt="Orchestra">
			</div>
			<div id="intro">
				<h1>Hi <?=$user_data['name']?>,</h1>
				<p>Welcome to Orchestra's demo Facebook app! We're just going to show you a grid of your friends!</p>
			</div>
			<div id="facetiles">
				<?php foreach($friends as $friend) {
					echo '<a href="http://facebook.com/profile.php?id='.$friend->id.'" title="'.$friend->name.'"><img src="http://graph.facebook.com/'.$friend->id.'/picture" alt="'.$friend->name.'"></a>';
				} ?>
			</div>
		</div>
	</body>
</html>
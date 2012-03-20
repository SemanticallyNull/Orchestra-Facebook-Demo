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
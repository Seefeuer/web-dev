<?php
ob_start();
phpinfo();
$pinfo = ob_get_contents();
ob_end_clean();
$pinfo	= preg_replace( "@^.*<body>(.+)</body>.*$@s", "\\1", $pinfo );
$pinfo	= preg_replace( "@<table.+</table>@sU", '', $pinfo, 1 );
$pinfo	= preg_replace( "@<table@", '<table class="table"', $pinfo );
print '
<html>
	<head>
		<title>Seefeuer Web Dev</title>
		<link rel="stylesheet" href="https://cdn.ceusmedia.de/css/bootstrap.min.css"></link>
		<style>
* {
	font-size: 13px;
	}
.hero-unit {
	margin: 0;
	padding: 2em;
	}
.hero-unit h1 {
	font-weight: 100;
	}
</style>
	</head>
	<body>
		<div class="container" style="margin-top: 1rem">
			<div class="hero-unit">
				<div style="display: flex">
					<div style="flex: 1 1; text-align: center">
						<img src="https://seefeuer.net/wp-content/themes/seefeuer/library/images/seefeuer-logo-rot.svg" style="width: 180px"/>
					</div>
					<div style="flex: 2 2">
						<h1>Web Dev</h1>
					</div>
				</div>
			</div>
			<br/>
			<h3>Service Information</h3>
			'.$pinfo.'
		</div>
	</body>
</html>';

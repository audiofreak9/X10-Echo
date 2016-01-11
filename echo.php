<?php
$hvar = "heyu -c /home/pi/.heyu/x10config ";
$echo = "Error: No variables!";
if ((isset($_GET['action'])) && (isset($_GET['hu']))) {
	$echo = "Echo! ";
	if ((isset($_GET['percent'])) && (is_numeric($_GET['percent'])) && ($_GET['percent'] >= 1)) {
		$level = ceil(22 - (22 / 100 * $_GET['percent']));
		if ($level == 0) $level = 1; //Prevents an obdim of 0
		$command = $hvar . "obdim " . $_GET['hu']. " " . $level;
	}else{
		$command = $hvar . $_GET['action'] . " " . $_GET['hu'];
	}
	exec($command." > /dev/null 2>/dev/null &");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Echo!</title>
</head>
<body>
<div><?php echo $echo . $command; ?></div>
</body>
</html>

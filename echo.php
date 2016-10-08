<?php
extract($_GET);
$command = "heyu -c /home/pi/.heyu/x10config ";
$echo = "Error: House Unit not set!";
if (!$action) $action = "off";
if (isset($hu)) {
	$echo = "Echo -> X10!";
	if ((isset($percent)) && (is_numeric($percent)) && ($percent >= 1)) {
		$level = ceil(22 - (22 / 100 * $percent)) == 0 ? 1 : ceil(22 - (22 / 100 * $percent));
		$command .= "obdim " . $hu . " " . $level;
	}else{
		$command .= $action . " " . $hu;
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
<div><?php echo $echo . "<br />" . $command; ?></div>
</body>
</html>

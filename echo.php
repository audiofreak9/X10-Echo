<?php
$hvar = "heyu -c /home/pi/.heyu/x10config ";
$echo = "Error: No variables!";
extract($_GET);
if ((isset($action)) && (isset($hu))) {
	$echo = "Echo! ";
	if ((isset($percent)) && (is_numeric($percent)) && ($percent >= 1)) {
		$level = ceil(22 - (22 / 100 * $percent));
		if ($level == 0) $level = 1; //Prevents an obdim of 0
		$command = $hvar . "obdim " . $hu . " " . $level;
	}else{
		$command = $hvar . $action . " " . $hu;
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

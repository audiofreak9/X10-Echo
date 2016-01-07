<?php
$echo = "Error: No variables!";
if ((isset($_GET['action'])) && (isset($_GET['hu']))) {
	$echo = "Echo! ";
	$command = "heyu -c /home/pi/.heyu/x10config " . $_GET['action'] . " " . $_GET['hu'];
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

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0, maximum-scale=1.0" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<link href="images/startup.png" media="(device-width: 320px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image">
<link rel="apple-touch-icon" href="images/x10switch_icon.png"/>
<title>X10 Bridge Control</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap-responsive.css">
<link rel="stylesheet" href="css/bootstrap-theme.min.css">
<style>
body{margin:0;padding:10px 0 0 0}
</style>
</head>
<body>
<div class="container container-fluid" role="main">
        <div class="row">
                <div class="col-md-6">
                        <div class="panel panel-default">
                                <div class="panel-heading">Devices</div>
                                <div class="panel-body">
<?php
$SN = $_SERVER['SERVER_NAME'];
$ha_devices = json_decode(file_get_contents("http://$SN:8080/api/devices"), true);
//for ($x = 0; $x <= count($ha_devices) - 1; $x++) if (strpos($ha_devices[$x]["onUrl"],"echo.php") > 0) $ha_vals[] = $x;
for ($x = 0; $x <= count($ha_devices) - 1; $x++) $ha_vals[] = $x;
$halfval = ceil(count($ha_vals) / 2);
foreach ($ha_vals as $ha_val) {
        $find = array("http:","localhost","/",$SN,"echo.php?","action", "=", "off", "on","&","hu","percent", "$","{","intensity",".","percent","}");
        $HU = str_replace($find, "", $ha_devices[$ha_val]["onUrl"]);
        $dev_level = round(($ha_devices[$ha_val]["deviceSetValue"] / 255)*100);
?>
                                        <form class="form-inline" id="<?php echo $ha_devices[$ha_val]["id"]; ?>" method="post">
                                        <input type="hidden" name="hu" value="<?php echo $HU; ?>" />
                                        <button type="submit" class="btn btn-sm1 btn-success" name="action" value="on">On</button>
                                        <button type="submit" class="btn btn-sm1 btn-danger" name="action" value="off">Off</button>
<?php
        if (strpos($ha_devices[$ha_val]["onUrl"],"percent") > 0) {
                for ($x = 30; $x < 100; $x+=10) {
?>
                                        <button type="submit" class="btn btn-sm1 btn-default" name="action" value="<?php echo $x; ?>"><?php echo $x; ?></button>
<?php
                }
        }
?>
                                        </form>
                                        <div style="margin-top:4px">
                                                <div class="col-xs-3 label label-info"><?php echo ucwords($ha_devices[$ha_val]["name"]); ?></div>
                                                <div class="col-xs-9">
                                                        <div class="progress">
                                                                <div class="progress-bar progress-bar-success" id="prog<?php echo $ha_devices[$ha_val]["id"]; ?>" role="progressbar" aria-valuenow="<?php echo $dev_level; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $dev_level; ?>%">
                                                                        <?php echo ' ' . $dev_level . '% '; ?>
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>
<?php
        $count++;
        if ($count == $halfval) {
?>
                                </div>
                        </div>
                </div>
                <div class="col-md-6">
                        <div class="panel panel-default">
                                <div class="panel-heading">Devices</div>
                                <div class="panel-body">
<?php
        }
}
?>
                                </div>
                        </div>
                </div>
        </div>
</div>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js?ver=CDN"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script>
$(".btn").click(function() {
  var dev_id = $(this).closest("form").attr('id');
  var dev_val = $(this).attr('value');
  var data = '{"on":';
  if(dev_val == "off") {
    percent = 0;
    data += 'false';
  }else{
    percent = 100;
    data += 'true';
  }
  if(isNumeric(dev_val)){
    percent = dev_val;
    data += ', "bri":' + Math.round(2.55 * dev_val);
  }
  data += '}';
  $.ajax({
    type: 'POST',
    dataType: 'json',
    url: 'http://<?php echo $SN; ?>:8080/api/c/lights/' + dev_id + '/state',
    headers: {"X-HTTP-Method-Override": "PUT"},
    data: data,
    success : updateProgress(percent, dev_id)
  });
  return false;
});
function isNumeric(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}
function updateProgress(percent, dev_id){
    if(percent > 100) percent = 100;
    $('#prog' + dev_id).css('width', percent+'%');
    $('#prog' + dev_id).html(percent+'%');
}
</script>
</body>
</html>

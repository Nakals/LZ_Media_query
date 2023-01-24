<?php
require_once("../etc/config.php");
require_once(APP_ROOT."/Class/queryAPI.php");
$query = new Query();
$result=$query->create($_POST["name"],$_POST["surname"]);
echo $result;
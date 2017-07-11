<?php
$userName = "";
if (isset($_POST['lastName'])) {
	$userName = $_POST['lastName'];
}
echo "Hello! " . $userName;
?>
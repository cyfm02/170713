<?php
$data= "";
if (!isset($_POST["data"])) {
	exit();
}
$data = "Data: " . $_POST['data'];
$requestTime = "RequestTime: " . $_POST["requestTime"];

sleep(rand(0, 3));

$f = fopen("data.txt", "a");
fputs($f, Date("Y-m-d H:i:s") . "\r\n", 21);
fputs($f, $requestTime . "\r\n", strlen($requestTime) + 2);
fputs($f, $data . "\r\n", strlen($data) + 2);
fputs($f, "--\r\n", 4);
fclose($f);

?>
<?php
$postData = array (
		'firstName' => 'Wolfgang',
		'lastName' => 'Chien' 
);

$url = $_SERVER ["SERVER_NAME"] . $_SERVER ["REQUEST_URI"];
$url = "https://" . str_replace ( "From.php", "To.php", $url );

$dataBack = doHttpRequest ( $url, $postData );
echo "<pre>";
echo $dataBack;
echo "</pre>";


function doHttpRequest($url, $params, $is_getResponse = true) {
	$result = "";
	foreach ( $params as $key => &$val ) {
		if (is_array ( $val ))
			$val = implode ( ',', $val );
		$post_params [] = $key . '=' . urlencode ( $val );
	}
	$post_string = implode ( '&', $post_params );
	$parts = parse_url ( $url );
	
	$fp = fsockopen ( $parts ['host'], isset ( $parts ['port'] ) ? $parts ['port'] : 80, $errno, $errstr, 30 );
	$out = "POST " . $parts ['path'] . " HTTP/1.1\r\n";
	$out .= "Host: " . $parts ['host'] . "\r\n";
	$out .= "Content-Type: application/x-www-form-urlencoded\r\n";
	$out .= "Content-Length: " . strlen ( $post_string ) . "\r\n";
	$out .= "Connection: Close\r\n\r\n";
	
	if (isset ( $post_string ))
		$out .= $post_string;
	fwrite ( $fp, $out );
	if ($is_getResponse) {
		while ( ! feof ( $fp ) ) {
			$result .= fgets ( $fp, 1024 );
		}
	}
	fclose ( $fp );
	return $result;
}


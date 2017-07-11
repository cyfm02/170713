<?php

// header("Access-Control-Allow-Origin: *");

if (! isset ( $_GET ["id"] ))
	die ( "Parameter id not found." );

$id = $_GET ["id"];
if (! is_numeric ( $id ))
	die ( "id not a number." );

require ("config.php");
$link = mysqli_connect ( $dbhost, $dbuser, $dbpass ) or die ( mysql_error () );
$result = mysqli_query ( $link, "set names utf8" );
mysqli_select_db ( $link, $dbname );
$commandText = <<<SqlQuery
select ProductID, ProductName, UnitsInStock  
  from products
  where ProductID = $id
SqlQuery;

$result = mysqli_query ( $link, $commandText );
$row = mysqli_fetch_assoc ( $result );

echo json_encode($row);

mysqli_close ( $link );
?>

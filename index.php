<?php 
include_once("includes/mysql_connect.php");

$parameters = $_GET;

$query = "SELECT * FROM shops WHERE shop_url='". $parameters['shop'] ."' LIMIT 1";
$result = $mysql->query($query);

if( $result->num_rows < 1 ){
    header("Location: install.php?shop=" . $_GET['shop']);
    exit();
}

$store_data = $result->fetch_assoc();

echo print_r($store_data);

echo "Araf will be wealthy in very short time.";
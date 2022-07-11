<?php
require("../db-connect.php");
if(!isset($_POST["name"])){
    echo "沒有帶資料到本頁";
    exit;
}

$name=$_POST["name"];
$img=$_POST["img"];
$buyer=$_POST["buyer"];
$receiver=$_POST["receiver"];
$status=$_POST["status"];
$price=$_POST["price"];
$amount=$_POST["amount"];
$now=date('Y-m-d H:i:s');

$sql="INSERT INTO user_order_detail (name, img, buyer, receiver, status, price, amount, valid) VALUES ('$name', '$img', '$buyer', '$receiver','$status','$price','$amount', 1)";

if ($conn->query($sql) === TRUE) {
    echo "新資料輸入成功";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header("location: create-user.php");

?>
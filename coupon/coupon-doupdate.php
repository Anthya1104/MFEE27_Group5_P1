<?php
if(!isset($_POST["Coupon_name"])){
    echo "沒有帶資料";
    exit;
}
require("../db-connect.php");

$id=$_POST["id"];
$Coupon_name=$_POST["Coupon_name"];
$Coupon_code=$_POST["Coupon_code"];
$Coupon_sdte=$_POST["Coupon_sdte"];
$Coupon_edte=$_POST["Coupon_edte"];
$Coupon_discount=$_POST["Coupon_discount"];

$sql="UPDATE marketing SET Coupon_name='$Coupon_name', Coupon_code='$Coupon_code', Coupon_sdte='$Coupon_sdte', Coupon_edte='$Coupon_edte', Coupon_discount='$Coupon_discount' WHERE id=$id";
// echo $sql;


if ($conn->query($sql) === TRUE) {
    echo "資料表 marketing 修改完成";
} else {
    echo "修改資料表錯誤: " . $conn->error;
}

$conn->close();

header("location: coupon-edit.php?id=".$id);


?>
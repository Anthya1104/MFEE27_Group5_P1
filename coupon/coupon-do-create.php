<?php
require("../db-connect.php");
if(!isset($_POST["Coupon_name"])){
    echo "沒有帶資料到本頁";
    exit;
}

$Coupon_name = $_POST["Coupon_name"];
$Coupon_code = $_POST["Coupon_code"];
$Coupon_sdte = $_POST["Coupon_sdte"];
$Coupon_edte = $_POST["Coupon_edte"];
$Coupon_discount = $_POST["Coupon_discount"];
//$now=date('Y-m-d H:i:s');
//echo $now;
//exit;

//echo "$Coupon_name, $Coupon_code, $Coupon_sdte, $Coupon_edte, $Coupon_discount";
$sql="INSERT INTO marketing (Coupon_name, Coupon_code, Coupon_sdte, Coupon_edte, Coupon_discount, valid) VALUES ('$Coupon_name', '$Coupon_code', '$Coupon_sdte', '$Coupon_edte', '$Coupon_discount', 1)";

if ($conn->query($sql) === TRUE) {
    echo "新資料輸入成功";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
// header("location: coupon-form-get.php");
header("location: coupon-list.php")

?>
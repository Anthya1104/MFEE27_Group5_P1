<?php
if(!isset($_POST["id"])){
    echo "沒有帶資料";
    exit;
}
require("../db-connect.php");



$id = $_POST["id"];
$status = $_POST["status"];

$sql="UPDATE user_order SET status = '$status' where id = '$id' ";


if ($conn->query($sql) === TRUE) {
    echo "訂單修改完成";
} else {
    echo "修改訂單錯誤: " . $conn->error;
}

$conn->close();

header("location: user_order.php?id=".$id);
?>
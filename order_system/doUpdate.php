<?php
if(!isset($_POST["id"])){
    echo "沒有帶資料";
    exit;
}
require("db-connect.php");

$id = $_POST["id"];
$status = $_POST["status"];

switch ($status) {
    case 1:
      $statusType = "尚未付款";
      break;
    case 2:
      $statusType = "已付款";
      break;
    case 3:
      $statusType = "訂單完成";
      break;
    default:
      $statusType = "尚未付款";
    }

$sql="UPDATE user_order SET status = '$statusType' where id = '$id' ";


if ($conn->query($sql) === TRUE) {
    echo "訂單修改完成";
} else {
    echo "修改訂單錯誤: " . $conn->error;
}

$conn->close();

header("location: user_order.php");
?>
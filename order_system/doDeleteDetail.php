<?php
require("db-connect.php");

$id=$_GET["id"];

$sql="UPDATE user_order_detail SET valid=0 WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    echo "訂單刪除成功";
} else {
    echo "刪除訂單錯誤: " . $conn->error;
}
header("location: order_detail.php?id=".$id);

?>
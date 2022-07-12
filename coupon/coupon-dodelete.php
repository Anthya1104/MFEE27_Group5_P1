<?php
require("../db-connect.php");

$id=$_GET["id"];

//delete
$sql="DELETE FROM marketing WHERE id='$id'";

//update to valid 0
//soft delete
$sql="UPDATE marketing SET valid=0 WHERE id='$id'";

// echo $sql;
if ($conn->query($sql) === TRUE) {
    echo "刪除成功";
} else {
    echo "刪除資料錯誤: " . $conn->error;
}
header("location: coupon-list.php");
?>
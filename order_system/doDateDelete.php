<?php
require("../db-connect.php");

$id=$_GET["id"];

$sql="UPDATE user_order SET valid=0 WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    echo "訂單刪除成功";
} else {
    echo "刪除訂單錯誤: " . $conn->error;
}
header("location: do-date-select.php?from_date=2022-07-12&to_date=2022-07-13");

?>
<?php
require("../db-connect.php");

$sql="UPDATE marketing SET WHERE";

if($conn->query($sql) === TRUE) {
    echo "資料表 marketing 修改完成";
}else {
    echo "資料表修改錯誤: " . $conn->error;
}
$conn->close();
?>
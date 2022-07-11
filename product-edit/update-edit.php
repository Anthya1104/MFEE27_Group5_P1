<?php

require("db-connect.php");

$sql="UPDATE product SET book_name ='$book_name' WHERE id='' " ;

if ($conn->query($sql) === TRUE) {
    echo "商品修改完成";
}else {
    echo "商品修改失敗" . $conn->error;
}

$conn->close();


?>
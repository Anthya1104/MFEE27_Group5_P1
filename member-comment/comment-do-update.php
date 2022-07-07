<?php
if(!isset($_POST["id"])){
    echo "沒有帶資料";
    exit;
}

require("../db-connect.php");

//以下指向user-edt 各欄的name value
$id=$_POST["id"];
$content=$_POST["comments"];
// echo $name;

//以下修改資料庫中的欄位
$sql="UPDATE comment SET content='$content' WHERE id=$id";
// echo $sql;

if ($conn->query($sql) === TRUE) {
    echo "資料表 users 修改完成";
} else {
    echo "修改資料表錯誤: " . $conn->error;
}

$conn->close();

header("location:comment-edit.php?id=".$id);

?>
<?php
session_start();
require("../db-connect.php");

$id=$_GET["id"];
// $_SESSION["deleteAlert"]=0;
    



//很少真的做刪除 容易造成資料庫出問題 e.g. id編號空掉 刪除後資料無法回復
// $sql="DELETE FROM users WHERE id='$id'";

//update to valid 0  軟刪除




$sql="UPDATE comment SET comment_valid=0 WHERE id='$id'";
// echo $sql;

if($conn ->query($sql) === TRUE){
    echo "刪除成功";
    // $_SESSION["deleteAlert"]=1;
}else{
    echo "刪除資料錯誤" . $conn ->error;
}

header("location: comment-list.php");
?>
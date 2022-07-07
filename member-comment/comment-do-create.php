<?php
require("../db-connect.php");
//前端檢查
if(!isset($_POST["comments"])){
    echo "沒有帶資料到本頁";
    exit;
}

$member_id=$_POST["member_id"];
$book_id=$_POST["book_id"];
$content=$_POST["comments"];
$now=date('Y-m-d H:i:s');

// echo $now."<br>".$member_id."<br>".$book_id."<br>".$content;


if(empty($content)){
    echo "請輸入留言內容";
    exit;
}else{
    $sql="INSERT INTO comment (product_id, user_id, content, create_time, comment_valid) VALUES ('$book_id','$member_id','$content', '$now', 1)";

    if ($conn->query($sql) === TRUE) { //query(只query一次$sql語法) 單純判斷型別有沒有存在在資料庫裡
        echo "新增資料輸入成功";
    } else {
        echo "ERROR:: " .$sql."<br>". $conn->error;
    }

    $conn ->close();
    header("location: input-comment.php");//新增完資料後回到creat-user.php

}



?>
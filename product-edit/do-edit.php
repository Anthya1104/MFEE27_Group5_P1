<?php


if(!isset($_POST["book_name"])){
    echo "沒有帶資料到本頁";
    exit;
}

// if(empty($book_name)){
//     echo "請填寫資料";
//     exit;
// }

require("../db-connect.php");

$id=$_POST["id"];
$book_name=$_POST["book_name"];
$book_category=$_POST["book_category"];
$author=$_POST["author"];
$publisher=$_POST["publisher"];
$publication_date=$_POST["publication_date"];
$language=$_POST["language"];
$book_details=$_POST["book_details"];
$price=$_POST["price"];
$status=$_POST["status"];
$upload_time=$_POST["upload_time"];
// $book_img=$_POST["book_img"];
if($_POST["book_img"] == ""){
    $book_img=$_POST["original"];
}else{
    $book_img=$_POST["book_img"];
};
$valid=$_POST["valid"];
$now=date('Y-m-d H:i:s');



$sql="UPDATE product SET book_name ='$book_name', book_category = '$book_category', author = '$author', publisher = '$publisher', publication_date = '$publication_date', language = '$language' , book_details = '$book_details', price = '$price', status = '$status', book_img = '$book_img' WHERE id=$id" ;
echo $sql;

if ($conn->query($sql) === TRUE) {
    echo "修改完成";
}else {
    echo "修改失敗"  . $conn->error;
}

$conn->close();
header("location: ../product-create/product-list.php");



?>
<?php
require("../db-connect.php");

if(!isset($_GET["search"]) || empty($_GET["search"])){
  $search="";
  $countAll = 0;
}else{
  //搜尋功能建議使用GET(相較於POST)
  $search=$_GET["search"];
  // $sql="SELECT id, account, userName, email, phone FROM users WHERE account = '$search'";//完全比對:完全符合條件

  if(isset($_GET["page"])){
    $page = $_GET["page"];
}else{
    $page = 1;
}

$perPage = 4;
$start = ($page - 1) * $perPage;


  $sql="SELECT comment.*, product.book_img, product.book_name, member.user_name
  FROM comment
  JOIN product ON comment.product_id =product.id
  JOIN member ON comment.user_id =member.id
  WHERE comment.comment_valid=1
  LIKE '%$search%'
  LIMIT $start, 4
  ";

  $result = $conn ->query($sql);
  $countAll = $result ->num_rows;
}

  header("../member-comment/comment-list.php");
?>

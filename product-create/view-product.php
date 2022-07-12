<?php

if(!isset($_GET["id"])){
    echo "沒有參數";
    exit;
}

$id=$_GET["id"];

require("../db-connect.php");
// 原本
// $sql="SELECT * FROM product WHERE id=$id";

// $result= $conn->query($sql);
// $productCount=$result->num_rows;
// 原本

// // JOIN-------------------------

$sql="SELECT product.*, category.category_name AS category__name FROM product
JOIN category ON product.book_category = category.category_id WHERE product.id=$id AND valid=1 ";

// $sql="SELECT product.*, factory_title, category.category_name AS category__name FROM product
// JOIN category ON product.book_category = category.category_id 
// LEFT JOIN factory ON factory.factory_id = product.factory_id
// WHERE product.id=$id AND valid=1 ";

$result = $conn->query($sql);
$productCount=$result->num_rows;
// $row = $result->fetch_all(MYSQLI_ASSOC);
// -------------------------

?>


<!doctype html>
<html lang="en">
  <head>
    <title>view product</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"  integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <style>

        
        .object-cover {
            width: 300px;
            height: 400px;
            object-fit: cover;
        }
 
        .btn-info {
            background: #18d3e0;
        }

    </style>
  </head>
  <body>
      <div class="container-fluid">
        <!-- 包sidebar -->
        <div class="row">
            <div class="col-3">
                <?php require("../side-nav.php"); ?>
            </div>
            <div class="col-9">
        <!-- 包sidebar -->
        <?php if($productCount>0){
        $row=$result->fetch_assoc();
        }
        ?>
        <h1 class="mt-4">商品詳細資訊</h1>

<!-- ---------------------- -->
<table class="table table-bordered border-dark">
<!-- <thead>
<tr>
<th scope="col"></th>
<th scope="col"></th>
</tr>
</thead> -->
<tbody >
<tr>
<th class="col-2">產品編號</th>
<td> <?=$row["book_sn"]?> </td>
</tr>
<tr>
<th scope="row">產品名稱</th>
<td> <?=$row["book_name"]?> </td>
</tr>
<tr>
<th scope="row">類型</th>
<td ><?=$row["category__name"]?></td>
</tr>
<tr>
<th scope="row">作者</th>
<td ><?=$row["author"]?> </td>
</tr>
<th scope="row">出版社</th>
<td> <?=$row["publisher"]?>  </td>
</tr>
<tr>
<th scope="row">出版日期</th>
<td> <?=$row["publication_date"]?>  </td>
</tr>
<tr>
<th scope="row">語言</th>
<td> <?=$row["language"]?>  </td>
</tr>
<tr>
<th scope="row">內容簡介</th>
<td> <?=$row["book_details"]?>  </td>
</tr>
<tr>
<th scope="row">定價</th>
<td> <?=$row["price"]?>  </td>
</tr>
<tr>
<th scope="row">上下架狀態</th>
<td> <?=$row["status"]?>  </td>
</tr>
<tr>
<th scope="row">上架時間</th>
<td> <?=$row["upload_time"]?>  </td>
</tr>
<tr>
<th scope="row">封面圖</th>
<td> <img class="object-cover" src="image/<?=$row["book_img"]?>" alt=""> </td>
</tr>
</tbody>
</table>
        <div class="mb-3">
            <a class="btn btn-dark" type="submit" href="product-list.php">返回</a>
        </div>
    </div>
    </div>
  </body>
</html>
<?php
require("../db-connect.php");

if(!isset($_GET["search"])){
  $search="";
  $productCount=0;
}else{
  // $search=$_GET["search"];
  // $sql="SELECT book_sn, book_name, book_category,price, status, upload_time FROM product WHERE book_sn LIKE '%$search%'";
  // $result = $conn->query($sql);
  // $productCount=$result->num_rows;
  // $rows = $result->fetch_all(MYSQLI_ASSOC);

  $search=$_GET["search"];
  $sql="SELECT product.*, category.category_name AS category__name FROM product 
  JOIN category ON product.book_category = category.category_id WHERE book_sn LIKE '%$search%' AND valid=1";
  $result = $conn->query($sql);
  $productCount=$result->num_rows;
  $rows = $result->fetch_all(MYSQLI_ASSOC);
  
}


?>


<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"  integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <style>
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
        <!-- <?=$search?> -->
        <div class="py-2">
          <h2> <?=$search?> 的搜尋結果 </h2>
          <div class="py-2">共 <?=$productCount?> 筆資料</div>
        <a class="btn btn-info" type="submit" href="../product-create/product-list.php">返回</a>
        </div>
        <div class="py-2">
            <form action="search-productsn.php" method="get">
            <div class="input-group">
                <span class=" d-flex align-items-center"></span>
                <input type="text" class="form-control rounded-start" name="search" placeholder="依產品編號搜尋">
                <button class="btn btn-info" > <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg></button>  
            </form>
            </div>
        </div>
        <?php if($productCount>0): ?>
          <table class="table table-bordered">
          <thead>
                <tr>
                    <th>產品編號</th>
                    <th>產品名稱</th>
                    <!-- <th>封面圖</th> -->
                    <th>類型</th>
                    <th>定價</th>
                    <th>上架狀態</th>
                    <th>上架時間</th>
                </tr>
            <tbody>
                <?php foreach ($rows as $row) : ?>
                    <tr>
                        <td><?=$row["book_sn"]?></td>
                        <td><?=$row["book_name"]?></td>
                        <!-- <td> -->
                        <!-- <?=$row["book_img"]?> -->
                        <!-- <img class="img-size" src="image/<?=$row["book_img"]?>" alt=""> -->
                        <!-- </td> -->
          
                        <td>  <?=$row["book_category"]?>  <?=$row["category__name"]?></td>
                        <td><?=$row["price"]?></td>
                        <td><?=$row["status"]?></td>
                        <td><?=$row["upload_time"]?></td>
                        
                    </tr>
                <?php endforeach; ?>
            </tbody>
            </thead>
            </table>
        <?php else: ?>
          沒有符合條件的結果
        <?php endif; ?>
        </div>
        </div>
     </div>
     
  </body>
</html>
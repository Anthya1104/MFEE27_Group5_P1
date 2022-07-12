<?php
require("../db-connect.php");

if(!isset($_GET["status"])){
  $status="";
  $productCount=0;
}else{

$status=$_GET["status"];


$sql="SELECT product.*, category.category_name AS category__name FROM product
JOIN category ON product.book_category = category.category_id WHERE `status` = $status AND valid=1 ";

// $sql="SELECT product.*, category.category_name AS category__name FROM product
// JOIN category ON product.book_category = category.category_id WHERE valid=1 AND `status` = $status ";

//   $sql="SELECT * FROM `product` WHERE `status` = $status ";
    


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
            <div class="col-3 row">
                <?php require("../side-nav.php"); ?>
            </div>
            <div class="col-9">
        <!-- 包sidebar -->
        <!-- <?=$status?> -->
        <div class="py-2">
          <h2 class="mt-4"> 搜尋結果 </h2>
          <div class="py-2">共 <?=$productCount?> 筆資料</div>
        <a class="btn btn-dark" type="submit" href="../product-create/product-list.php">返回</a>
        </div>
       
        <?php if($productCount>0): ?>
          <table class="table table-bordered border-dark">
          <thead>
                <tr class="table-dark text-center">
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
                        <td class="text-center"><?=$row["book_sn"]?></td>
                        <td><?=$row["book_name"]?></td>
                        <!-- <td> -->
                        <!-- <?=$row["book_img"]?> -->
                        <!-- <img class="img-size" src="image/<?=$row["book_img"]?>" alt=""> -->
                        <!-- </td> -->
          
                        <td class="text-center"><?=$row["book_category"]?>  <?=$row["category__name"]?></td>
                        <td class="text-center"><?=$row["price"]?></td>
                        <td class="text-center"><?=$row["status"]?></td>
                        <td class="text-center"><?=$row["upload_time"]?></td>
                        
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
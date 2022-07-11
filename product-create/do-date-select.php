<?php
require("../db-connect.php");

// $sql="SELECT product.*, category.category_name AS category__name FROM product
// JOIN category ON product.book_category = category.category_id WHERE valid=1 ORDER BY id $orderType LIMIT $start, 5 ";


if(isset($_GET['from_date']) && isset($_GET['to_date'])){
    $from_date = $_GET['from_date'];
    $to_date = $_GET['to_date'];
    // echo $from_date . $to_date;

    $sql = "SELECT product.*, category.category_name AS category__name FROM product
    JOIN category ON product.book_category = category.category_id WHERE valid=1 AND upload_time BETWEEN '$from_date' AND '$to_date' ";

    // $sql = "SELECT * FROM product WHERE valid=1 AND upload_time BETWEEN '$from_date' AND '$to_date' ";
    $result = $conn->query($sql);
    $dateCount=$result->num_rows;
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    // var_dump ($rows);
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
        <h2 class="mt-4" > <?=$from_date ?> ~ <?=$to_date ?> 上架的商品 </h2>
        <a class="btn btn-info my-1" href="product-list.php">返回</a>
  <?php if ($dateCount>0) : ?>
    <table class="table table-bordered border-dark">
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
            <?php foreach ($result as $row) : ?>
            <tr>
                <td><?=$row["book_sn"]?></td>
                <td><?=$row["book_name"]?></td>
                <!-- <td><img class="img-size" src="image/<?=$row["book_img"]?>" alt=""> </td>  -->
                <td><?=$row["book_category"]?> <?=$row["category__name"]?>   </td>
                <td><?=$row["price"]?></td>
                <td><?=$row["status"]?></td>
                <td><?=$row["upload_time"]?></td>
            </tr>
            <?php endforeach; ?>
    </tbody>
    </thead>
            <?php else : ?>
            沒有符合的資料
            <?php endif; ?>
    </table>
    
    </div>
    </div>
    </div>
</html>





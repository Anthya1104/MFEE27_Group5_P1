<?php
require("../db-connect.php");

$sqlAll = "SELECT * FROM user_order WHERE valid=1 AND upload_time BETWEEN '$from_date' AND '$to_date'";
$resultAll = $conn->query($sqlAll);
$userCount = $resultAll->num_rows;

if(isset($_GET['from_date']) && isset($_GET['to_date'])){
    $from_date = $_GET['from_date'];
    $to_date = $_GET['to_date'];

    $sql = "SELECT product.*, category.category_name AS category__name FROM product
    JOIN category ON product.book_category = category.category_id WHERE valid=1 AND upload_time BETWEEN '$from_date' AND '$to_date' ";

    $result = $conn->query($sql);
    $dateCount=$result->num_rows;
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
        <h2> <?=$from_date ?> ~ <?=$to_date ?> 訂單 </h2>
        <a class="btn btn-dark my-1" href="product-list.php">返回</a>
  <?php if ($dateCount>0) : ?>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th class="text-center">訂單編號</th>
          <th class="text-center">總金額</th>
          <th class="text-center">優惠券</th>
          <th class="text-center">訂購人</th>
          <th class="text-center">訂單日期</th>
          <th class="text-center">訂單狀態</th>
          <th class="text-center">操作</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($rows as $row) : ?>
          <tr>
            <td class="text-center"><a href="order_detail.php?id=<?= $row["id"] ?>"><?= $row["id"] ?></a></td>
            </td>
            <td class="text-center "></td>
            <td class="text-center"><?= $row["code"] ?></td>
            <td class="text-center"><?= $row["name"] ?></td>
            <td class="text-center"><?= $row["date"] ?></td>
            <td class="text-center"><?= $row["status"] ?></td>
            <td>
              <a class="btn btn-success" href="order-edit.php?id=<?= $row["id"] ?>">更新狀態</a>
              <a class="btn btn-danger" href="doDelete.php?id=<?= $row["id"] ?>">刪除整筆訂單</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
            <?php else : ?>
            沒有符合的資料
            <?php endif; ?>
    </table>
    
    </div>
    </div>
    </div>
</html>
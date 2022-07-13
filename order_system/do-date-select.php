<?php
require("../db-connect.php");


if (isset($_GET['from_date']) && isset($_GET['to_date'])) {
  $from_date = $_GET['from_date'];
  $to_date = $_GET['to_date'];

  $sql = "SELECT user_order.*, member.name AS u_name , marketing.Coupon_code FROM user_order
    JOIN member ON user_order.user_id = member.id
    JOIN marketing ON user_order.coupon_id = marketing.id
    WHERE date BETWEEN '$from_date' AND '$to_date' ";

  $result = $conn->query($sql);
  $dateCount = $result->num_rows;
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <style>
    .thead-col {
      background-color: #102e2ef8;
    }
  </style>
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
        <h2 class="mt-4"> <?= $from_date ?> ~ <?= $to_date ?> 訂單 </h2>
        <a class="btn btn-dark my-3" href="user_order.php">返回所有訂單列表</a>
        <?php if ($dateCount > 0) : ?>
          <table class="table table-bordered border-dark">
            <thead>
              <tr class="thead-col text-white">
                <th class="text-center">訂單流水號</th>
                <th class="text-center">總金額</th>
                <th class="text-center">優惠券序號</th>
                <th class="text-center">訂購人</th>
                <th class="text-center">訂單編號</th>
                <th class="text-center">訂單日期</th>
                <th class="text-center">訂單狀態</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($result as $row) : ?>
                <tr>
                  <td class="text-center"><?= $row["id"] ?></a></td>
                  </td>
                  <td class="text-center"><?= $row["total"] ?></td>
                  <td class="text-center"><?= $row["Coupon_code"] ?></td>
                  <td class="text-center"><?= $row["u_name"] ?></td>
                  <th class="text-center"><a href="order_detail.php?id=<?= $row["id"] ?>"><?= $row["sn"] ?></th>
                  <td class="text-center"><?= $row["date"] ?></td>
                  <td class="text-center"><?= $row["status"] ?></td>
                <?php endforeach; ?>
                </tr>
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
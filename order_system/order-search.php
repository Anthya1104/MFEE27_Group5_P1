<?php
require("db-connect.php");

if (!isset($_GET["search"])) {
  $search = "";
  $userCount = 0;
} else {
  $search = $_GET["search"];

  $sql = "SELECT user_order.*, users.name, marketing.code 
    FROM user_order
    JOIN users ON user_order.user_id = users.id
    JOIN marketing ON user_order.coupon_id = marketing.id
    WHERE users.name
    LIKE '%$search%'
    ";
  $result = $conn->query($sql);
  $userCount = $result->num_rows;
}



?>
<!doctype html>
<html lang="en">

<head>
  <title>User Search</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.0-beta1 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

</head>

<body>
  <div class="container">
    <div class="py-2">
      <a class="btn btn-info" href="user_order.php">返回訂單列表</a>
    </div>
    <div class="py-2">
      <form class="form-inline" role="search" action="order-search.php" method="get" target="_blank">
        <div class="input-group"> <input name="search" class="form-control" type="text" placeholder="搜尋訂購人">
          <div class="input-group-append">
            <button class="input-group-text" type="submit">搜尋</button>
          </div>
        </div>
      </form>
    </div>
    <div class="py-2">
      <h2><?= $search ?> 的搜尋結果</h2>
      <div class="py-2">共 <?= $userCount ?> 筆資料</div>
    </div>
    <?php if ($userCount > 0) : ?>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th class="text-center">訂單編號</th>
            <th class="text-center">總金額</th>
            <th class="text-center">會員</th>
            <th class="text-center">訂單日期</th>
            <th class="text-center">訂單狀態</th>
            <th class="text-center">刪除整筆訂單</th>
          </tr>
        </thead>
        <tbody>
          <?php
          //把資料轉換成關聯式陣列
          while ($row = $result->fetch_assoc()) : ?>
            <tr>
              <td class="text-center"><?= $row["id"] ?></td>
              <td class="text-center">總價</td>
              <td class="text-center"><?= $row["name"] ?></td>
              <td class="text-center"><?= $row["date"] ?></td>
              <td class="text-center"><?= $row["status"] ?></td>
              <td><a class="btn btn-danger" href="doDelete.php?id=<?= $row["id"] ?>">刪除</a></td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    <?php else : ?>
      沒有符合條件的結果
    <?php endif; ?>
  </div>
</body>

</html>
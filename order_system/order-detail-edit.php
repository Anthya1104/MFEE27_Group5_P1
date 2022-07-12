<?php
if (!isset($_GET["id"])) {
  echo "沒有參數";
  exit;
}
$id = $_GET["id"];

require("../db-connect.php");

$sqlAll = "SELECT * FROM user_order WHERE valid=1";
$resultAll = $conn->query($sqlAll);
$userCount = $resultAll->num_rows;


$sqlWhere = "";

if (isset($_GET["product_id"])) {
  $product_id = $_GET["product_id"];
  $sqlWhere = "WHERE user_order.product_id = $product_id";

  $sqlProduct = "SELECT name FROM product WHERE id=  $product_id";
  $resultProduct = $conn->query($sqlProduct);
  $rowProduct = $resultProduct->fetch_assoc();
}

$sql = "SELECT user_order_detail.*, product.book_name AS p_name, product.price, product.book_img, user_order.user_id, user_order.date, member.name AS u_name
FROM user_order_detail
JOIN member ON user_order_detail.user_id = member.id
JOIN product ON user_order_detail.product_id = product.id
JOIN user_order ON user_order_detail.order_id = user_order.id
WHERE order_id=$id
AND user_order_detail.valid=1
 ";

$result = $conn->query($sql);
$userCount = $result->num_rows;

$sqlUser = "SELECT user_order_detail.*, member.name AS u_name
FROM user_order_detail
JOIN member on user_order_detail.user_id=member.id
WHERE order_id=$id
";
$resultUser = $conn->query($sqlUser);
$rowsUser = $resultUser->fetch_assoc();

$sqlDate = "SELECT user_order_detail.*, user_order.date
FROM user_order_detail
JOIN user_order ON user_order_detail.order_id = user_order.id
WHERE order_id=$id
";
$resultDate = $conn->query($sqlDate);
$rowsDate = $resultDate->fetch_assoc();

$sqlStatus = "SELECT user_order_detail.*, user_order.status
FROM user_order_detail
JOIN user_order ON user_order_detail.order_id = user_order.id
WHERE order_id=$id
";
$resultStatus = $conn->query($sqlStatus);
$rowsStatus = $resultStatus->fetch_assoc();
?>
<!doctype html>
<html lang="en">

<head>
  <title>Order Detail</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.0-beta1 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

</head>

<body>
  <div class="container-fluid">
    <div class="row">
      <div class="col-3 row">
        <?php
        require("../side-nav.php") ?>
      </div>
      <div class="col-9">
        <div class="py-2">
          <a class="btn btn-dark" href="user_order.php">返回訂單列表</a>
          <a class="btn btn-dark" href="doUpdateDetail.php">修改訂單</a>
        </div>
        <?php if ($userCount > 0) :
          $rows = $result->fetch_all(MYSQLI_ASSOC);

        ?>
          <div class="col-3">
            <p>訂購人:<?= $rowsUser['u_name']; ?></p>
            <p>訂單日期:<?= $rowsDate['date']; ?></p>
            <p>狀態:<?= $rowsStatus['status']; ?></p>
          </div>
          <div class="py-2">共<?= $userCount ?>筆資料</div>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center">書名</th>
                <th class="text-center">封面</th>
                <th class="text-center">價格</th>
                <th class="text-center">數量</th>
                <th class="text-center">小計</th>
                <th class="text-center">刪除訂單</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($rows as $row) : ?>
                <tr>

                  <td class="text-center"><?= $row["p_name"] ?></td>
                  <td class="text-center"><?= $row["book_img"] ?></td>
                  <td class="text-center"><?= $row["price"] ?></td>
                  <td class="text-center"><?= $row["amount"] ?></td>
                  <td class="text-center"><?= $row["amount"] * $row["price"] ?></td>
                  <td><a class="btn btn-danger" href="doDeleteDetail.php?id=<?= $row["id"] ?>">刪除</a></td>
                </tr>
              <?php endforeach; ?>
              <?php
              $sum = 0;
              for ($i = 0; $i < count($rows); $i++) {
                $sum += $rows[$i]["price"];
              }
              ?>
              <td class="text-end fs-2" colspan="5">總金額:<?= $sum; ?></td>
            </tbody>
          </table>
        <?php else : ?>
          沒有該筆訂單
        <?php endif; ?>
      </div>
    </div>
</body>

</html>
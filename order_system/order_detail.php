<?php
session_start();
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

$sql = "SELECT user_order_detail.*, product.book_name AS p_name, product.price, product.book_img, user_order.user_id, user_order.id AS o_id, user_order.date, user_order.status, member.name AS u_name, member.member_class, member.email, member.user_name, member.birthday, member.account, marketing.coupon_name AS c_name
FROM user_order_detail
JOIN member ON user_order_detail.user_id = member.id
JOIN product ON user_order_detail.product_id = product.id
JOIN user_order ON user_order_detail.order_id = user_order.id
JOIN marketing ON user_order_detail.coupon_id=marketing.id
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

$sqlClass = "SELECT user_order_detail.*, member.member_class
FROM user_order_detail
JOIN member on user_order_detail.user_id=member.id
WHERE order_id=$id
";
$resultClass = $conn->query($sqlClass);
$rowsClass = $resultClass->fetch_assoc();

$sqlAccount = "SELECT user_order_detail.*, member.account
FROM user_order_detail
JOIN member on user_order_detail.user_id=member.id
WHERE order_id=$id
";
$resultAccount = $conn->query($sqlAccount);
$rowsAccount = $resultAccount->fetch_assoc();

$sqlUsername = "SELECT user_order_detail.*, member.user_name
FROM user_order_detail
JOIN member on user_order_detail.user_id=member.id
WHERE order_id=$id
";
$resultUsername = $conn->query($sqlUsername);
$rowsUsername = $resultUsername->fetch_assoc();

$sqlEmail = "SELECT user_order_detail.*, member.email
FROM user_order_detail
JOIN member on user_order_detail.user_id=member.id
WHERE order_id=$id
";
$resultEmail = $conn->query($sqlEmail);
$rowsEmail = $resultEmail->fetch_assoc();

$sqlBirthday = "SELECT user_order_detail.*, member.birthday
FROM user_order_detail
JOIN member on user_order_detail.user_id=member.id
WHERE order_id=$id
";
$resultBirthday = $conn->query($sqlBirthday);
$rowsBirthday = $resultBirthday->fetch_assoc();

$sqlDate = "SELECT user_order_detail.*, user_order.date
FROM user_order_detail
JOIN user_order ON user_order_detail.order_id = user_order.id
WHERE order_id=$id
";
$resultDate = $conn->query($sqlDate);
$rowsDate = $resultDate->fetch_assoc();

$sqlCoupon = "SELECT user_order_detail.*, marketing.coupon_name
FROM user_order_detail
JOIN marketing ON user_order_detail.order_id = marketing.id
WHERE coupon_id=$id
";
$resultCoupon = $conn->query($sqlCoupon);
$rowsCoupon = $resultCoupon->fetch_assoc();

$sqlStatus = "SELECT user_order_detail.*, user_order.status
FROM user_order_detail
JOIN user_order ON user_order_detail.order_id = user_order.id
WHERE order_id=$id";

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

  <style>
    .book_img {
      width: 95px;
      display: block;
      margin: auto;
    }

    .thead-col {
      background-color: #102e2ef8;
    }
    .accordion-button{
      color: white; !important;
      background-color: #102e2ef8; !important;
    }
  

  </style>
</head>

<body>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>

  <div class="container-fluid">
    <div class="row">
      <div class="col-3 row">
        <?php
        require("../side-nav.php") ?>
      </div>
      <div class="col-9">
        <div class="py-2">
          <a class="btn btn-dark" href="user_order.php">返回所有訂單列表</a>
          <!-- <a class="btn btn-dark" href="order-detail-edit.php">修改訂單</a> -->
        </div>
        <?php if ($userCount > 0) :
          $rows = $result->fetch_all(MYSQLI_ASSOC);
        ?>
        
          <div class="accordion" id="accordionExample">
            <div class="accordion-item">
              
              <h2 class="accordion-header text-light" id="headingOne">
                <button class="accordion-button " type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  訂購人:<?= $rowsUser['u_name']; ?> 會員資料
                </button>
              </h2>
              <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <strong>會員等級:<?= $rowsClass['member_class']; ?></strong><br>
                  <strong>帳號:<?= $rowsAccount['account']; ?></strong><br>
                  <strong>暱稱:<?= $rowsUsername['user_name']; ?></strong><br>
                  <strong>e-mail:<?= $rowsEmail['email']; ?></strong><br>
                  <strong>生日:<?= $rowsBirthday['birthday']; ?></strong><br>
                </div>
              </div>
            </div>
            <div class="col-12">
            <div class="text-end mt-5">訂單日期:<?= $rowsDate['date']; ?> &nbsp &nbsp  &nbsp 狀態:<?= $rowsStatus['status']; ?>&nbsp &nbsp &nbsp共<?= $userCount ?>本書</div>
            <!-- <div class="py-2">共<?= $userCount ?>本書</div> -->
            </div>
            <form action="doDeleteDetail.php" method="POST">
              <table class="table table-bordered">
                <thead class="text-white thead-col">
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
                      <input name="id" type="hidden" value="<?= $row["o_id"] ?>">
                      <td class="text-center"><?= $row["p_name"] ?></td>
                      <td>
                        <img class="object-cover book_img" src="../product-create/image/<?= $row["book_img"] ?>">
                      </td>
                      <td class="text-center"><?= $row["price"] ?></td>
                      <td class="text-center"><?= $row["amount"] ?></td>
                      <td class="text-center"><?= $row["amount"] * $row["price"] ?></td>
                      <!-- <td><btn class="btn btn-danger" href="doDeleteDetail.php?id=<?= $row["id"] ?>">刪除</btn></td> -->
                      <td>
                        <button class="btn btn-danger" name="update_order" type="submit">刪除</button>
                      </td>
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
            </form>
          <?php else : ?>
            沒有該筆訂單
          <?php endif; ?>
          </div>
      </div>
    </div>
  
</body>

</html>
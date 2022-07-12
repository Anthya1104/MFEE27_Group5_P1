<?php
// 取得頁數
if (isset($_GET["page"])) {
  $page = $_GET["page"];
} else {
  $page = 1;
}

require("../db-connect.php");

// 先sql總共有多少筆資料
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

if (isset($_GET["user_id"])) {
  $user_id = $_GET["user_id"];
  $sqlWhere = "WHERE user_order.user_id = $user_id";
  $sqlUser = "SELECT name FROM member WHERE id=$user_id";
  $resultUser = $conn->query($sqlUser);
  $rowUser = $resultUser->fetch_assoc();
}

if (isset($_GET["start"])) {
  $start = $_GET["start"];
  $end = $_GET["end"];
  $sqlWhere = "WHERE date BETWEEN '$start' AND '$end'";
}

// 取得順序 預設為1
$order = isset($_GET["order"]) ? $_GET["order"] : 1;

switch ($order) {
  case 1:
    $orderType = "id ASC";
    break;
  case 2:
    $orderType = "id DESC";
    break;
  case 3:
    $orderType = "date ASC";
    break;
  case 4:
    $orderType = "date DESC";
    break;
  default:
    $orderType = "id ASC";
}

$perPage = 4;
$start = ($page - 1) * $perPage;

$sql = "SELECT user_order.*, member.name, marketing.Coupon_code FROM user_order
JOIN member ON user_order.user_id = member.id
JOIN marketing ON user_order.coupon_id = marketing.id
WHERE user_order.valid=1
ORDER BY $orderType
LIMIT $start, 4
$sqlWhere
";

$result = $conn->query($sql);
// pageUserCount不能為0才能正常顯示資料
$pageUserCount = $result->num_rows;
$rows = $result->fetch_all(MYSQLI_ASSOC);
$startItem = ($page - 1) * $perPage + 1;
$endItem = $page * $perPage;
if ($endItem > $userCount) $endItem = $userCount;
$totalPage = ceil($userCount / $perPage);
?>
<!doctype html>
<html lang="en">

<head>
  <title>Order List</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.0-beta1 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <style>
    .title {
      color: #102e2ef8;
    }

    .thead-col {
      background-color: #102e2ef8;

    }

    .pagination>li>a {
      background-color: white;
      color: #000;
    }

    .pagination>li>a:focus,
    .pagination>li>a:hover,
    .pagination>li>span:focus,
    .pagination>li>span:hover {
      color: white;
      background-color: #000;
      border-color: #000;
    }

    .pagination>.active>a {
      color: white;
      background-color: #000 !Important;
      border: solid 1px #000 !Important;
    }

    .pagination>.active>a:hover {
      background-color: #000 !Important;
      border: solid 1px #000;
    }
  </style>
</head>

<body>
  <div class="container-fluid">
    <div class="row">
      <div class="col-3 row">
        <?php
        require("../side-nav.php") ?>
      </div>
      <div class="col-9">
        <p class="fs-2 fw-bold title">書商:閱閱出版社</p>
        <h3>訂單列表</h3>
        <div class="py-2">
          <form class="form-inline" role="search" action="order-search.php" method="get" target="_blank">
            <div class="input-group"> <input name="search" class="form-control" type="text" placeholder="輸入訂購人或訂單流水號搜尋">
              <div class="input-group-append">
                <button class="input-group-text btn-dark" type="submit">搜尋</button>
              </div>
            </div>
          </form>
        </div>
        <div class="py-2 d-flex justify-content-end align-items-center">
          <div class="me-2">排序依</div>
          <form>
            <select name="selectURL" onchange="window.location.href=this.form.selectURL.options[this.form.selectURL.selectedIndex].value">
              <option value="user_order.php?page=<?= $page ?>&order=1">訂單編號(小->大)</option>
              <option value="user_order.php?page=<?= $page ?>&order=2">訂單編號(大->小)</option>
              <option value="user_order.php?page=<?= $page ?>&order=3">訂單日期(舊->新)</option>
              <option value="user_order.php?page=<?= $page ?>&order=4">訂單日期(新->舊)</option>
            </select>
          </form>
        </div>
        <div class="py-2">
          <?php if (isset($_GET["product_id"]) || isset($_GET["user_id"]) || isset($_GET["start"])) : ?>
            <a href="user_order.php" class="btn btn-info">回所有訂單列表</a>
          <?php endif; ?>
        </div>

        <div class="py-2">
          <form action="">
            <div class="row align-items-center">
              <div class="col-auto">
                <input type="date" class="form-control" name="start" required value="<?php
                                                                                      if (isset($_GET["start"])) echo $_GET["start"];
                                                                                      ?>">
              </div>
              ~
              <div class="col-auto">
                <input type="date" class="form-control" name="end" required value="<?php
                                                                                    if (isset($_GET["end"])) echo $_GET["end"];
                                                                                    ?>">
              </div>
              <div class="col-auto">
                <button class="btn btn-dark" type="submit">查詢</button>
              </div>
            </div>
          </form>
        </div>


        <?php if (isset($_GET["product_id"])) : ?>
          <h1><?= $rowProduct["name"] ?> 的購買紀錄</h1>
        <?php endif; ?>

        <?php if (isset($_GET["user_id"])) : ?>
          <h1><?= $rowUser["name"] ?> 的購買紀錄</h1>
        <?php endif; ?>
        <div class="py-2">第<?= $startItem ?>-<?= $endItem ?>筆, 共<?= $userCount ?>筆資料</div>
        <?php if ($pageUserCount > 0) : ?>
        <?php endif; ?>
        <table class="table table-bordered">
          <thead>
            <tr class="thead-col text-white">
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
                <td class="text-center "><?= $row["total"] ?></td>
                <td class="text-center"><?= $row["Coupon_code"] ?></td>
                <td class="text-center"><?= $row["name"] ?></td>
                <td class="text-center"><?= $row["date"] ?></td>
                <td class="text-center"><?= $row["status"] ?></td>
                <td>
                  <a class="btn btn-success" href="order-edit.php?id=<?= $row["id"] ?>">更新狀態</a>
                  <a class="btn btn-danger" href="doDelete.php?id=<?= $row["id"] ?>">刪除訂單</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <div class="py-2">
          <ul class="pagination">
            <?php for ($i = 1; $i <= 5; $i++) : ?>
              <li class="page-item <?php if ($page == $i) echo "active"; ?>"><a class="page-link" href="user_order.php?page=<?= $i ?>"><?= $i ?></a></li>
            <?php endfor; ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
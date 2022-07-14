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
  case 5:
    $orderType = "total ASC";
    break;
  case 6:
    $orderType = "total DESC";
    break;
  default:
    $orderType = "id ASC";
}

$perPage = 5;
$start = ($page - 1) * $perPage;

$sql = "SELECT user_order.*, member.name AS u_name , marketing.Coupon_code FROM user_order
JOIN member ON user_order.user_id = member.id
JOIN marketing ON user_order.coupon_id = marketing.id
WHERE user_order.valid=1
ORDER BY $orderType
LIMIT $start, 5
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
  <link rel="stylesheet" href="../fontawesome-free-6.1.1-web/css/all.min.css">
  <style>
    .title {
      border-bottom: 5px solid #000;
      padding-bottom: 15px;
      margin-bottom: 15px;
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
        <div class="py-2 mt-4">
          <div class="me-2 mt-2 ">
            <h2 class="title">閱閱出版社&nbsp訂單管理</h2>
          </div>
          <h3>所有訂單列表</h3>
          <div class="py-2 mt-4">
            <form class="form-inline" role="search" action="order-search.php" method="get" target="_blank">
              <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="輸入訂購人或訂單編號搜尋">
                <button type="submit" class="btn btn-dark"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
          </div>
          </form>
        </div>
        <div class="py-2 d-flex justify-content-end align-items-center">
          <div class="me-2 fs-6"><i class="fa-solid fa-filter"></i>排序依</div>
          <form>
            <select name="selectURL" onchange="location=this.form.selectURL.options[this.form.selectURL.selectedIndex].value">
              <option>請選擇排序方式</option>
              <option value="user_order.php?page=<?= $page ?>&order=1">訂單流水號(小->大)</option>
              <option value="user_order.php?page=<?= $page ?>&order=2">訂單流水號(大->小)</option>
              <option value="user_order.php?page=<?= $page ?>&order=3">訂單日期(舊->新)</option>
              <option value="user_order.php?page=<?= $page ?>&order=4">訂單日期(新->舊)</option>
              <option value="user_order.php?page=<?= $page ?>&order=5">訂單金額(小->大)</option>
              <option value="user_order.php?page=<?= $page ?>&order=6">訂單金額(大->小)</option>
            </select>
          </form>
          <script>
            function selectValue() {
              var x = document.getElementById("dropdown").value;
              document.getElementById("show").innerHTML = x;
            }
          </script>
          </form>
        </div>
        <div class="py-2">
          <?php if (isset($_GET["product_id"]) || isset($_GET["user_id"]) || isset($_GET["start"])) : ?>
            <a href="user_order.php" class="btn btn-info">回所有訂單列表</a>
          <?php endif; ?>
        </div>
        <div class="py-2">
          <form action="do-date-select.php" method="GET">
            <div class="row d-flex align-items-center">
              <div class="col-md-4">
                <div class="form-group ">
                  <label for="">依訂單日期搜尋</label>
                  <input type="date" name="from_date" class="form-control" value="<?php if (isset($_GET['from_date'])) {
                                                                                    echo $_GET['from_date'];
                                                                                  } ?>  ">
                </div>
              </div> ~
              <div class="col-md-4">
                <div class="form-group ">
                  <label for=""></label>
                  <input type="date" name="to_date" class="form-control">
                </div>
              </div>

              <div class="col-md-2 align-self-end ps-1">
                <div class="form-group ">
                  <label for=""></label>
                  <!-- <button type="submit" class="btn btn-info">filter</button> -->
                  <button type="submit" class="btn btn-dark">查詢</button>
                </div>
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
        <div class="py-2">目前顯示第<?= $startItem ?>-<?= $endItem ?>筆, 共<?= $userCount ?>筆訂單</div>
        <?php if ($pageUserCount > 0) : ?>
        <?php endif; ?>
        <!-- <p>篩選訂單狀態</p> -->
        <div class="wrap d-flex ">
        <div class="me-4">
            <p>篩選訂單狀態</p>
        </div>
        <div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" onclick="location.href='user_order.php'">
              <label class="form-check-label" for="inlineRadio1">所有訂單</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2" onclick="location.href='unpay-order.php'">
              <label class="form-check-label" for="inlineRadio2">尚未付款</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3" onclick="location.href='payed-order.php'">
              <label class="form-check-label" for="inlineRadio3">已付款</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio4" value="option4" onclick="location.href='finish-order.php'">
              <label class="form-check-label" for="inlineRadio3">訂單完成</label>
            </div>
        </div>
        </div>

        
        <table class="table table-bordered">
          <thead>
            <tr class="thead-col text-white">
              <th class="text-center">訂單流水號</th>
              <th class="text-center">總金額</th>
              <th class="text-center">優惠券序號</th>
              <th class="text-center">訂購人</th>
              <th class="text-center">訂單編號</th>
              <th class="text-center">訂單日期</th>
              <th class="text-center">訂單狀態</th>
              <th class="text-center">操作</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($rows as $row) : ?>
              <tr>
                <td class="text-center"><?= $row["id"] ?></a></td>
                </td>
                <td class="text-center"><?= $row["total"] ?></td>
                <td class="text-center"><?= $row["Coupon_code"] ?></td>
                <td class="text-center"><?= $row["u_name"] ?></td>
                <th class="text-center"><a href="order_detail.php?id=<?= $row["id"] ?>"><?= $row["sn"] ?></th>
                <td class="text-center"><?= $row["date"] ?></td>
                <td class="text-center"><?= $row["status"] ?></td>
                <td>
                  <a class="btn btn-success" href="order-edit.php?id=<?= $row["id"] ?>"><i class="fa-solid fa-pen"></i>更新狀態</a>
                  <a class="btn btn-danger" href="doDelete.php?id=<?= $row["id"] ?>"><i class="fa-regular fa-trash-can"></i>刪除</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <div class="py-2">
          <ul class="pagination">
            <?php for ($i = 1; $i <= 8; $i++) : ?>
              <li class="page-item <?php if ($page == $i) echo "active"; ?>"><a class="page-link" href="user_order.php?page=<?= $i ?>"><?= $i ?></a></li>
            <?php endfor; ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
<?php
require("../db-connect.php");

// $sql="SELECT product.*, category.category_name AS category__name FROM product
// JOIN category ON product.book_category = category.category_id WHERE valid=1 ORDER BY id $orderType LIMIT $start, 5 ";


if (isset($_GET['start']) && isset($_GET['end'])) {
    $start = $_GET['start'];
    $end = $_GET['end'];


    $sql = "SELECT user_order.*, member.name, marketing.Coupon_code FROM user_order
    JOIN member ON user_order.user_id = member.id
    JOIN marketing ON user_order.coupon_id = marketing.id
    WHERE user_order.valid=1
    AND date BETWEEN '$start' AND '$end'";

    // $sql = "SELECT user_order.* FROM user_order WHERE valid=1 AND date BETWEEN '$start' AND '$end' ";

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
                <h2 class="mt-4"> <?= $start ?> ~ <?= $end ?> 的訂單 </h2>
                <a class="btn btn-dark my-3" href="user_order.php">返回所有訂單列表</a>
                <?php if ($dateCount > 0) : ?>
                    <<table class="table table-bordered">
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
                                    <td class="text-center"><?= $row["name"] ?></td>
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
                    <?php else : ?>
                        沒有符合的資料
                    <?php endif; ?>
            </div>
        </div>
    </div>

</html>
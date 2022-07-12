<?php
if(!isset($_GET["id"])){
    echo "沒有參數";
    exit;
}
$id=$_GET["id"];

require("../db-connect.php");
$sql="SELECT * FROM marketing WHERE id=$id AND valid=1";

$result = $conn->query($sql);
$couponCount=$result->num_rows;

?>

<!doctype html>
<html lang="en">

<head>
    <title>couponEdit</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-3 row">
                <?php require("../side-nav.php"); ?>
            </div>
            <div class="col-9">
                <div class="py-4">
                    <a href="coupon-list.php" class="btn btn-warning py-2">瀏覽所有優惠券</a>
                </div>
                <?php if($couponCount>0):
                $row = $result->fetch_assoc();
                ?>
                <h3 class=py-2>優惠券</h3>
                <form action="coupon-doupdate.php" method="post">
                    <input name="id" type="hidden" value="<?=$row["id"]?>">
                    <table class="table">
                        <tr class="table-dark">
                            <th>優惠券序號</th>
                            <td><?=$row["id"]?></td>
                        </tr>
                        <tr>
                            <th>優惠券名稱</th>
                            <td><input type="text" name="Coupon_name" class="form-control"
                                    value="<?=$row["Coupon_name"]?>">
                            </td>
                        </tr>
                        <tr>
                            <th>優惠券代碼</th>
                            <td><input type="text" name="Coupon_code" class="form-control"
                                    value="<?=$row["Coupon_code"]?>">
                            </td>
                        </tr>
                        <tr>
                            <th>優惠券開始日期</th>
                            <td><input type="date" name="Coupon_sdte" class="form-control"
                                    value="<?=$row["Coupon_sdte"]?>">
                            </td>
                        </tr>
                        <tr>
                            <th>優惠券截止日期</th>
                            <td><input type="date" name="Coupon_edte" class="form-control"
                                    value="<?=$row["Coupon_edte"]?>">
                            </td>
                        </tr>
                        <tr>
                            <th>優惠券折扣</th>
                            <td><input type="text" name="Coupon_discount" class="form-control"
                                    value="<?=$row["Coupon_discount"]?>">
                            </td>
                        </tr>
                    </table>
                    <div class="py-2">
                        <button class="btn btn-warning" type="submit">儲存</button>
                        <a href="coupon.php?id=<?=$row["id"]?>" class="btn btn-dark">取消</a>
                    </div>
                </form>
                <?php else:?>
                沒有該優惠券
                <?php endif;?>
            </div>
        </div>

    </div>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
        integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js"
        integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous">
    </script>
</body>

</html>
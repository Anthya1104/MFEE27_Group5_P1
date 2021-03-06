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
    <link rel="stylesheet" href="../fontawesome-free-6.1.1-web/css/all.min.css">

    <style>
    .thead-col {
      background-color: #102e2ef8;
    }
    .btn-green{
        background-color: #102e2ef8;
    }
    .fw{
        font-size: 30px;
    }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-3 row">
                <?php require("../side-nav.php"); ?>
            </div>
            <div class="col-9">
                <!-- <div class="py-4">
                    <a href="coupon-list.php" class="btn btn-warning py-2">瀏覽所有優惠券 <svg
                            xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-eye-fill" viewBox="0 0 16 16">
                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                            <path
                                d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                        </svg></a>
                </div> -->
                <?php if($couponCount>0):
                $row = $result->fetch_assoc();
                ?>
                <h3 class="pt-4 pb-2">優惠券修改&nbsp<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
</svg></h3>
                <form action="coupon-doupdate.php" method="post">
                    <input name="id" type="hidden" value="<?=$row["id"]?>">
                    <table class="table">
                        <tr class="thead-col text-white">
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
                    <div class="wrap d-flex justify-content-between">
                        <div class="py-2">
                            <button class="btn btn-warning" type="submit">儲存</button>
                            <a href="coupon.php?id=<?=$row["id"]?>" class="btn btn-dark text-white">取消</a>
                        </div>
                        <div class="py-2">
                            <a href="coupon-list.php" class="btn btn-warning">瀏覽所有優惠券 <svg
                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-eye-fill" viewBox="0 0 16 16">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                    <path
                                        d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                </svg></a>
                        </div>
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
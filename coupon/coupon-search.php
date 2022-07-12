<?php
require("../db-connect.php");
if(!isset($_GET["search"])){
    $search="";
    $couponCount=0;
}else{
    $search=$_GET["search"];
    $sql="SELECT id, Coupon_name, Coupon_code, Coupon_sdte, Coupon_edte, Coupon_discount FROM marketing WHERE Coupon_name LIKE '%$search%'";
    $result = $conn->query($sql);
    $couponCount=$result->num_rows;

}


?>
<!doctype html>
<html lang="en">

<head>
    <title>Coupon-search</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="../fontawesome-free-6.1.1-web/css/all.min.css">

</head>

<body>
    <div class="containe-fluid">
        <div class="row">
            <div class="col-3 row">
                <?php require("../side-nav.php"); ?>
                <!--連結sidebar-->
            </div>
            <div class="col-9">
                <!--連結資料頁面內容-->
                <div class="py-2">
                    <form action="coupon-search.php" method="get">
                        <div class="input-group">

                            <input type="text" class="form-control" name="search" placeholder="請輸入優惠券名稱">
                            <button type="submit" class="btn btn-dark"><i
                                    class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>
                </form>
            </div>
            <div class="py-2">
                <h2><?=$search?> 的搜尋結果</h2>
                <div class="py-2">共 <?=$couponCount?> 筆資料</div>
            </div>
            <?php if($couponCount>0): ?>
            <table class="table table-bordered">
                <thead>
                    <tr class="table-dark">
                        <th>優惠券序號</th>
                        <th>優惠券名稱</th>
                        <th>優惠券代碼</th>
                        <th>優惠券開始日期</th>
                        <th>優惠券截止日期</th>
                        <th>優惠券折扣</th>
                        <th>優惠券功能</th>
                    </tr>
                </thead>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?=$row["id"]?></td>
                    <td><?=$row["Coupon_name"]?></td>
                    <td><?=$row["Coupon_code"]?></td>
                    <td><?=$row["Coupon_sdte"]?></td>
                    <td><?=$row["Coupon_edte"]?></td>
                    <td><?=$row["Coupon_discount"]?></td>
                    <td><a href="coupon-edit.php?id=<?=$row["id"]?>" class="btn btn-warning">修改 <i
                                class="fa-solid fa-pen"></i></a>
                        <a class="btn btn-danger" href="coupon-dodelete.php?id=<?=$row["id"]?>">刪除 <i
                                class="fa-solid fa-trash"></i></a>

                    </td>

                </tr>
                <?php endwhile;?>
                </tbody>
            </table>
            <?php else: ?>
            沒有符合條件的結果
            <?php endif;?>
            <div class="py-2">
                <a href="coupon-list.php" class="btn btn-warning">瀏覽所有優惠券 <svg xmlns="http://www.w3.org/2000/svg"
                        width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                        <path
                            d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                    </svg></a>
            </div>

            <!-- <?=$search?> -->
        </div>
    </div>



    </div>

</body>

</html>
<?php
require("../db-connect.php");

function generateRandomString($length = 10) {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}
$coupon_id=generateRandomString();  
//var_dump($coupon_id);

?>

<!doctype html>
<html lang="en">

<head>
    <title>Create Coupon</title>
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
                <div class="mt-4">
                    <h2>新增優惠券：</h2>
                </div>
                <form action="coupon-do-create.php" method="post">
                    <div class="mb-2">
                        <label for="">優惠券名稱</label>
                        <input type="text" class="form-control" name="Coupon_name" placeholder="輸入優惠券名稱" required>
                    </div>
                    <div class="mb-2">
                        <label for="">優惠券代碼</label>
                        <input type="text" class="form-control" name="Coupon_code" placeholder="輸入優惠券代碼"
                            value=<?="$coupon_id"?>>
                        <!-- disabled -->
                    </div>
                    <div class=" mb-2">
                        <label for="">優惠券開始日期</label>
                        <input type="date" class="form-control" name="Coupon_sdte">
                    </div>
                    <div class="mb-2">
                        <label for="">優惠券截止日期</label>
                        <input type="date" class="form-control" name="Coupon_edte">
                    </div>
                    <div class="mb-2">
                        <label for="">優惠券折扣</label>
                        <input type="text" class="form-control" name="Coupon_discount" placeholder="輸入優惠折扣">
                    </div>
                    <button class="btn btn-primary" type="submit">新增優惠券 <svg xmlns="http://www.w3.org/2000/svg"
                            width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill"
                            viewBox="0 0 16 16">
                            <path
                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                        </svg></button>


                    <!-- <button href="" class="btn btn-warning" type="submit">Reset</button> -->
                    <!-- <button class="btn btn-info" type="submit">Create Coupon</button> -->
                    <!-- <button class="btn btn-warning" type="submit">Reset</button> -->
                    <!-- <br>
                <br>
                <h4>Edit Restore,and Hidden coupon:</h4> -->
                    <a href="coupon-list.php" class="btn btn-warning" type="submit">瀏覽所有優惠券 <svg
                            xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-eye-fill" viewBox="0 0 16 16">
                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                            <path
                                d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                        </svg></a>


                </form>
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

</html>
<?php
if (isset($_GET["page"])) {
    $page = $_GET["page"];
  } else {
    $page = 1;
  }
  
// $page=$_GET["page"];

require("../db-connect.php");

$sqlAll="SELECT * FROM marketing WHERE valid=1";
$resultAll = $conn->query($sqlAll);
$couponCount=$resultAll->num_rows;

// $page=1;
$perPage=6;
$start=($page-1)*$perPage;

//$order=$_GET["order"];
$order=isset($_GET["order"]) ? $_GET["order"] : 1;//條件判斷式

switch($order){
    case 1:
        $orderType="id ASC";
    break;
    case 2:
        $orderType="id DESC";
    break;
    case 3:
        $orderType="Coupon_sdte ASC";
    break;
    case 4:
        $orderType="Coupon_sdte DESC";
    break;
    case 5:
        $orderType="Coupon_edte ASC";
    break;
    case 6:
        $orderType="Coupon_edte DESC";
    break;
    case 7:
        $orderType="Coupon_discount ASC";
    break;
    case 8:
        $orderType="Coupon_discount DESC";
    break;
    
    default:
        $orderType="id ASC";
}
//沒有ORDER BY自然排序
$sql="SELECT * FROM marketing WHERE valid=1 ORDER BY $orderType LIMIT $start, 6";

//select欄位名稱 ＊顯示所有欄位 form資料表名稱

$result = $conn->query($sql);//$result是否拿到結果， ＄conn->query向資料庫拿資料
// $couponCount=$result->num_rows;
// $rows = $result->fetch_all(MYSQLI_ASSOC);
$pageCouponCount=$result->num_rows;


//開始的筆數
$startItem=($page-1)*$perPage+1;
$endItem = $page * $perPage;
if($endItem>$couponCount)$endItem=$couponCount;

// $totalPage=3;
// //$quotient=商數
// $quotient=floor($couponCount / $perPage);//floor無條件捨去
// $remainder=($couponCount % $perPage);//餘數

// if($remainder===0){
//     //商數
//     $totalPage=$quotient;
// }else{
//     $totalPage=$quotient+1;
// }

$totalPage=ceil($couponCount / $perPage);//無條件進位

?>
<!doctype html>
<html lang="en">

<head>
    <title>Coupon list</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="../fontawesome-free-6.1.1-web/css/all.min.css">
    <style>
    .pagination>a {
        background-color: white;
        color: #000;
    }

    .pagination>a:focus,
    .pagination>a:hover,
    .pagination>span:focus,
    .pagination>span:hover {
        color: white;
        background-color: #000;
        border-color: #000;
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
                <?php require("../side-nav.php"); ?>
            </div>
            <div class="col-9">
                <!-- <?php var_dump($rows);?> -->
                <div class="py-2 mt-4">
                    <form action="coupon-search.php" method="get">
                        <div class="input-group">

                            <input type="text" class="form-control" name="search" placeholder="請輸入優惠券名稱">
                            <button type="submit" class="btn btn-dark"><i
                                    class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>
                </form>

                <div class="py-2">
                    <div class="me-2 mt-4">
                        <h4>優惠券排序</h3>
                    </div>
                    <!-- <div class="btn-group ">
                        <a href="coupon-list.php?page=<?=$page?>&order=1" class="btn btn-warning">序號<i
                                class="fa-solid fa-arrow-down-short-wide"></i></a>
                        <a href="coupon-list.php?page=<?=$page?>&order=2" class="btn btn-warning">序號<i
                                class="fa-solid fa-arrow-down-wide-short"></i></a>
                        <a href="coupon-list.php?page=<?=$page?>&order=3" class="btn btn-warning">開始日期<i
                                class="fa-solid fa-arrow-down-short-wide"></i></a>
                        <a href="coupon-list.php?page=<?=$page?>&order=4" class="btn btn-warning">開始日期<i
                                class="fa-solid fa-arrow-down-wide-short"></i></a>
                        <a href="coupon-list.php?page=<?=$page?>&order=5" class="btn btn-warning">截止日期<i
                                class="fa-solid fa-arrow-down-short-wide"></i></a>
                        <a href="coupon-list.php?page=<?=$page?>&order=6" class="btn btn-warning">截止日期<i
                                class="fa-solid fa-arrow-down-wide-short"></i></a>
                        <a href="coupon-list.php?page=<?=$page?>&order=7" class="btn btn-warning">折扣<i
                                class="fa-solid fa-arrow-down-short-wide"></i></a>
                        <a href="coupon-list.php?page=<?=$page?>&order=8" class="btn btn-warning">折扣<i
                                class="fa-solid fa-arrow-down-wide-short"></i></a>

                    </div> -->
                </div>
                <div class="py-2">
                    <form action="">
                        <select select class="form-select form-select mb-3" aria-label=".form-select example"
                            name="selectURL"
                            onchange="window.location.href=this.form.selectURL.options[this.form.selectURL.selectedIndex].value">
                            <option value="coupon-list.php?page=<?= $page ?>&order=1">請選擇排序方式</option>
                            <option value="coupon-list.php?page=<?= $page ?>&order=1">優惠券序號(小->大)<i
                                    class="fa-solid fa-arrow-down-wide-short"></i></option>
                            <option value="coupon-list.php?page=<?= $page ?>&order=2">優惠券序號(大->小)<i
                                    class="fa-solid fa-arrow-down-wide-short"></i></option>
                            <option value="coupon-list.php?page=<?= $page ?>&order=3">優惠券開始日期(舊->新)</option>
                            <option value="coupon-list.php?page=<?= $page ?>&order=4">優惠券開始日期(新->舊)</option>
                            <option value="coupon-list.php?page=<?= $page ?>&order=5">優惠券截止日期(舊->新)</option>
                            <option value="coupon-list.php?page=<?= $page ?>&order=6">優惠券截止日期(新->舊)</option>
                            <option value="coupon-list.php?page=<?= $page ?>&order=7">優惠券折扣(小->大)</option>
                            <option value="coupon-list.php?page=<?= $page ?>&order=8">優惠券折扣(大->小)</option>
                        </select>
                    </form>
                </div>


                <div class="row mb-2 align-items-center">
                    <div class="col-3 d-flex align-items-center">
                        <div class="mb-0">
                            第 <?= $startItem ?>-<?= $endItem ?> 張, 共
                            <?= $couponCount ?> 張優惠券
                        </div>
                    </div>
                    <div class="col d-flex justify-content-end align-items-center">
                        <!-- 新增優惠券畫面  -->
                        <a href="coupon-form-get.php" class="btn btn-primary" type="submit">新增優惠券 <svg
                                xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                <path
                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                            </svg></a>
                        <!--  -->
                    </div>
                </div>




                <?php if($pageCouponCount>0):?>
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
                    <tr></tr>
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
                <?php else:?>
                目前沒有資料
                <?php endif;?>
                <div class="py-2 d-flex justify-content-center">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li>
                                <a class="page-link" href="coupon-list.php?page=<?=$previous?>&order=<?= $order ?>"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-caret-left" viewBox="0 0 16 16">
                                        <path
                                            d="M10 12.796V3.204L4.519 8 10 12.796zm-.659.753-5.48-4.796a1 1 0 0 1 0-1.506l5.48-4.796A1 1 0 0 1 11 3.204v9.592a1 1 0 0 1-1.659.753z" />
                                    </svg></a>
                            </li>



                            <li class="page-item">
                                <?php 
                                $previous = $_GET["page"] - 1;
                                $next = $_GET["page"] + 1;
                                for ($i = 1; $i <= $totalPage; $i++) : ?>
                            </li>




                            <li class="page-item
                                <?php
                                    if ($page == $i) echo "active";
                                ?>
                                ">
                                <a class="page-link" href="coupon-list.php?page=<?=$i?>&order=<?= $order ?>"><?=$i?></a>


                            </li>

                            <?php endfor;?>

                            <li>
                                <a class="page-link" href="coupon-list.php?page=<?=$next?>&order=<?= $order ?>"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-caret-right" viewBox="0 0 16 16">
                                        <path
                                            d="M6 12.796V3.204L11.481 8 6 12.796zm.659.753 5.48-4.796a1 1 0 0 0 0-1.506L6.66 2.451C6.011 1.885 5 2.345 5 3.204v9.592a1 1 0 0 0 1.659.753z" />
                                    </svg></a>
                            </li>



                            <!-- <li class="page-item"><a class="page-link" href="coupon-list.php?">Previous</a></li> 
                            <li class="page-item"><a class="page-link" href="coupon-list.php?p<?=$i?>&order=<?= $order ?>">1</a></li>
                            <li class="page-item"><a class="page-link" href="coupon-list.php?<?=$i?>&order=<?= $order ?>">2</a></li>
                            <li class="page-item"><a class="page-link" href="coupon-list.php?<?=$i?>&order=<?= $order ?>">3</a></li> 
                            <li class="page-item"><a class="page-link" href="coupon-list.php?page=<?=$next?>&order=<?= $order ?>">Next</a></li> -->
                        </ul>
                    </nav>


                </div>
                <!-- 新增優惠券畫面  -->
                <!-- <div class="">
                    <a href="coupon-form-get.php" class="btn btn-primary" type="submit">新增優惠券</a>
                </div> -->
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
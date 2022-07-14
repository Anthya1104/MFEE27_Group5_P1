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
    <!-- jquery連結 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js" integrity="sha256-hlKLmzaRlE8SCJC1Kw8zoUbU8BxA+8kR3gseuKfMjxA=" crossorigin="anonymous"></script>
    <!-- jquery ui-->
    <!-- <script src="/MFEE27_Group5_P1/coupon/jquery-ui.js"></script> -->
    <link rel="stylesheet" href="./jquery-ui.min.css">
    <script src="./jquery-ui.min.js"></script>
    <style>
    .title{
        border-bottom: 5px solid #102e2ef8;
        padding-bottom: 15px;
        margin-bottom: 15px;
    }
    .pagination>a {
        background-color: white;
        color: #102e2ef8;
    }

    .pagination>a:focus,
    .pagination>a:hover,
    .pagination>span:focus,
    .pagination>span:hover {
        color: white;
        background-color: #102e2ef8;
        border-color: #102e2ef8;
    }

    .pagination>li>a {
        background-color: white;
        color: #102e2ef8;
    }

    .pagination>li>a:focus,
    .pagination>li>a:hover,
    .pagination>li>span:focus,
    .pagination>li>span:hover {
        color: white;
        background-color: #102e2ef8;
        border-color: #102e2ef8;
    }

    .pagination>.active>a {
        color: white;
        background-color: #102e2ef8 !Important;
        border: solid 1px #102e2ef8 !Important;
    }

    .pagination>.active>a:hover {
        background-color: #102e2ef8 !Important;
        border: solid 1px #102e2ef8;
    }

    .thead-col {
      background-color: #102e2ef8;
    }

    .green {
        background-color: #102e2ef8;
    }

    .text-green{
        color: #102e2ef8;
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
                <div class="py-2 mt-3">
                    <div class="me-2">
                        <h2 class="title text-green"><svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="currentColor" class="bi bi-calendar-fill" viewBox="0 0 16 16">
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V5h16V4H0V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5z"/>
</svg>&nbsp閱閱出版社&nbsp行銷管理</h2>    
                    </div>

                    <div class="me-2 mt-2">
                        <h4 class="text-green">行銷活動搜尋</h4>
                    </div>
                    <!-- 搜尋欄 -->
                    <form action="coupon-search.php" method="get">
                        <div class="input-group">

                            <input id="tags" type="text" class="form-control" name="search" placeholder="請輸入優惠券名稱">
                            <button id="search" type="submit" class="btn btn-dark thead-col"><i
                                    class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>
                    <!-- filter edit1 -->
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
                <div class="py-2">
                    <div class="me-2 mt-2">
                        <h4>優惠券排序</h4>
                    </div>
                    <form action="">
                        <select class="form-select form-select mb-3" aria-label=".form-select example"
                            name="selectURL"  
                            id="dropdown"
                            onchange="select()"
                            >
                            <!-- id="dropdown" -->
                            <!-- onchange="window.location.href=this.form.selectURL.options[this.form.selectURL.selectedIndex].value" -->
                            <option style="display:none">請選擇排序方式</option>
                            <option id="show2" value="coupon-list.php?page=<?= $page ?>&order=1" src="">優惠券序號(小->大)</option>
                            <option id="show3" value="coupon-list.php?page=<?= $page ?>&order=2" src="">優惠券序號(大->小)</option>
                            <option id="show4" value="coupon-list.php?page=<?= $page ?>&order=3" src="">優惠券開始日期(舊->新)</option>
                            <option id="show5" value="coupon-list.php?page=<?= $page ?>&order=4" src="">優惠券開始日期(新->舊)</option>
                            <option id="show6" value="coupon-list.php?page=<?= $page ?>&order=5" src="">優惠券截止日期(舊->新)</option>
                            <option id="show7" value="coupon-list.php?page=<?= $page ?>&order=6" src="">優惠券截止日期(新->舊)</option>
                            <option id="show8" value="coupon-list.php?page=<?= $page ?>&order=7" src="">優惠券折扣(小->大)</option>
                            <option id="show9" value="coupon-list.php?page=<?= $page ?>&order=8" src="">優惠券折扣(大->小)</option>


                        </select>
                        <script>
                            function select(){
                                var x = document.getElementById("dropdown").value;
                                console.log(x);
                                location.href=x;
                                // document.getElementById("show2").value;
                                // document.getElementById("show3").value;
                                // document.getElementById("show4").value;
                                // document.getElementById("show5").value;
                                // document.getElementById("show6").value;
                                // document.getElementById("show7").value;
                                // document.getElementById("show8").value;
                                // document.getElementById("show9").value;
                            }
                        </script>
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
                        <tr class="thead-col text-white">
                            <th>優惠券序號</th>
                            <th>優惠券名稱</th>
                            <th>優惠券代碼</th>
                            <th>優惠券開始日期</th>
                            <th>優惠券截止日期</th>
                            <th>優惠券折扣</th>
                            <th>優惠券功能</th>
                        </tr>
                    </thead>
                    <tbody id="myBody">
                                            
                    <?php while($row = $result->fetch_assoc()): ?>
                    <tr></tr>
                    <td><?=$row["id"]?></td>
                    <td><?=$row["Coupon_name"]?></td>
                    <td><?=$row["Coupon_code"]?></td>
                    <td><?=$row["Coupon_sdte"]?></td>
                    <td><?=$row["Coupon_edte"]?></td>
                    <td><?=$row["Coupon_discount"]?></td>
                    <td><a href="coupon-edit.php?id=<?=$row["id"]?>" class="btn btn-warning">修改&nbsp<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
</svg></a>
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
                            <!-- previous -->
                            <li>
                                <a class="page-link" href="coupon-list.php?page=<?=$previous?>&order=<?= $order ?>"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-caret-left" viewBox="0 0 16 16">
                                        <path
                                            d="M10 12.796V3.204L4.519 8 10 12.796zm-.659.753-5.48-4.796a1 1 0 0 1 0-1.506l5.48-4.796A1 1 0 0 1 11 3.204v9.592a1 1 0 0 1-1.659.753z" />
                                    </svg></a>
                            </li>

                            <!-- <li>
                                <a class="page-link" href="coupon-list.php?page=1&order=<?= $order ?>"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-caret-left" viewBox="0 0 16 16">
                                        <path
                                            d="M10 12.796V3.204L4.519 8 10 12.796zm-.659.753-5.48-4.796a1 1 0 0 1 0-1.506l5.48-4.796A1 1 0 0 1 11 3.204v9.592a1 1 0 0 1-1.659.753z" />
                                    </svg></a>
                            </li> -->



                            <li class="page-item">
                                <?php              
                                $previous = $page - 1;
                                $next = $page + 1;
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
                            <!-- next -->
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
                    <!-- jquery -->
        <script>
                    $(function() {
                        var terms = [
                            "會員日",
                            "名人推薦",
                            "新書限時優惠",
                            "年度排行榜",
                            "本月排行榜",
                            "本週排行榜",
                            "年度精選",
                            "本月精選",
                            "本週精選",
                            "商業理財精選",
                            "文學小說精選",
                            "社會科學精選",
                            "生活風格精選",
                            "藝術設計精選",
                            "自然科普精選",
                            "旅遊觀光精選",
                            "醫療保健精選",
                            "勵志成長精選",
                        ];
                        // 連結搜尋欄位
                        $('#tags').autocomplete({
                            source: terms
                        });


                    });
        </script>
    <!-- <script>
                      $(document).ready(function() {
            $("#myInput").on("keyup", function() {
                // 抓 搜尋的關鍵詞
                var value = $(this).val().toLowerCase();
                // 抓Table裡頭有沒有符合
                $("#myBody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script> -->
    
</body>


</html>
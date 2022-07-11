<?php

if(isset($_GET["page"])){
    $page=$_GET["page"];
}else{
    $page=1;
}

require("db-connect.php");

$sqlAll="SELECT * FROM product WHERE valid=1";
$resultAll = $conn->query($sqlAll);
$productCount= $resultAll->num_rows;

// $page=1;
$perPage=4;
$start=($page-1)*$perPage;


$sql="SELECT * FROM product WHERE valid=1 LIMIT $start, 5";


$result = $conn->query($sql);
$pageProductCount=$result->num_rows;
$rows = $result->fetch_all(MYSQLI_ASSOC);


?>


<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"  integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <style>
        .object-cover {
            /* width: 100%; */
            /* height: 100%; */
            /* width: 200px;
            height: 200px; */
            object-fit: cover;
        }
    </style>
  </head>
  <body>
      <div class="container">
        <div class="mt-4">
        <h1 >商品管理</h1>
        <table class="table table-bordered">
        
        <div class="py-2">
            <!-- 6/23 下午21分 -->
            <form action="search-product.php" method="get">
            <div class="input-group">
                <span>上架狀態</span>
                <input type="text" class="form-control" name="search">
                <button class="btn btn-info" >搜尋</button>
            </form>
            </div>
        </div>

        <div class="col-auto">
        <a class="btn btn-info" href="create-product.php"> 新增商品</a>
            <a class="btn btn-info" type="submit">篩選</a>
            <div class="py-2"> 共<?=$productCount ?> 筆商品</div>
        </div>
        <?php if ($pageProductCount > 0) : ?>
            <thead>
                <tr>
                    <!-- <th>id</th> -->
                    <th>產品編號</th>
                    <th>產品名稱</th>
                    <!-- <th>封面圖</th> -->
                    <th>類型</th>
                    <th>定價</th>
                    <th>上架狀態</th>
                    <th>上架時間</th>
                    <th></th>
                </tr>
            <tbody>
                <?php foreach ($rows as $row) : ?>
                    <tr>
                        
                        <!-- <td><?=$row["id"]?></td> -->
                        <td><?=$row["book_sn"]?></td>
                        <td><?=$row["book_name"]?></td>
                        <!-- <td><?=$row["book_img"]?></td>
                        <td>
                        <figure class="ratio ratio-4x3 mb-2">
                        <img class="object-cover" src="image/pic1.jpg" alt="">
                        </figure>
                        </td> -->
                        <td><?=$row["book_category"]?></td>
                        <td><?=$row["price"]?></td>
                        <td><?=$row["status"]?></td>
                        <td><?=$row["upload_time"]?></td>
                        <td> 
                        <a class="btn btn-info" href="view-product.php?id=<?=$row["id"]?>">檢視</a>
                        <a class="btn btn-info" href="edit-product.php?id=<?=$row["id"]?>">編輯</a>
                        <a class="btn btn-danger" href="do-delete.php?id=<?=$row["id"]?>">刪除</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            </thead>
        <?php else : ?>
        目前沒有資料
        <?php endif; ?>
        </table>
        <div class="py-2 " >
                <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item">
                    <!-- <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a> -->
                    </li>
                    <li class="page-item"><a class="page-link" href="try-product-list.php?page=1">1</a></li>
                    <li class="page-item"><a class="page-link" href="try-product-list.php?page=2">2</a></li>
                    <li class="page-item"><a class="page-link" href="try-product-list.php?page=3">3</a></li>
                    <li class="page-item">
                    <!-- <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a> -->
                    </li>
                </ul>
                </nav>

                </div>
        </div>
      </div>
  </body>
</html>
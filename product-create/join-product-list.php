<?php

if(isset($_GET["page"])){
    $page=$_GET["page"];
}else{
    $page=1;
}

// if(isset($_GET["page"])){
//     $page=$_GET["page"];
// }else{
//     $page=1;
// }


require("../db-connect.php");

$sqlAll="SELECT * FROM product WHERE valid=1 ";
$resultAll = $conn->query($sqlAll);
$productCount= $resultAll->num_rows;


// $page=1;
$perPage=5;
$start=($page-1)*$perPage;


//排序


// $order=$_GET["order"];
$order=isset($_GET["order"]) ? $_GET["order"] : 1;

switch($order){
    case 1:
        $orderType="ASC";
        break;
    case 2:
        $orderType="DESC";
        break;
    default:
    $orderType="ASC";
}
// $sql="SELECT * FROM product
//  WHERE valid=1 ORDER BY id $orderType LIMIT $start, 5 ";

// 最原本的
// $sql="SELECT product.*, category.category_name AS category__name FROM product
// JOIN category ON product.book_category = category.category_id WHERE valid=1 ORDER BY id $orderType LIMIT $start, 5 ";
// 最原本的

// try-join複製來的
// $sql="SELECT product.*, category.category_name AS category__name FROM (product
// INNER JOIN category ON product.book_category = category.category_id) INNER JOIN factory ON product.publisher = factory.id WHERE valid=1 AND factory.id = 2 ORDER BY id $orderType LIMIT $start, 5 ";
// 複製來的

$sql="SELECT product.*, category.category_name AS category__name FROM (product
INNER JOIN category ON product.book_category = category.category_id) INNER JOIN factory ON product.publisher = factory.id WHERE valid=1 AND factory.id = 1 ORDER BY id $orderType ";


$result = $conn->query($sql);
$pageProductCount=$result->num_rows;
$rows = $result->fetch_all(MYSQLI_ASSOC);
// var_dump($rows);

//開始的筆數
$startItem = ($page - 1) * $perPage + 1;
$endItem = $page*$perPage;
if($endItem>$productCount)$endItem=$productCount;


$totalPage = ceil($productCount / $perPage); //無條件進位


// JOIN
// $sqlCategory="SELECT product.*, category.category_name AS category__name FROM product
// JOIN category ON product.book_category = category.category_id
// " ;

// $resultCategory = $conn->query($sqlCategory);
// // $rowsCategory=$resultCategory->fetch_all(MYSQLI_ASSOC);
// $rows = $resultCategory->fetch_all(MYSQLI_ASSOC);
// 
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
            
        }

        .img-size {
            width: 150px;
            height: 200px;
            object-fit: cover;
        }

        .btn-info {
            background: #18d3e0;
        }
        
        .select-style {
            border-radius:10px;
        }

     

    </style>
  </head>
  <body>
      <div class="container-fluid">
        <!-- 包sidebar -->
        <div class="row">
            <div class="col-3 row">
                <?php require("../side-nav.php"); ?>
            </div>
            <div class="col-9">
    <!-- 包sidebar -->
        <div class="mt-4 ">
        <!-- <h1 class="text-center">商品管理</h1> -->
        <h1>商品管理</h1>
        <table class="table table-bordered">
        <div class="d-flex justify-content-start">
        <div class="py-2 me-4">
            <form action="../product-search/search-productsn.php" method="get">
            <div class="input-group">
                <!-- <span class=" d-flex align-items-center me-3"></span> -->
                <input type="text" class="form-control" name="search" placeholder="依產品編號搜尋">
                <button class="btn btn-info" > <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg></button>  
            </div>
            </form>
        </div>
       
        <div class="py-2 me-4">
            <form action="../product-search/search-product.php" method="get">
            <div class="input-group">
                <!-- <span class=" d-flex align-items-center me-3"></span> -->
                <input type="text" class="form-control" name="search" placeholder="依產品名稱搜尋">
                <button class="btn btn-info" > <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg></button>  
            </form>
            </div>
        </div>

        <div class="py-2 me-4">
            <form action="../product-search/search-productCategory.php" method="get">
            <div class="input-group">
                <!-- <span class=" d-flex align-items-center me-3"></span> -->
                <input type="text" class="form-control" name="search" placeholder="依產品類型搜尋">
                <button class="btn btn-info" > <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg></button>  
            </form>
            </div>
        </div>

        <!-- 測上下架 -->
        <div class="py-2 me-4">
            <form action="../product-search/search-productStatus.php" method="get">

            <div class="mb-2 input-group ">
                <label for=""></label>
                <select class="form-select rounded-start" aria-label="Default select example" name="status">
                <option selected>依上架狀態搜尋</option>
                <option value="1">上架中</option>
                <option value="2">已下架</option>
                </select>
                <button class="btn btn-info" > <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg></button>  

            </div>
            </form>
            </div>
        </div>
        <!-- 測上下架 -->

        </div>

        <div class="py-2 d-flex me-auto">
        <div class="col">
        
        <div class="row">
        <div class="col">
            <form action="do-date-select.php" method="GET">
                <div class="row d-flex align-items-center">
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="">依上架日搜尋</label>
                    <input type="date" name="from_date" class="form-control" value="<?php if(isset($_GET['from_date'])){echo $_GET['from_date'];}?>  ">
                    </div>                
                </div>  
                <div class="col-md-4">
                    <div class="form-group">
                    <label for=""></label>
                    <input type="date" name="to_date" class="form-control">
                    </div>                
                </div>  
                
                <div class="col-md-2 align-self-end">
                    <div class="form-group">
                    <label for=""></label>
                    <!-- <button type="submit" class="btn btn-info">filter</button> -->
                    <button type="submit" class="btn btn-info" > <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg></button>  
                    </div>                
                </div>  
                </div>    
             </form>
        </div>
        </div>

        </div>
        </div>

        <div class="my-5"></div>
        
        <div class="row mb-2">
        <div class="col-3 d-flex align-items-center">
            <div class="mb-0"> 第 <?=$startItem ?> - <?=$endItem ?> 筆，共<?=$productCount ?> 筆商品
            </div>
        </div>
        
        <!-- 測試下拉 -->
        <!-- <form action="do-dropdown-select.php" method="post">
        上架狀態：<select name="status" id="">
        <option value="1">上架</option>
        <option value="2">下架</option>
        </select>
        </form> -->
        <!-- 測試下拉 -->

        <div class="col d-flex justify-content-end">
            <div>
            <a class="btn btn-primary me-3" href="create-product.php"> 新增商品</a>
            </div>
            
            <div class="btn-group me-3">
                <a href="product-list.php?page=<?=$page?>&order=1" class="btn btn-info <?php if($order==1) echo "active"?>" >依編號遞增排序</a>
            </div>

            <div class="btn-group">
                <a href="product-list.php?page=<?=$page?>&order=2" class="btn btn-info <?php if($order==1) echo "active"?>" >依編號遞減排序</a>
            </div>
            
        </div>

        </div>

        <?php if ($pageProductCount > 0) : ?>
            <thead>
                <tr>
                    <th>產品編號</th>
                    <th>產品名稱</th>
                    <th>出版社</th>
                    <th>類型</th>
                    <th>定價</th>
                    <th>上架狀態</th>
                    <th>上架時間</th>
                    <th>功能</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $row) : ?>
                    <tr>
                        <td><?=$row["book_sn"]?></td>
                        <td><?=$row["book_name"]?></td>
                        <th><?=$row["publisher"]?></th>
                        <td><?=$row["book_category"]?> <!-- <?=$row["category__name"]?>-->  </td>
                        <td><?=$row["price"]?></td>
                        <td><?=$row["status"]?></td>
                        <td><?=$row["upload_time"]?></td>
                        <td class=""> 
                        <a class="btn btn-info me-2" href="view-product.php?id=<?=$row["id"]?>">檢視</a>
                        <a class="btn btn-info me-2" href="../product-edit/edit-product.php?id=<?=$row["id"]?>">編輯</a>
                        <a class="btn btn-danger" href="../product-edit/do-delete.php?id=<?=$row["id"]?>">刪除</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        <?php else : ?>
        目前沒有資料
        <?php endif; ?>
        </table>
        <div class="py-2 " >
                <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <!-- <li class="page-item"> -->
                    <!-- <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a> -->
                    <!-- </li> -->
                    <?php for ($i = 1; $i <= $totalPage; $i++) : ?>
                    <li class="page-item
                    <?php if ($page == $i) echo "active";?>">
                    <a class="page-link " href="product-list.php?page=<?= $i ?>&order=<?=$order?>"><?= $i ?></a></li>
                    <?php endfor; ?>
                   
                </ul>
                </nav>
                </div>
        </div>
        <!-- 包sidebar -->
        </div>
        </div>
        <!-- 包sidebar -->
      </div>
  </body>
</html>
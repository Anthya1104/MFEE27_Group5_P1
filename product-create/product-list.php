<?php

if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
}


require("../db-connect.php");

$sqlAll = "SELECT * FROM product WHERE valid=1 ";
$resultAll = $conn->query($sqlAll);
$productCount = $resultAll->num_rows;


// $page=1;
$perPage = 5;
$start = ($page - 1) * $perPage;


//排序


// $order=$_GET["order"];
$order = isset($_GET["order"]) ? $_GET["order"] : 1;

switch ($order) {
    case 1:
        $orderType = "ASC";
        break;
    case 2:
        $orderType = "DESC";
        break;
    default:
        $orderType = "ASC";
}
// $sql="SELECT * FROM product
//  WHERE valid=1 ORDER BY id $orderType LIMIT $start, 5 ";


$sql = "SELECT product.*, category.category_name AS category__name FROM product
JOIN category ON product.book_category = category.category_id WHERE valid=1 ORDER BY id $orderType LIMIT $start, 5 ";



$result = $conn->query($sql);
$pageProductCount = $result->num_rows;
$rows = $result->fetch_all(MYSQLI_ASSOC);
// var_dump($rows);

//開始的筆數
$startItem = ($page - 1) * $perPage + 1;
$endItem = $page * $perPage;
if ($endItem > $productCount) $endItem = $productCount;


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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <style>
        .title {
            border-bottom: 5px solid #000;
            padding-bottom: 15px;
            margin-bottom: 15px;
        }

        .object-cover {
            width: 100%;
            height: 100%;
            width: 120px;
            height: 150px;
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

        .thead-col {
        background-color: #102e2ef8;
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
                <div class="py-2 mt-4">
                    <div class="me-2 mt-2 ">
                        <h2 class="title">閱閱出版社&nbsp商品管理</h2>
                    </div>
                    <table class="table table-bordered border-dark">
                        <div class="d-flex justify-content-start">
                            <div class="py-2 me-4">
                                <form action="../product-search/search-productsn.php" method="get">
                                    <div class="input-group">
                                        <!-- <span class=" d-flex align-items-center me-3"></span> -->
                                        <input type="text" class="form-control" name="search" placeholder="依商品編號搜尋">
                                        <button class="btn btn-dark"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                            </svg></button>
                                    </div>
                                </form>
                            </div>

                            <div class="py-2 me-4">
                                <form action="../product-search/search-product.php" method="get">
                                    <div class="input-group">
                                        <!-- <span class=" d-flex align-items-center me-3"></span> -->
                                        <input type="text" class="form-control" name="search" placeholder="依商品名稱搜尋">
                                        <button class="btn btn-dark"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                            </svg></button>
                                </form>
                            </div>
                        </div>

                        <div class="py-2 me-4">
                            <form action="../product-search/search-productCategory.php" method="get">
                                <div class="input-group">
                                    <!-- <span class=" d-flex align-items-center me-3"></span> -->
                                    <input type="text" class="form-control" name="search" placeholder="依商品類型搜尋">
                                    <button class="btn btn-dark"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
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
                            <button class="btn btn-dark"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
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
                                    <div class="form-group ">
                                        <label for="">依上架日搜尋</label>
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
                                        <button type="submit" class="btn btn-dark"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
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
                <div class="mb-0"> 第 <?= $startItem ?> - <?= $endItem ?> 筆，共<?= $productCount ?> 筆商品
                </div>
            </div>

            <div class="col d-flex justify-content-end">
                <div>
                    <a class="btn btn-primary me-3" href="create-product.php"> 新增商品 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                        </svg> </a>
                </div>

                <div class="btn-group me-3">
                    <a href="product-list.php?page=<?= $page ?>&order=1" class="btn btn-success <?php if ($order == 1) echo "active" ?>">依編號遞增排序 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z" />
                        </svg> </a>
                </div>

                <div class="btn-group">
                    <a href="product-list.php?page=<?= $page ?>&order=2" class="btn btn-success <?php if ($order == 1) echo "active" ?>">依編號遞減排序 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z" />
                        </svg> </a>
                </div>

            </div>

        </div>

        <?php if ($pageProductCount > 0) : ?>
            <thead>
                <tr class=" text-center thead-col text-white">
                    <th>商品編號</th>
                    <th>商品名稱</th>
                    <th>封面圖</th>
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
                        <td class="text-center"><?= $row["book_sn"] ?></td>
                        <td><?= $row["book_name"] ?></td>
                        <td class="text-center"><img class="object-cover" src="image/<?= $row["book_img"] ?>" alt=""></td>
                        <td class="text-center"><?= $row["book_category"] ?> <?= $row["category__name"] ?></td>
                        <td class="text-center"><?= $row["price"] ?></td>
                        <td class="text-center"><?= $row["status"] ?></td>
                        <td class="text-center"><?= $row["upload_time"] ?></td>
                        <td class="text-center">
                            <a class="btn btn-info me-2" href="view-product.php?id=<?= $row["id"] ?>">檢視 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                </svg> </a>
                            <a class="btn btn-warning me-2" href="../product-edit/edit-product.php?id=<?= $row["id"] ?>">編輯 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                </svg> </a>
                            <a class="btn btn-danger" href="../product-edit/do-delete.php?id=<?= $row["id"] ?>">刪除 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                </svg> </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        <?php else : ?>
            目前沒有資料
        <?php endif; ?>
        </table>
        <div class="py-2 d-flex justify-content-center">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <!-- <li class="page-item"> -->
                    <!-- <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a> -->
                    <!-- </li> -->
                    <?php for ($i = 1; $i <= $totalPage; $i++) : ?>
                        <li class="page-item
                    <?php if ($page == $i) echo "active"; ?>">
                            <a class="page-link " href="product-list.php?page=<?= $i ?>&order=<?= $order ?>"><?= $i ?></a>
                        </li>
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
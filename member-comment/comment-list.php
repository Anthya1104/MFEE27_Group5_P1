<?php
if(isset($_GET["page"])){
    $page = $_GET["page"];
}else{
    $page = 1;
}

require("../db-connect.php");

$sqlAll="SELECT * FROM comment WHERE comment_valid=1";
$resultAll=$conn->query($sqlAll);
$countAll=$resultAll->num_rows;

// 頁數計算
$perPage = 4;
$start = ($page - 1) * $perPage;

$sql="SELECT comment.*, product.book_img, product.book_name, member.user_name 
FROM comment
JOIN product ON comment.product_id =product.id
JOIN member ON comment.user_id =member.id
WHERE comment.comment_valid=1
ORDER BY comment.id DESC
LIMIT $start, 4
";
$result=$conn->query($sql);
$rows=$result->fetch_all(MYSQLI_ASSOC);
$pageCount = $resultAll->num_rows;




//開始筆數
$startItem = ($page - 1) * $perPage +1;
$endItem = $page * $perPage;
if($endItem > $pageCount) $endItem = $pageCount;

$totalPage = ceil($countAll/$perPage);
// print_r($totalPage);



?>
<!doctype html>
<html lang="en">
  <head>
    <title>Comments</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"  integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <link rel="stylesheet" href="../css/style.css">


  </head>
  <body>
<!-- side nave  -->

    <div class="container-fluid ">
        <div class="row">
            <div class="col-3 row">
                <?php require("../side-nav-admin.php");?>
            </div>

<!-- Main Body -->


            <div class="row col-9">
               <section> 
                    <div class="col-md p-4">
                        <h1 class="comment-h1">Comments</h1>
                        <div class="comment row mt-4 text-justify">
                            
                            <?php foreach($rows as $row):?>
                            
                            <div class="col-md-3">
                                <figure class="pt-2">
                                    <img src="../images/<?=$row["book_img"]?>" alt="bookcover<?=$row["product_id"]?>" class="object-cover">
                                </figure>

                            </div>
                            <div class="col-md-9 py-3">                        
                                <h3><?=$row["book_name"]?></h3><br>
                                <h4><?=$row["user_name"]?></h4>
                                <span>- <?=$row["create_time"]?></span>
                                <br>
                                <p><?=$row["content"]?></p>
                                <div class="text-end">                        
                                    <a href="comment-do-delete.php?id=<?=$row["id"]?>" class="btn btn-info">刪除</a>
                                    <a href="comment-edit.php?id=<?=$row["id"]?>" class="btn btn-info">編輯</a>
                                </div>

                            </div>
                            <?php endforeach;?>


                        </div>
                    </div>

                </section>
                <!-- pagination  -->
                <section class="d-flex justify-content-center mt-2">
                <nav aria-label="Page navigation example">
        <ul class="pagination">
          <!-- <li class="page-item"><a class="page-link" href="#">Previous</a></li> -->
          <?php for ($i = 1; $i <= $totalPage; $i++) : ?>
            <li class="page-item
          <?php
            if ($page == $i) echo "active";
          ?>
          "><a class="page-link" href="comment-list.php?page=<?= $i ?>"><?= $i ?></a></li>
          <?php endfor; ?>
          <!-- <li class="page-item"><a class="page-link" href="#">Next</a></li> -->
        </ul>


      </nav>
                </section>

            </div>      
        </div>
        </div>
    </div>





  </body>
</html>
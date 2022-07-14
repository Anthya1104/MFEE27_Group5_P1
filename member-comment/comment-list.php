<?php
session_start();
if(isset($_GET["page"])){
    $page = $_GET["page"];
}else{
    $page = 1;
}

// if($_SESSION["deleteAlert"]==1){
//   toastClick();
//   $_SESSION["deleteAlert"]=0;
// }

require("../db-connect.php");

$sqlAll="SELECT * FROM comment WHERE comment_valid=1";
$resultAll=$conn->query($sqlAll);
$countAll=$resultAll->num_rows;

// 頁數計算
$perPage = 4;
$start = ($page - 1) * $perPage;

//排列條件
$order=isset($_GET["order"]) ? $_GET["order"]: 6;//條件判斷式

switch($order){
  case 1:
    $orderType="product_id ASC";
    break;
  case 2:
    $orderType="product_id DESC";
    break;
  case 3:
      $orderType="user_id ASC";
      break;
  case 4:
      $orderType="user_id DESC";
      break;
  case 5:
    $orderType="id ASC";
    break;
  case 6:
    $orderType="id DESC";
    break;

  default:
  $orderType="id ASC";
}

$sql="SELECT comment.*, product.book_img, product.book_name, member.user_name
FROM comment
JOIN product ON comment.product_id =product.id
JOIN member ON comment.user_id =member.id
WHERE comment.comment_valid=1
ORDER BY $orderType
LIMIT $start, 4
";
// print_r($sql);
// print_r($orderType);
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

    <link rel="stylesheet" href="/fontawesome-free-6.1.1-web/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/style2.css">
    <link rel="stylesheet" href="../css/Toast.css">


  </head>
  <style>
    .p-img{
    height:200px;
  }

  .btn-primary{
    --bs-btn-bg: #102e2e;
    --bs-btn-border-color: #102e2e;
    --bs-btn-hover-bg: #32b7c0;
    --bs-btn-hover-border-color: #102e2e;
    --bs-btn-active-bg: #32b7c0;
    --bs-btn-active-border-color: #102e2e;
  }

  .pagination{
    --bs-pagination-active-bg:#32b7c0;
    --bs-link-hover-color: #32b7c0;
    --bs-pagination-active-border-color: #102e2e;
  }
  .book-sn{
    width: 50px;
    height: 50px;
    background:#32b7c0;
    border-radius: 50% 0 50% 0;
    left:25px;
    top:5px;
    box-shadow:0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 9px 26px 0 rgba(0, 0, 0, 0.19);

  }
  .book-sn p{
        color:#fff;
  }
  </style>
  <body>
<!-- side nave  -->

    <div class="container-fluid ">
        <div class="row">
            <div class="col-3 row">
                <?php require("../side-nav-admin.php");?>
            </div>


            <div class="row col-9">
               <section> 

<!-- search bar -->
                <!-- <div class="row">
                  <div class="col-8">
                    <div class="py-2">
                    <form action="user-search-result.php" methood="get"> 
                      <div class="input-group">
                                  
                        <input type="text" class="form-control" name="search" placeholder="請輸入書名">
                        <button class="btn btn-primary" type="submit">Search</button>
                        
                      </div>
                      </form>
                  </div>

                  </div> -->
                  <!-- <div class="col-12"> -->
                                


                  <!-- </div>
                </div> -->
<!-- search bar end                    -->

                    <div class="col-md p-4">
                      <h1 class="comment-h1">Comments</h1>

                      <div class="row">
                        <div class="col-6">
                        <div class="py-2">第 <?=$startItem?> 到第 <?=$endItem?> 筆資料，共 <?= $countAll ?>筆資料</div>
                        </div>
                        <div class="col-6">
                          
                        <!-- sort bar  -->
                  <div class="py-2 d-flex justify-content-end">
                    <div class="me-2 d-flex align-self-center">排序</div>
                    <div class="btn-group">
                      <a href="comment-list.php?page=<?=$page?>&order=5" class="btn btn-primary <?php if($order==5)echo "active"?>">留言日期<i class="fa-solid fa-arrow-down-short-wide "></i></a>
                      
                      <a href="comment-list.php?page=<?=$page?>&order=6" class="btn btn-primary <?php if($order==6)echo "active"?>">留言日期<i class="fa-solid fa-arrow-down-wide-short fa-flip-vertical"></i></a>  


                      <a href="comment-list.php?page=<?=$page?>&order=1" class="btn btn-primary <?php if($order==1)echo "active"?>">書本<i class="fa-solid fa-arrow-down-short-wide "></i></a>
                      
                      <a href="comment-list.php?page=<?=$page?>&order=2" class="btn btn-primary <?php if($order==2)echo "active"?>">書本<i class="fa-solid fa-arrow-down-wide-short fa-flip-vertical"></i></a>
                      
                      <a href="comment-list.php?page=<?=$page?>&order=3" class="btn btn-primary <?php if($order==3)echo "active"?>">會員<i class="fa-solid fa-arrow-down-short-wide"></i></a>
                      
                      <a href="comment-list.php?page=<?=$page?>&order=4" class="btn btn-primary <?php if($order==4)echo "active"?>">會員<i class="fa-solid fa-arrow-down-wide-short fa-flip-vertical"></i></a>
                    </div>
                  </div>

<!-- sort bar end  -->
                        </div>
                      </div>


      <!-- 確認有正確撈出資料 迴圈才有意義 -->
      <?php if($pageCount > 0): ?>
                        <div class="comment row mt-2 d-flex text-justify">
                            
                            <?php foreach($rows as $row):?>
                            
                            <div class="col-md-2 d-flex align-items-center justify-content-center position-relative">
                              <div class="position-absolute book-sn d-flex align-items-center justify-content-center">
                              <p class="mt-3"><?=$row["id"]?></p>  
                              </div>
                                <figure class="p-img" >
                                    <img src="../product-create/image/<?=$row["book_img"]?>" alt="bookcover<?=$row["product_id"]?>" class="object-cover">
                                </figure>

                            </div>
                            <div class="col-md-10 py-3">                        
                                <h4><?=$row["product_id"];?>：<?=$row["book_name"]?></h4><br>
                                <span style="color:#fff; font-size:18px;">
                                <i class="fa-solid fa-user-astronaut"></i> <?=$row["user_id"]?>：
                                <?=$row["user_name"]?></span>
                                <span>- <?=$row["create_time"]?></span>
                                <br>
                                <p><?=$row["content"]?></p>
                                <div class="text-end">                        
                                    <a href="comment-do-delete.php?id=<?=$row["id"]?>" class="btn btn-info btn-delete" onclick="toastClick()" >刪除</a>
                                    <a href="comment-edit.php?id=<?=$row["id"]?>" class="btn btn-info">編輯</a>
                                </div>

                            </div>
                            <?php endforeach;?>


                        </div>
                    </div>
                    <?php else: ?>
            目前沒有資料
        <?php endif; ?>
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
          "><a class="page-link" href="comment-list.php?page=<?= $i ?>&order=<?=$order?>"><?= $i ?></a></li>
          <?php endfor; ?>
          <!-- <li class="page-item"><a class="page-link" href="#">Next</a></li> -->
        </ul>


      </nav>
                </section>

            </div>      
        </div>
        </div>
    </div>

    

<script src="../javascript/Toast.js"></script>
<script>
  // let btnDelete=document.querySelectorAll(".btn-delete");
  
  // console.log(btnDelete);

  // btnDelete.addEventListener("click", function(){
  //     // new Toast({message: 'Welcome to Toast.js!'});
  //     // console("delete");
  // })
  function toastClick(){
       new Toast({message: '刪除成功'});
  }

  


</script>


  </body>
</html>
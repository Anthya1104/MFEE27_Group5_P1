<?php
require("../db-connect.php");

$sql="SELECT comment.*, member.user_name AS m_id, product.id AS p_id, member.id AS m_id 
FROM comment
JOIN product ON comment.product_id =product.id
JOIN member ON comment.user_id =member.id
";
$result=$conn->query($sql);
$rows=$result->fetch_all(MYSQLI_ASSOC);


$sqlProduct="SELECT * FROM product";
$resultProduct=$conn->query($sqlProduct);
$rowsProduct=$resultProduct->fetch_all(MYSQLI_ASSOC);

$sqlMember="SELECT * FROM member";
$resultMember=$conn->query($sqlMember);
$rowsMember=$resultMember->fetch_all(MYSQLI_ASSOC);
$productName = array_column($rowsProduct, 'book_name', 'id');
$productImg = array_column($rowsProduct, 'book_img', 'id');
$memberName = array_column($rowsMember, 'user_name', 'id');

// var_dump($rowsProduct);


?>
<!doctype html>
<html lang="en">
  <head>
    <title>Comment</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"  integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <link rel="stylesheet" href="../css/style.css">

  </head>
  <body>
 
<!-- Main Body -->
<section>
    <div class="container">
            <div class="col-md p-4">
                <h1 class="comment-h1">Comments</h1>
                <div class="comment row mt-4 text-justify">
                    
                    <?php foreach($rows as $row):?>
                        <?php if($row["comment_valid"]==1):?>
                    
                    <div class="col-md-3">
                        <figure class="pt-2">
                            <img src="../images/<?=$productImg[$row["p_id"]]?>" alt="bookcover<?=$row["product_id"]?>" class="object-cover">
                        </figure>

                    </div>
                    <div class="col-md-9 py-3">                        
                        <h3><?=$productName[$row["p_id"]]?></h3><br>
                        <h4><?=$memberName[$row["m_id"]]?></h4>
                        <span>- <?=$row["create_time"]?></span>
                        <br>
                        <p><?=$row["content"]?></p>
                        <div class="text-end">                        
                            <a href="doDelete.php?id=<?=$row["id"]?>" class="btn btn-info">刪除</a>
                            <a href="" class="btn btn-info">編輯內容</a>
                        </div>

                    </div>
                    <?php endif;?>
                    <?php endforeach;?>


                </div>
            </div>

        </div>
    </div>
</section>
  </body>
</html>
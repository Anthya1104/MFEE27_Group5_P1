<?php
if(!isset($_GET["id"])){
    echo "沒有參數";
    exit;
}
$id=$_GET["id"];

require("../db-connect.php");
$sql="SELECT comment.*, member.user_name 
FROM comment

JOIN member ON comment.user_id =member.id

WHERE comment.id=$id
;

";

$result = $conn ->query($sql);
$userCount = $result->num_rows;


?>
<!doctype html>
<html lang="en">
  <head>
    <title>Comment Edit</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"  integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">

  </head>
  <body>
  


    <div class="row">
        <div class="col-3">
            <?php require("../side-nav.php");?>
        </div>
        <div class="col-9">

    <div class="container-fluid">
        <?php if($userCount>0): $row = $result->fetch_assoc();?>

        <div class="edit-area">
            <div class="d-fex justify-content-center">

        
            <div class="py-2">
                <a href="comment-list.php" class="btn btn-info">返回</a>
            </div>
            <form action="comment-do-update.php" method="post">
            <input name="id" type="hidden" value="<?=$row["id"]?>">
            <!-- 以上hidden內容是需要使用的時候再寫就好 -->
            <table class="table">
                <tr>
                    <th>comment ID</th>
                    <td>
                        <?=$row["id"]?>
                    </td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>
                        <?=$row["user_name"]?>
                    </td>
                </tr>
                <tr>
                    <th>Comments</th>
                    <td>
                    <textarea name="comments" id="comments"  class="form-control" value="<?=$row["content"]?>" placeholder="<?=$row["content"]?>"></textarea>

                    </td>

                </tr>


            </table>
            <div class="py-2">
            <button class="btn btn-info" type="submit">儲存</button>
            </div>
        </div>
        <?php else: ?>
            找不到該使用者

        <?php endif;?>
        </div>
        </div>
    </div>
    </div>
  </body>
</html>